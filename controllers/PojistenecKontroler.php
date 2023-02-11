<?php

namespace aplikace\controllers;

use aplikace\core\Aplikace;
use aplikace\core\Kontroler;
use aplikace\core\Pozadavek;
use aplikace\models\Pojistenec;


class RegistracniKontroler extends Kontroler
{
    public function pojistenec(Pozadavek $pozadavek)
    {
        $registrace = new Pojistenec();
        if ($pozadavek->jeNastav()){
            $registrace->nactiData($pozadavek->ziskejTelo());
            if ($registrace->overeni() && $registrace->uloz()) {
                Aplikace::$aplikace->session->nastavFlash('uspech', 'Úspěšně jste zaregistroval pojištěnce s jeho pojištěním');
                Aplikace::$aplikace->odezva->presmerovani('pojistenci');
                exit;
            }
            $this->nastavSablonu('hlavni');
            return $this->zpracuj('pojistenci', ['model' => $registrace]);
        }
        $this->nastavSablonu('hlavni');
        return $this->zpracuj('pojistenci', ['model' => $registrace]);
    }
}