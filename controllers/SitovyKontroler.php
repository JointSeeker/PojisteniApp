<?php
namespace aplikace\controllers;
use aplikace\core\Kontroler;
use aplikace\core\Pozadavek;

/**
 * Class SitovyKontroler
 *
 * @author JointSeeker <jointseeker@gmail.com>
 * @package aplikace\controllers
 */
class SitovyKontroler extends Kontroler
{
    public function home()
    {
        $parametry = [
            'jmeno' => "Jointseeker"
        ];
        return $this->zpracuj('home' , $parametry);
    }

    public function profil()
    {
        return $this->zpracuj('profil');
    }

    public function kontakt()
    {
        return $this->zpracuj('kontakt');
    }




    /**zacházení se zadanými daty z kontaktního formuláře
     */
    public function manipulujKontakt(Pozadavek $pozadavek)
    {
        $telo = $pozadavek->ziskejTelo();
        return 'Manipulace se zadanými daty';
    }
}