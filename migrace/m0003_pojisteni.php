<?php

class m0003_druh_pojisteni
{
    public function nahraj()
    {
        $db = \aplikace\core\Aplikace::$aplikace->db;
        $SQL = "CREATE TABLE pojisteni (
                id_pojisteni INT AUTO_INCREMENT PRIMARY KEY,
                id_pojistnik INT DEFAULT NULL,
                id_pojistenec INT DEFAULT NULL,
                id_pojisteni_typ INT K,
                hodnota INT NOT NULL,
                 KEY id_pojistnik (id_pojistnik),
                 KEY id_pojistenec (id_pojistenec),
                 KEY id_pojisteni_typ (id_pojisteni_typ)
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