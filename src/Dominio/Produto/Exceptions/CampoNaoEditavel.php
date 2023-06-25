<?php


namespace App\Dominio\Produto\Exceptions;


class CampoNaoEditavel extends \DomainException
{
    public function __construct(string $campo)
    {
        parent::__construct("O campo $campo nao pode ser editado!");
    }
}
