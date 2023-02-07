<?php

namespace aplikace\core;
/**
 * Class Kontroler
 *
 * @author JointSeeker <jointseeker@gmail.com>
 * @package aplikace\core
 */
class Kontroler
{
    public string $sablona = 'hlavni';
    /** Získání šablony pro ostatní kontrolery ve kterých se následně definuje
     * @param $sablona = html head a body
     * @return void
     */
    public function nastavSablonu($sablona)
    {
        $this->sablona = $sablona;
    }
    
    /**
     * @param $pohled
     * @param array $parametry
     * @return array|bool|string
     */
    public function zpracuj($pohled, array $parametry = [])
    {
        return Aplikace::$aplikace->smerovac->zpracujPohled($pohled, $parametry);
    }


}