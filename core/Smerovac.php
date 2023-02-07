<?php
namespace aplikace\core;
/**
 * Class Smerovac
 *
 * @author JointSeeker <jointseeker@gmail.com>
 * @package aplikace\core
 */
class Smerovac
{
    public Pozadavek $pozadavek;
    public Odezva $odezva;
    protected array $trasy = [
        /* jak by to mělo pracovat
         * 'ziskej' => [
         * '/' => $zpetneVolani,
         * '/kontakt' => $zpetneVolani
         * ]
         * 'nastav' => *
         */
    ];

    /**
     * Constructor Směrovače
     *
     * @param Pozadavek $pozadavek
     * @param Odezva $odezva
     */
    public function __construct(Pozadavek $pozadavek, Odezva $odezva)
    {
        $this->pozadavek = $pozadavek;
        $this->odezva = $odezva;
    }


    /**
     * Získání trasy metodou GET
     * @param $cesta
     * @param $zpetneVolani
     * @return void
     */
    public function ziskej($cesta, $zpetneVolani)
    {
        $this->trasy['get'][$cesta] = $zpetneVolani;
    }

    /**
     * Získání trasy metodou POST
     * @param $cesta
     * @param $zpetneVolani
     * @return void
     */
    public function nastav($cesta, $zpetneVolani)
    {
        $this->trasy['post'][$cesta] = $zpetneVolani;
    }

    public function rozlis()
    {
        // $cesta vrací URL požadavek např.: "/uzivatel"
        $cesta = $this->pozadavek->ziskejCestu();
        // $metoda vrací požadavek na server 'post' nebo 'get'
        $metoda = $this->pozadavek->metoda();
        // $zpetneVolani určitou metodu pro určitou cestu pokud jí nenajde = false
        $zpetneVolani = $this->trasy[$metoda][$cesta] ?? false;
        //pokud bude false vrátí nenalezeno
        if ($zpetneVolani === false){
            $this->odezva->nastavStatusKod(404);
            return $this->zpracujPohled("_chyba");
        }
        // pokud zpetneVolani bude string, poskytne danný pohled
        if (is_string($zpetneVolani)){
            return $this->zpracujPohled($zpetneVolani);
        }
        // zpetneVolani je pole které obsahuje cestu kontroleru
        if (is_array($zpetneVolani)){
            Aplikace::$aplikace->kontroler = new $zpetneVolani[0]();
            $zpetneVolani[0] = Aplikace::$aplikace->kontroler;
        }
        //Vrátí danou metodu a cestu vloží do URL
        return call_user_func($zpetneVolani, $this->pozadavek, $this->odezva);
    }

    public function zpracujPohled($pohled, $parametry = [])
    {
        $sablonaObsah = $this->sablonaObsah();
        $pohledObsah = $this->zpracujPouzePohled($pohled, $parametry);
        return str_replace('{{obsah}}', $pohledObsah, $sablonaObsah);
    }

    protected function sablonaObsah()
    {
        $sablona = Aplikace::$aplikace->kontroler->sablona;
        ob_start();
        include_once Aplikace::$HLAVNI_SLOZKA."/views/sablony/$sablona.php";
        return ob_get_clean();
    }

    protected function zpracujPouzePohled($pohled, $parametry)
    {
        foreach ($parametry as $klic => $hodnota) {
            // dvojitý dolar udělá ze stringu proměnou
            $$klic = $hodnota;
        }
        ob_start();
        include_once Aplikace::$HLAVNI_SLOZKA."/views/$pohled.php";
        return ob_get_clean();
    }

    private function zpracujObsah($pohledObsah)
    {
        $sablonaObsah = $this->sablonaObsah();
        return str_replace('{{obsah}}', $pohledObsah, $sablonaObsah);
    }


}