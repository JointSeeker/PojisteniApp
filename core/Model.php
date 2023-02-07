<?php

namespace aplikace\core;

/**
 * Class Model
 *
 * @author JointSeeker <jointseeker@gmail.com>
 * @package aplikace\core
 */
abstract class Model
{
    //nastavení konstatních hodnot pro pravidla vstupů formuláře
    public const PRAVIDLO_POZADOVANO = 'pozadovano';
    public const PRAVIDLO_EMAIL = 'email';
    public const PRAVIDLO_MIN = 'min';
    public const PRAVIDLO_MAX = 'max';
    public const PRAVIDLO_SHODA = 'shoda';
    public const PRAVIDLO_TEL = 'tel';
    public const PRAVIDLO_UNIKAT = 'trida';
     public array $stitek = [];


    /**
     * funkce pro načítání dat z furmulářů (vstupů = inputů) a rozdělení na jednotlivé pole s klíčem
     * @param $data
     */
    public function nactiData($data)
    {
        foreach ($data as $klic => $hodnota) {
            if (property_exists($this, $klic)) {
                $this->{$klic} = $hodnota;
            }
        }
    }

    abstract public function pravidla(): array;

    public function stitky(): array
    {
        return [];
    }

    public function ziskejStitek($atribut)
    {
        return $this->stitky()[$atribut] ?? $atribut;
    }

    // deklarování pole do kterého se chyby vepisou k dalšímu použití
    public array $chyby = [];

    // funkce ověření dat pro podmínky v (Autorizačním, ...) kontroleru
    public function overeni()
    {
        foreach ($this->pravidla() as $atribut => $pravidla) {
            $hodnota = $this->{$atribut};
            foreach ($pravidla as $pravidlo) {
                $pravidloJmeno = $pravidlo;
                if (!is_string($pravidloJmeno)) {
                    $pravidloJmeno = $pravidlo[0];
                }
                // pokud existuje pravidlo POZADOVANO a zaroven není vyplněna hodnota v poli nastaví se chyba
                if ($pravidloJmeno === self::PRAVIDLO_POZADOVANO && !$hodnota) {
                    $this->pridejChybuProPravidlo($atribut, self::PRAVIDLO_POZADOVANO);
                }
                // pokud existuje pravidlo EMAIL a zaroven není vyplněna emailová addresa v poli nastaví se chyba
                if ($pravidloJmeno === self::PRAVIDLO_EMAIL && !filter_var($hodnota, FILTER_VALIDATE_EMAIL)) {
                    $this->pridejChybuProPravidlo($atribut, self::PRAVIDLO_EMAIL);
                }
                //Pokud existuje pravidlo požadováno tak získáme délku retezce a porovnáme jí se zadaním pravidlem např: v registračním modelu
                if ($pravidloJmeno === self::PRAVIDLO_MIN && strlen($hodnota) < $pravidlo['min'] ) {
                    $this->pridejChybuProPravidlo($atribut, self::PRAVIDLO_MIN, $pravidlo);
                }
                //Pokud existuje pravidlo požadováno tak získáme délku retezce a porovnáme jí se zadaním pravidlem např: v registračním modelu
                if ($pravidloJmeno === self::PRAVIDLO_MAX && strlen($hodnota) > $pravidlo['max'] ) {
                    $this->pridejChybuProPravidlo($atribut, self::PRAVIDLO_MAX, $pravidlo);
                }
                if ($pravidloJmeno === self::PRAVIDLO_SHODA && $hodnota !== $this->{$pravidlo['shoda']}) {
                    $this->pridejChybuProPravidlo($atribut, self::PRAVIDLO_SHODA, $pravidlo);
                }
                if ($pravidloJmeno === self::PRAVIDLO_TEL && str_contains( $hodnota, '+420')) {
                    $this->pridejChybuProPravidlo($atribut, self::PRAVIDLO_TEL);
                }
                if ($pravidloJmeno === self::PRAVIDLO_UNIKAT) {
                    $jmenoTridy = $pravidlo['trida'];
                    $unikatniHodnota = $pravidlo['atribut'] ?? $atribut;
                    $jmenoStolu = $jmenoTridy::jmenoStolu();
                    $udaj = Aplikace::$aplikace->db->priprav("SELECT * FROM $jmenoStolu WHERE $unikatniHodnota = :atribut");
                    $udaj->bindValue(":atribut", $hodnota);
                    $udaj->execute();
                    $zaznam = $udaj->fetchObject();
                    if ($zaznam) {
                        $this->pridejChybuProPravidlo($atribut, self::PRAVIDLO_UNIKAT, ['pole' => $this->ziskejStitek($atribut)]);
                    }
                }

            }
        }
        //vrací prázdné pole chyb
        return empty($this->chyby);
    }

    private function pridejChybuProPravidlo(string $atribut, string $pravidlo, $parametry = [])
    {
        // zprava = chybová zpráva podle pravidla pokud existuje, pokud ne nastavý se prázdný string
        $zprava = $this->chyboveZpravy()[$pravidlo] ?? '';
        foreach ($parametry as $klic => $hodnota) {
            //klic je nazev parametru v poli napr: 'min' = 8
            $zprava = str_replace("{{$klic}}",$hodnota, $zprava);
        }
        $this->chyby[$atribut][] = $zprava;
    }

    public function pridejChybu(string $atribut, string $zprava)
    {
        $this->chyby[$atribut][] = $zprava;
    }

    // přidání textu chybové zprávy k pravidlům
    public function chyboveZpravy()
    {
        return [
            self::PRAVIDLO_POZADOVANO => 'Toto pole je požadováno',
            self::PRAVIDLO_EMAIL => 'Toto pole musí obsahovat validní emailovou adresu',
            self::PRAVIDLO_MIN => 'Minimální delká pole musí být {min}',
            self::PRAVIDLO_MAX => 'Maximální delká pole musí být {max}',
            self::PRAVIDLO_SHODA => 'Toto pole musí být stejné jako {shoda}',
            self::PRAVIDLO_TEL => 'Toto pole musí obsahovat telefoní číslo bez předčíslí země',
            self::PRAVIDLO_UNIKAT => '{pole} s touto hodnotou již existuje'
        ];
    }

    public function obsahujeChybu($atribut)
    {
        return $this->chyby[$atribut] ?? false;
    }

    public function ziskejPrvniChybu($atribut)
    {
        return $this->chyby[$atribut][0] ?? false;
    }


}