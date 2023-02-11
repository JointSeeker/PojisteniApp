<?php

namespace aplikace\models;

use aplikace\core\DbModel;

class Pojistenec extends DbModel
{
    public string $id_pojistenec = '';
    public string $id_pojistnik = '';
    public string $jmeno = '';
    public string $prijmeni = '';
    public string $ulice = '';
    public string $mesto = '';
    public string $psc = '';



    public static function jmenoStolu(): string
    {
        return 'pojistenec';
    }

    public static function primarniKlic(): string
    {
        return 'id_pojistnik';
    }

    public function pravidla(): array
    {
        return [
            'jmeno' => [self::PRAVIDLO_POZADOVANO],
            'prijmeni' => [self::PRAVIDLO_POZADOVANO],
            'ulice' => [self::PRAVIDLO_POZADOVANO],
            'mesto' => [self::PRAVIDLO_POZADOVANO],
            'psc' => [self::PRAVIDLO_POZADOVANO, [self::PRAVIDLO_MIN, 'min' => 5], [self::PRAVIDLO_MAX, 'max' => 6]],
        ];
    }

    public function stitky(): array
    {
        return [
            'jmeno' => 'Jméno',
            'prijmeni' => 'Příjmení',
            'ulice' => 'Ulice a č. p.',
            'mesto' => 'Město',
            'psc' => 'PSČ'
        ];
    }


    public static function atributy():array // pro databázi
    {
        return ['id_pojistenec','id_pojistnik','jmeno', 'prijmeni', 'ulice', 'mesto', 'psc'];
    }


}