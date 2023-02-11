<?php

namespace aplikace\controllers;

use aplikace\core\Aplikace;
use aplikace\core\Pozadavek;
use aplikace\models\Pojistenci;



class PojistenecKontroler extends AutorizacniKontroler
{
    public function pojistenec(Pozadavek $pozadavek)
    {
        $pojistenec = new Pojistenci();
        if ($pozadavek->jeNastav()){
            $pojistenec->nactiData($pozadavek->ziskejTelo());
            if ($pojistenec->overeni() && $pojistenec->uloz()) {
                Aplikace::$aplikace->session->nastavFlash('uspech', 'Úspěšně jste zaregistroval pojištěnce s jeho pojištěním');
                Aplikace::$aplikace->odezva->presmerovani('pojistenci');
                exit;
            }

            $this->nastavSablonu('hlavni');
            return $this->zpracuj('pojistenci', ['model' => $pojistenec]);
        }
        $aplikace = Aplikace::$aplikace;
        $aplikace->pojistenci = $pojistenec->najdi();
        $this->nastavSablonu('hlavni');
        return $this->zpracuj('pojistenci', ['model' => $pojistenec]);
    }

    public function listPojistencu()
    {
        $pojistenec = new Pojistenci();
        if($_SESSION['pojistnik']){
            if($pojistenec->najdi()){
                $this->nastavSablonu('hlavni');
                return $this->zpracuj('pojistenci', ['pojistenec' => $pojistenec]);
            }
        }
        $this->nastavSablonu('hlavni');
        return $this->zpracuj('pojistenci', ['pojistenec' => $pojistenec]);
    }



}