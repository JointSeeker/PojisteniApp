<?php

namespace aplikace\core;

use aplikace\models\Pojistenci;

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
        VALUES (" . implode(', ', $parametry) . ")");
        foreach ($atributy as $atribut) {
            $udaj->bindValue(":$atribut", $this->{$atribut});
        }
        $udaj->execute();

        return true;
    }

    public function najdi()
    {
        $pojistnikID = $_SESSION['pojistnik'];
        $jmenoStolu = $this->jmenoStolu(); // vraci 'priklad'
        $atributy = static::atributy();   // vraci pole [0] => 'id_pojistnik', [1] => 'jmeno', ....
        $parametry = array_map(fn($atribut) => ":$atribut", $atributy); //vraci pole [0] => ':id_pojistnik', [1] => ':jmeno', ....
        $nazvySloupcu = implode(', ', $atributy);

        $udaj = self::priprav("SELECT $nazvySloupcu  FROM $jmenoStolu
        WHERE id_pojistnik = :pojistnikID");
        $udaj->execute(['pojistnikID' => $pojistnikID]);
        return $udaj->fetchAll(\PDO::FETCH_CLASS, Pojistenci::class);
    }

    /**
     * @param $kde array['nazev sloupce v DB' => $hledanáHodnota]
     * @return false|object|\stdClass|null
     */
    public static function najdiJeden($kde)
    {
        $jmenoStolu = static::jmenoStolu();
        $atributy = array_keys($kde);
        $SQL = implode("AND ", array_map(fn($atribut) => "$atribut = :$atribut", $atributy));
        $udaj = self::priprav("SELECT * FROM $jmenoStolu WHERE $SQL");
        foreach ($kde as $klic => $hodnota) {
            $udaj->bindValue(":$klic", $hodnota);
        }
        $udaj->execute();
        return $udaj->fetchObject(static::class);

    }



    

    public static function dotazJeden(string $dotaz, array $parametry = array())
    {
        $navrat = Aplikace::$aplikace->db->pdo->prepare($dotaz);
        $navrat->execute($parametry);
        return $navrat->fetch();
    }


    public static function priprav($SQL)
    {
        return Aplikace::$aplikace->db->pdo->prepare($SQL);

    }
}