<?php

namespace aplikace\models;

use aplikace\core\DbModel;

class Pojisteni extends DbModel
{

    static public function jmenoStolu(): string
    {
        return 'pojisteni';
    }


    static public function primarniKlic(): string
    {
        return 'id_pojisteni';
    }

}