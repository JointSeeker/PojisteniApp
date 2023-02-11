<?php
namespace aplikace\models;
use aplikace\core\Aplikace;
use aplikace\core\PojistnikModel;

/**
 * Class Pojistnik
 *
 * @author JointSeeker <jointseeker@gmail.com>
 * @package aplikace\models
 */
class Pojistnik extends PojistnikModel
{
    // deklarování všech proměných v registračním formuláři
    public string $jmeno = '';
    public string $prijmeni = '';
    public string $email = '';
    public string $ulice = '';
    public string $mesto = '';
    public string $psc = '';
    public string $tel = '';
    public string $heslo = '';
    public string $hesloZnovu = '';



    /**
     * Vrací jméno stolu
     * @return string
     */
    public static function jmenoStolu(): string
    {
        return 'pojistnik';
    }

    public static function primarniKlic(): string
    {
        return 'id_pojistnik';
    }

    // tady sis pridal navratovou hodnotu
    public function uloz(): bool
    {
        $this->heslo = password_hash($this->heslo, PASSWORD_DEFAULT);
        return parent::uloz();
    }

    public function pravidla(): array
    {
        return [
            'jmeno' => [self::PRAVIDLO_POZADOVANO],
            'prijmeni' => [self::PRAVIDLO_POZADOVANO],
            'email' => [self::PRAVIDLO_POZADOVANO, self::PRAVIDLO_EMAIL, [
                self::PRAVIDLO_UNIKAT, 'trida' => self::class
            ]],
            'ulice' => [self::PRAVIDLO_POZADOVANO],
            'mesto' => [self::PRAVIDLO_POZADOVANO],
            'psc' => [self::PRAVIDLO_POZADOVANO, [self::PRAVIDLO_MIN, 'min' => 5], [self::PRAVIDLO_MAX, 'max' => 6]],
            'tel' => [self::PRAVIDLO_POZADOVANO, self::PRAVIDLO_TEL, [self::PRAVIDLO_MIN, 'min' => 9], [self::PRAVIDLO_MAX, 'max' => 9], [
                    self::PRAVIDLO_UNIKAT, 'trida' => self::class
                ]],
            'heslo' => [self::PRAVIDLO_POZADOVANO, [self::PRAVIDLO_MIN, 'min' => 8], [self::PRAVIDLO_MAX, 'max' => 26]],
            'hesloZnovu' => [self::PRAVIDLO_POZADOVANO, [self::PRAVIDLO_SHODA, 'shoda' => 'heslo']]
        ];
    }




    public function stitky(): array
    {
        return [
            'jmeno' => 'Jméno',
            'prijmeni' => 'Příjmení',
            'ulice' => 'Ulice a č. p.',
            'mesto' => 'Město',
            'psc' => 'PSČ',
            'tel' => 'Telefoní číslo',
            'email' => 'Email',
            'heslo' => 'Heslo',
            'hesloZnovu' => 'Potvrďte heslo'
        ];
    }

    public static function atributy():array // pro databázi
    {
        return ['jmeno', 'prijmeni','email', 'ulice', 'mesto', 'psc', 'tel', 'heslo'];
    }

    public function ziskejJmenoProfilu(): string
    {
        return $this->jmeno.' '.$this->prijmeni;
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

    public function ziskejEmail(): string
    {
        return $this->email;
    }

    public function ziskejTelefon(): string
    {
        return $this->tel;
    }

    public function ziskejID(): string
    {
        return Aplikace::$aplikace->session->ziskej('pojistnik');
    }
}