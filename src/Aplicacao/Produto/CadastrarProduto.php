<?php

namespace App\Aplicacao\Produto;

use App\Dominio\Produto\Interfaces\RepositorioProduto;
use App\Dominio\Produto\Produto;
use App\Dominio\Produto\Propriedades\Categorias;
use App\Dominio\Produto\Propriedades\Valor;
use App\Shared\ProdutoId;

class CadastrarProduto
{

    private RepositorioProduto $repositorioProduto;

    public function __construct(RepositorioProduto $repositorioProduto)
    {
        $this->repositorioProduto = $repositorioProduto;
    }

    public function executa(CadastrarProdutoDto $dados): void
    {
        $produto = new Produto(new ProdutoId(), $dados->nomeProduto, $dados->descricaoProduto, new Categorias($dados->categoriaProduto), new Valor((float)$dados->valorProduto));
        $this->repositorioProduto->cadastrar($produto);
    }
}