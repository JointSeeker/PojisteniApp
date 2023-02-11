<?php

class m0003_pojisteni
{
    public function nahraj()
    {
        $db = \aplikace\core\Aplikace::$aplikace->db;
        $SQL = "CREATE TABLE IF NOT EXISTS pojisteni (
                id_pojisteni INT AUTO_INCREMENT PRIMARY KEY,
                id_pojistnik INT DEFAULT NULL,
                id_pojistenec INT DEFAULT NULL,
                id_pojisteni_typ INT KEY ,
                hodnota INT NOT NULL,
                 KEY id_pojistnik (id_pojistnik),
                 KEY id_pojistenec (id_pojistenec)
) ENGINE=INNODB;";
        $db->pdo->exec($SQL);
    }

    public function vymaz()
    {
        $db = \aplikace\core\Aplikace::$aplikace->db;
        $SQL = "DROP TABLE pojisteni;";
        $db->pdo->exec($SQL);
    }
}