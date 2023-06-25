<?php

namespace App\Aplicacao\PedidoProduto;

use App\Dominio\PedidoProduto\PedidoProduto;
use App\Dominio\PedidoProduto\Interfaces\RepositorioPedidoProduto;
use App\Shared\PedidoId;
use App\Shared\ProdutoId;

class BuscarProdutoPedido
{

    private RepositorioPedidoProduto $repositorio;

    public function __construct(RepositorioPedidoProduto $repositorio)
    {
        $this->repositorio = $repositorio;
    }

    public function executa(BuscarProdutoPedidoDto $dados): array
    {
        return $this->repositorio->buscarPorPedido(new PedidoId($dados->id_pedido));
    }
}
