<?php

namespace aplikace\core;

class Databaze
{
    public \PDO $pdo;
    /**
     * Konstruktor databáze
     */
    public function __construct(array $konfigurace)
    {
        $dsn = $konfigurace['dsn'] ?? '';
        $uzivatel = $konfigurace['uzivatel'] ?? '';
        $heslo = $konfigurace['heslo'] ?? '';
        $this->pdo = new \PDO($dsn, $uzivatel, $heslo);
        //nastavení atributu a hodnot v pripojeni k PDO
        $this->pdo->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        $this->pdo->setAttribute(\PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8");
    }

    //vytvoření databáze pokud není vytvořena
    public function aplikujMigrace()
    {
        $this->vytvorMigracniStul();
        $aplikovaneMigrace = $this->ziskejAplikovaneMigrace(); /// vraci vsechny aplikovane migrace ['m0001_inicializace.php']

        $noveMigrace = [];
        $soubory = scandir(Aplikace::$HLAVNI_SLOZKA.'/migrace');
        $rozdelAplikovaneMigrace = array_diff($soubory, $aplikovaneMigrace); /// vraci rodelene pole neaplikovanych migraci ['.', '..', 'm0002_...]
        foreach ($rozdelAplikovaneMigrace as $migrace) {
            //pokud budou migrace '.' nebo '..' tak pokracuj v cyklu
            if ($migrace === '.' || $migrace === '..') {
                continue;
            }

            require_once Aplikace::$HLAVNI_SLOZKA.'/migrace/'.$migrace;
            $nazevTridy = pathinfo($migrace, PATHINFO_FILENAME);
            $instance = new $nazevTridy();
            $this->log("Aplikuji migrace $migrace". PHP_EOL);
            $instance->nahraj();
            $this->log("Aplikované migrace $migrace". PHP_EOL);
            $noveMigrace[] = $migrace;
        }

        if (!empty($noveMigrace)) {
            $this->ulozMigrace($noveMigrace);
        }
        else {
            $this->log("Všechny migrace jsou aplikovány");
        }
    }


    /**
     * funkce pro vytvoření sql tabulky Migrace
     * @return void
     */
    public function vytvorMigracniStul()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrace (
        id INT AUTO_INCREMENT PRIMARY KEY,
        migrace VARCHAR(255),
        vytvoreno TIMESTAMP DEFAULT  CURRENT_TIMESTAMP
        ) ENGINE=INNODB;");
    }

    public function ziskejAplikovaneMigrace()
    {
        $udaj = $this->pdo->prepare("SELECT migrace FROM migrace");
        $udaj->execute();
        return $udaj->fetchAll(\PDO::FETCH_COLUMN);
    }

    private function ulozMigrace(array $migrace)
    {
        $nazvy = implode(",", array_map(fn($mig) => "('$mig')", $migrace));
        $udaj = $this->pdo->prepare("INSERT INTO migrace (migrace) VALUES $nazvy");
        $udaj->execute();
    }

    public function priprav($SQL)
    {
        return $this->pdo->prepare($SQL);
    }

    protected function log($zprava)
    {
        echo '['.date('Y-m-d H:i:s').'] - ' . $zprava . PHP_EOL;
    }

}