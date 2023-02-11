<?php

namespace aplikace\core;

abstract class PojistnikModel extends DbModel
{
    abstract public function ziskejJmenoProfilu(): string;
}