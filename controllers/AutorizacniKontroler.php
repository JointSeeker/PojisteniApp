<?php

namespace aplikace\controllers;

use aplikace\core\Aplikace;
use aplikace\core\Kontroler;
use aplikace\core\Odezva;
use aplikace\core\Pozadavek;
use aplikace\models\Pojistnik;
use aplikace\models\Prihlaseni;

/**
 * Class AutorizacniKontroler
 *
 * @author JointSeeker <jointseeker@gmail.com>
 * @package aplikace\controllers
 */
class AutorizacniKontroler extends Kontroler
{
    public function prihlaseni(Pozadavek $pozadavek, Odezva $odezva)
    {
        $prihlaseni = new Prihlaseni();
        if($pozadavek->jeNastav()) {
            $prihlaseni->nactiData($pozadavek->ziskejTelo());
            if ($prihlaseni->overeni() && $prihlaseni->prihlaseni()) {
                $odezva->presmerovani('/');
                return;
            }
        }
        $this->nastavSablonu('autorizace');
        return $this->zpracuj('prihlaseni', [
            'model' => $prihlaseni
        ]);
    }


    public function registrace(Pozadavek $pozadavek)
    {
        $registrace = new Pojistnik();
        if ($pozadavek->jeNastav()){
            $registrace->nactiData($pozadavek->ziskejTelo());

            if ($registrace->overeni() && $registrace->uloz()) {
                Aplikace::$aplikace->session->nastavFlash('uspech', 'Děkujeme za vaši registraci');
                Aplikace::$aplikace->odezva->presmerovani('/');
                exit;
            }
            $this->nastavSablonu('autorizace');
            return $this->zpracuj('registrace', ['model' => $registrace]);
        }
        $this->nastavSablonu('autorizace');
        return $this->zpracuj('registrace', ['model' => $registrace]);
    }

    public function odhlaseni(Pozadavek $pozadavek, Odezva $odezva)
    {
        Aplikace::$aplikace->odhlaseni();
        $odezva->presmerovani('/');
    }
}
