<?php
namespace aplikace\core;

/**
 * Class Pozadavek
 *
 * @author JointSeeker <jointseeker@gmail.com>
 * @package aplikace\core
 */
class Pozadavek
{
    /**
     * Získání cesty z vyhledávání html adresy pokud ne nastaví se domovská stránka
     * @return string
     */
    public function ziskejCestu()
    {
        $cesta = htmlentities(trim($_SERVER['REQUEST_URI'])) ?? '/';
        //nalezení cesty před požadavkem
        $pozice = strpos($cesta, '?');
        if ($pozice === false){
            return $cesta;
        }
        return substr($cesta,0, $pozice);
    }

    /**
     * zde získáme metodu POST nebo GET z požadavku serveru ve formatu string
     * @return string
     */
    public function metoda()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function jeZiskej()
    {
        return $this->metoda() === 'get';
    }

    public function jeNastav()
    {
        return $this->metoda() === 'post';
    }

    /**
     * zde získáme data z formuláře k další práci s nimy např.: v manipulaci s kontaktem
     * getter
     * @return array
     */
    public function ziskejTelo()
    {
        $telo = [];
        if ($this->metoda() === 'get')
            foreach ($_GET as $klic => $hodnota) {
                // v superproměnné 'get' najdeme hodnotu klice a vlozime ji do $telo
                $telo[$klic] = filter_input(INPUT_GET, htmlspecialchars($klic), FILTER_SANITIZE_SPECIAL_CHARS);
            }
        if ($this->metoda() === 'post')
        foreach ($_POST as $klic => $hodnota) {
            // v superproměnné 'post' najdeme hodnoty klice a vlozime ji do $telo
            $telo[$klic] = filter_input(INPUT_POST, htmlspecialchars($klic), FILTER_SANITIZE_SPECIAL_CHARS);
        }
        return $telo;
    }
}