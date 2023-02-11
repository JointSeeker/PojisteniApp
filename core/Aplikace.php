<?php
namespace aplikace\core;

use aplikace\models\Pojistenci;
use aplikace\models\Pojistnik;

/**
 * Class Aplikace
 *
 * @author JointSeeker <jointseeker@gmail.com>
 * @package aplikace\core
 */
class Aplikace
{
    // deklarování objektů
    public static string $HLAVNI_SLOZKA;
    public static Aplikace $aplikace;

    public string $tridaUzivatel;
    public Smerovac $smerovac;
    public Pozadavek $pozadavek;
    public Odezva $odezva;
    public Kontroler $kontroler;
    public Session $session;

    public Databaze $db;
    public ?DbModel $pojistnik;

    public array $pojistenci;
    public array $pojisteni;


    /**
     * @param $hlavniCesta
     */
    public function __construct($hlavniCesta, array $konfigurace)
    {
        //vytvoření instancí
        // zakomentovat tridu uzivatel pred spustenim migrace
        $this->tridaUzivatel = $konfigurace['tridaUzivatel'];
        self::$HLAVNI_SLOZKA = $hlavniCesta;
        self::$aplikace = $this;
        $this->pozadavek = new Pozadavek();
        $this->odezva = new Odezva();
        $this->session = new Session();
        $this->smerovac = new Smerovac($this->pozadavek, $this->odezva);

        $this->db = new Databaze($konfigurace['databaze']);

        $primarniHodnota = $this->session->ziskej('pojistnik');
        if ($primarniHodnota) {
            $primarniKlic = $this->tridaUzivatel::primarniKlic();
            $this->pojistnik = $this->tridaUzivatel::najdiJeden([$primarniKlic => $primarniHodnota]);
        } else {
            $this->pojistnik = null;
        }
    }


    /**spuštění rozlišování příkazů ve směrovači
     * @return void
     */
    public function spust()
    {
        echo $this->smerovac->rozlis();
    }

    /** Zde získáme Kontroler
     * @return Kontroler
     */
    public function ziskejKontroler(): Kontroler
    {
        return $this->kontroler;
    }

    /** Zde nastavíme kontroler
     * @param Kontroler $kontroler
     */
    public function nastavKontroler(Kontroler $kontroler)
    {
        $this->kontroler = $kontroler;
    }

    /**
     * pokud je navstevnik tak nemuže být pojistnik
     * @return bool
     */
    public static function Navstevnik()
    {
        return !self::$aplikace->pojistnik;
    }

    public function prihlaseni(DbModel $pojistnik)
    {
        $this->pojistnik = $pojistnik;
        $primarniKlic = $pojistnik->primarniKlic();
        $primarniHodnota = $pojistnik->{$primarniKlic};
        $this->session->nastav('pojistnik', $primarniHodnota);

    }

    public function odhlaseni()
    {
        $this->pojistnik = null;
        $this->session->odstran('pojistnik');
    }
}