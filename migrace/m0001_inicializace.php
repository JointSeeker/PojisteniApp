<?php
class m0001_inicializace
{
    public function nahraj()
    {
        $db = \aplikace\core\Aplikace::$aplikace->db;
        $SQL = "CREATE TABLE pojistnik (
                id_pojistnik INT AUTO_INCREMENT PRIMARY KEY,
                jmeno VARCHAR(60) NOT NULL,
                prijmeni VARCHAR(60) NOT NULL,
                email VARCHAR(255) NOT NULL UNIQUE,
                ulice VARCHAR(255) NOT NULL, 
                mesto VARCHAR(255) NOT NULL, 
                psc INT NOT NULL,
                tel INT NOT NULL  UNIQUE
) ENGINE=INNODB;";
        $db->pdo->exec($SQL);
    }

    public function vymaz()
    {
        $db = \aplikace\core\Aplikace::$aplikace->db;
        $SQL = "DROP TABLE pojistnik;";
        $db->pdo->exec($SQL);
    }


}