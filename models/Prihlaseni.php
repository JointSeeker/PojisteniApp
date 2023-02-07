<?php

namespace aplikace\models;

use aplikace\core\Aplikace;
use aplikace\core\Model;

class Prihlaseni extends Model
{
    public string $email = '';
    public  string $heslo = '';

    public function pravidla(): array
    {
        return [
            'email' => [self::PRAVIDLO_POZADOVANO, self::PRAVIDLO_EMAIL],
            'heslo' => [self::PRAVIDLO_POZADOVANO]
        ];
    }

    public function prihlaseni()
    {
        $pojistnik = Pojistnik::najdiJeden(['email' => $this->email]);
        if (!$pojistnik) {
            $this->pridejChybu('email', 'Uživatel s tímto emailem neexistuje');
            return false;
        }
        if (!password_verify($this->heslo, $pojistnik->heslo)) {
            $this->pridejChybu('heslo', 'Zadali jste špatné heslo. Zkuste to znovu');
            return false;
        }

        return Aplikace::$aplikace->prihlaseni($pojistnik);
    }

    public function stitky(): array
    {
        return [
            'email' => 'Email',
            'heslo' => 'Heslo'
        ];
    }
}