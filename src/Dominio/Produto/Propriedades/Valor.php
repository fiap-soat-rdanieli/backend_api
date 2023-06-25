<?php

namespace App\Dominio\Produto\Propriedades;

use InvalidArgumentException;

class Valor
{
    private string $valor;

    public function __construct(float $valor)
    {

        if ($valor <= 0)
            throw new InvalidArgumentException('Valor Invalido!');

        $this->valor = $valor;
    }

    public function __toString(): string
    {
        return $this->valor;
    }
}
