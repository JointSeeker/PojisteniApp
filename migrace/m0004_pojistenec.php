<?php

class m0004_pojistenec
{
    public function nahraj()
    {
        $db = \aplikace\core\Aplikace::$aplikace->db;
        $SQL = "CREATE TABLE IF NOT EXISTS pojistenec (
              id_pojistenec int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
              id_pojistnik int(11) NOT NULL,
              jmeno varchar(60) NOT NULL,
              prijmeni varchar(60) NOT NULL,
              ulice varchar(255) NOT NULL,
              mesto varchar(255) NOT NULL,
              psc int(11) NOT NULL,
               KEY id_pojistnik (id_pojistnik)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $db->pdo->exec($SQL);
    }

    public function vymaz()
    {
        $db = \aplikace\core\Aplikace::$aplikace->db;
        $SQL = "DROP TABLE pojistenec;";
        $db->pdo->exec($SQL);
    }
}