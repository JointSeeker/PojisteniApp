<?php

namespace aplikace\core;

abstract class PojistenciModel extends DbModel
{
    abstract public function ziskejJmenoProfilu(): string;
}