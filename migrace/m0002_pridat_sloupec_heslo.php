<?php


class m0002_pridat_sloupec_heslo
{
    public function nahraj()
    {
        $db = \aplikace\core\Aplikace::$aplikace->db;
        $db->pdo->exec("ALTER TABLE pojistnik ADD COLUMN heslo VARCHAR(512) NOT NULL;");
    }
    public function vymaz()
    {
        $db = \aplikace\core\Aplikace::$aplikace->db;
        $db->pdo->exec("ALTER TABLE pojistnik DROP COLUMN heslo;");
    }
}