<?php


namespace App\Dominio\Produto\Exceptions;

use App\Shared\ProdutoId;

class ProdutoNaoEncontrado extends \DomainException
{
    public function __construct(ProdutoId $id)
    {
        parent::__construct("Produto $id nao foi encontrado");
    }
}
