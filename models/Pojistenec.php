<?php

namespace aplikace\models;

use aplikace\core\Aplikace;
use aplikace\core\SpojeniModel;

class Spojeni extends SpojeniModel
{
    public string $id_pojistenec = '';
    public string $id_pojistnik = '';
    public string $jmeno = '';
    public string $prijmeni = '';
    public string $ulice = '';
    public string $mesto = '';
    public string $psc = '';
    public array $nazev = [];
    public array $popis = [];
    public array $hodnota = [];
    public array $id_pojisteni = [];



    public static function jmenoStolu(): string
    {
        return 'pojistenec';
    }

    public static function primarniKlic(): string
    {
        return 'id_pojistenec';
    }

    public function pravidla(): array
    {
        return [
            'jmeno' => [self::PRAVIDLO_POZADOVANO],
            'prijmeni' => [self::PRAVIDLO_POZADOVANO],
            'ulice' => [self::PRAVIDLO_POZADOVANO],
            'mesto' => [self::PRAVIDLO_POZADOVANO],
            'psc' => [self::PRAVIDLO_POZADOVANO, self::PRAVIDLO_CISLO, [self::PRAVIDLO_MIN, 'min' => 5], [self::PRAVIDLO_MAX, 'max' => 6]],
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


    public function ziskejJmenoProfilu(): string
    {
        return $this->jmeno.' '.$this->prijmeni;
    }

    public function ziskejPrijmeni(): string
    {
        return $this->prijmeni;
    }

    public function ziskejJmeno(): string
    {
        return $this->jmeno;
    }


    public function ziskejUlici(): string
    {
        return $this->ulice;
    }

    public function ziskejMesto(): string
    {
        return $this->mesto;
    }

    public function ziskejPSC(): string
    {
        return $this->psc;
    }

    public function ziskejNazev()
    {
        return $this->nazev;
    }

    public function ziskejPopis()
    {
        return $this->popis;
    }

    public function ziskejIdPojistence()
    {
        return $this->id_pojistenec;
    }

    public function ziskejHodnotu()
    {
        return $this->hodnota;
    }

    public function ziskejIdPojisteni()
    {
        return $this->id_pojisteni;
    }
}