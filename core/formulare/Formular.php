<?php

namespace aplikace\core\formulare;

use aplikace\core\Model;

class Formular
{
    public static function zacatek($action, $method): Formular
    {
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        return new Formular();
    }

    public static function konec()
    {
        echo '</form>';
    }

    public function pole(Model $model, $atribut): Pole
    {
        return new Pole($model, $atribut);
    }
}