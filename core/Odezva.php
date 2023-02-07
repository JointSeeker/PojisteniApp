<?php

namespace aplikace\core;
/**
 * Class Odezva
 *
 * @author JointSeeker <jointseeker@gmail.com>
 * @package app\core
 */
class Odezva
{
    public function nastavStatusKod(int $kod)
    {
        http_response_code($kod);
    }

    public function presmerovani(string $url)
    {
        header('Location: '. $url);
    }
}