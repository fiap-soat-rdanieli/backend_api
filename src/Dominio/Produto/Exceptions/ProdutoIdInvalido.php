<?php


namespace App\Dominio\Produto\Exceptions;


class ProdutoIdInvalido extends \DomainException
{
    public function __construct()
    {
        parent::__construct("O Id do Produto Informado e invalido!");
    }
}
