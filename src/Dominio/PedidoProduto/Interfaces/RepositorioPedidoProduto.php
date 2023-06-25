<?php


namespace App\Dominio\PedidoProduto\Interfaces;

use App\Dominio\PedidoProduto\PedidoProduto;
use App\Shared\PedidoId;
use App\Shared\ProdutoId;

interface RepositorioPedidoProduto{

    public function cadastrar(PedidoProduto $pp ):void;

    public function buscarPorPedido(PedidoId $id): array;

    public function remover(PedidoId $id, ProdutoId $prod_id): void;
    
}