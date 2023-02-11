<?php

namespace aplikace\core\formulare;

use aplikace\core\Model;
class Pole
{
    public const TYP_TEXT = 'text';
    public const TYP_HESLO = 'password';
    public const TYP_EMAIL = 'email';
    public const TYP_TELELEFON = 'tel';

    public const VALIDACE_TEXT = 'pattern="[A-Za-zěščřžýáíéóúůňťďĚŠČŘŽÝÁÍÉÚŮŇŤĎÓ]+"';
    public const VALIDACE_SMISENE = 'pattern="[A-Za-z0-9ěščřžýáíéóúůňťďĚŠČŘŽÝÁÍÉÚŮŇŤĎÓ]+"';


    public Model $model;
    public string $atribut;
    public string $validace;
    public string $typ;
    public string $stitek;

    /**
     * @param Model $model
     * @param string $atribut
     */
    public function __construct(Model $model, string $atribut)
    {
        $this->validace = '';
        $this->typ = self::TYP_TEXT;
        $this->model = $model;
        $this->atribut = $atribut;
    }

    public function __toString(): string
    {
        return sprintf(
            '
            <input type="%s" %s name="%s" class="form-control ml-2 %s" id="%s" placeholder="%s">
            <label for="%s" class="ml-2">%s</label>
            <div class="invalid-feedback">
               %s
            </div>',
        $this->typ,
        $this->validace,
        $this->atribut,
        $this->model->obsahujeChybu($this->atribut) ? ' is-invalid' : '',
        $this->atribut,
        $this->atribut,
        $this->atribut,
        //$this->model->stitky()[$this->atribut] ?? $this->atribut,
        $this->model->ziskejStitek($this->atribut),
        $this->model->ziskejPrvniChybu($this->atribut)
        );
    }

    public function poleHesla()
    {
        $this->typ = self::TYP_HESLO;
        return $this;
    }
    public function poleTelefonu()
    {
        $this->typ = self::TYP_TELELEFON;
        return $this;
    }
    public function poleEmailu()
    {
        $this->typ = self::TYP_EMAIL;
        return $this;
    }
    public function smisenePole()
    {
        $this->validace = self::VALIDACE_SMISENE;
        return $this;
    }

    public function poleTextu()
    {
        $this->validace = self::VALIDACE_TEXT;
        return $this;
    }


}