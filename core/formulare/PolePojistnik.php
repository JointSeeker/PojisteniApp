<?php

namespace aplikace\core\formulare;

use aplikace\core\Aplikace;
use aplikace\core\Model;

class PolePojistenec
{
    public const TYP_TEXT = 'text';



    public const VALIDACE_TEXT = 'pattern="[A-Za-zěščřžýáíéóúůňťďĚŠČŘŽÝÁÍÉÚŮŇŤĎÓ]+"';
    public const VALIDACE_CISLO = 'pattern="[0-9]+"';


    public Model $model;
    public string $atribut;
    public string $validace;
    public string $typ;
    public string $stitek;

    /**
     * @param Model $model - volání objektu
     * @param string $atribut - volání atributu danného objektu
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
        $options = '';
        foreach (Aplikace::$aplikace->pojistenci as $pojistenec) {
            $id = htmlentities($pojistenec->ziskejIdPojistence());
            $jmeno = htmlentities($pojistenec->ziskejJmenoProfilu());
            $options .= sprintf('<option value="%s">%s</option>', $id, $jmeno);
        }

        return sprintf(
            '
        <select class="form-select %s" %s type="number" name="%s" required>
            <option selected value="" >%s</option>
            %s
        </select>
        <div class="invalid-feedback">
            %s
        </div>            
        ',
            $this->model->obsahujeChybu($this->atribut) ? ' is-invalid' : '',
            $this->validace,
            $this->atribut,
            $this->model->ziskejStitek($this->atribut),
            $options,
            $this->model->ziskejPrvniChybu($this->atribut)
        );
    }

    public function poleCislo()
    {
        $this->validace = self::VALIDACE_CISLO;
        return $this;
    }
}