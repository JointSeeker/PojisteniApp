<?php

namespace aplikace\core;

abstract class DbModel extends Model
{
    // jmeno stolu je nazev databazove tabulky
    abstract static public function jmenoStolu(): string;
    abstract static public function atributy(): array;
    abstract static public function primarniKlic(): string;


    public function uloz()
    {
        $jmenoStolu = $this->jmenoStolu();
        $atributy = static::atributy();
        $parametry = array_map(fn($atribut) => ":$atribut", $atributy);
        $udaj = self::priprav("INSERT INTO $jmenoStolu (" . implode(',', $atributy) . ")
        VALUES (" . implode(',', $parametry) . ")");
        foreach ($atributy as $atribut) {
            $udaj->bindValue(":$atribut", $this->{$atribut});
        }
        $udaj->execute();
        return true;
    }

    public static function najdiJeden($kde) // [email => blsbas@bksj.com, jmeno => stefan]..
    {
        $jmenoStolu = static::jmenoStolu();
        $atributy = array_keys($kde);
        $SQL = implode("AND ", array_map(fn($atribut) => "$atribut = :$atribut", $atributy));
        $udaj = self::priprav("SELECT * FROM $jmenoStolu WHERE $SQL");
        foreach ($kde as $nazev => $polozka) {
            $udaj->bindValue(":$nazev", $polozka);
        }

        $udaj->execute();
        return $udaj->fetchObject(static::class);
    }

    public static function priprav($SQL)
    {
        return Aplikace::$aplikace->db->pdo->prepare($SQL);
    }
}