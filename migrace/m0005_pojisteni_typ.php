<?php

namespace aplikace\migrace;

use aplikace\core\Aplikace;

class m0005_pojisteni_typ
{
    public function nahraj()
    {
        $db = Aplikace::$aplikace->db;
        $SQL = "CREATE TABLE IF NOT EXISTS pojisteni_typ (
                id_pojisteni_typ INT PRIMARY KEY AUTO_INCREMENT,
                nazev VARCHAR(255) NOT NULL,
                popis VARCHAR(455) NOT NULL               
                )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ";
        $db->pdo->exec($SQL);
    }

        public function vymaz()
    {
        $db = \aplikace\core\Aplikace::$aplikace->db;
        $SQL = "DROP TABLE pojisteni_typ;";
        $db->pdo->exec($SQL);
    }

}