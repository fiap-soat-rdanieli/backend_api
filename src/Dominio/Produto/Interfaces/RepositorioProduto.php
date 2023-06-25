<?php


namespace App\Dominio\Produto\Interfaces;

use App\Dominio\Produto\Produto;
use App\Dominio\Produto\Propriedades\Categorias;
use App\Shared\ProdutoId;

interface RepositorioProduto{

    public function cadastrar(Produto $cliente):void;

    /**
     * @return Produtos[]
     */
    public function buscarCategoria(Categorias $categoria): array;
    /**
     * @return Produtos[]
     */
    public function buscarTodos(): array;

    public function editar(ProdutoId $produto, string $campo, string $valor): void;

    public function remover(ProdutoId $produto): void;
    


}