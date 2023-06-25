<?php

namespace App\Dominio\Cliente;

class Cpf
{
    private $cpf;

    public function __construct($cpf = "")
    {

        $this->cpf = $cpf;
    }

    public function __toString(): string
    {
        return $this->cpf;
    }
}
