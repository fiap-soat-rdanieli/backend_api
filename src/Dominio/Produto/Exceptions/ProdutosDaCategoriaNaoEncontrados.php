<?php


namespace App\Dominio\Produto\Exceptions;


class ProdutosDaCategoriaNaoEncontrados extends \DomainException
{
    public function __construct()
    {
        parent::__construct("Nenhum produto da categoria encontrado");
    }
}
