<?php

namespace App\Aplicacao\Produto;

use App\Dominio\Produto\Interfaces\RepositorioProduto;
use App\Shared\ProdutoId;

class EditarProduto
{

    private RepositorioProduto $repositorioProduto;

    public function __construct(RepositorioProduto $repositorioProduto)
    {
        $this->repositorioProduto = $repositorioProduto;
    }

    public function executa(EditarProdutoDto $dados): void
    {
        $this->repositorioProduto->editar(new ProdutoId($dados->idProduto), $dados->campoEdicao, $dados->valorEdicao);
    }
}