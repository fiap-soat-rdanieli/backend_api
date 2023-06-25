<?php

namespace App\Aplicacao\Produto;

use App\Dominio\Produto\Interfaces\RepositorioProduto;
use App\Shared\ProdutoId;

class RemoverProduto
{

    private RepositorioProduto $repositorioProduto;

    public function __construct(RepositorioProduto $repositorioProduto)
    {
        $this->repositorioProduto = $repositorioProduto;
    }

    public function executa(RemoverProdutoDto $dados): void
    {
        $this->repositorioProduto->remover(new ProdutoId($dados->idProduto));
    }
}