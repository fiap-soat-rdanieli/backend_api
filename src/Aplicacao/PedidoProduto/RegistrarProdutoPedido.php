<?php

namespace App\Aplicacao\PedidoProduto;

use App\Dominio\PedidoProduto\PedidoProduto;
use App\Dominio\PedidoProduto\Interfaces\RepositorioPedidoProduto;
use App\Shared\PedidoId;
use App\Shared\ProdutoId;

class RegistrarProdutoPedido
{

    private RepositorioPedidoProduto $repositorio;

    public function __construct(RepositorioPedidoProduto $repositorio)
    {
        $this->repositorio = $repositorio;
    }

    public function executa(RegistrarProdutoPedidoDto $dados): void
    {
        $this->repositorio->cadastrar(new PedidoProduto(new PedidoId($dados->id_pedido), new ProdutoId($dados->id_produto), $dados->observacao, $dados->quantidade));
    }
}
