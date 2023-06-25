<?php

namespace App\Aplicacao\PedidoProduto;


class RegistrarProdutoPedidoDto
{
    public string $id_pedido;
    public string $id_produto;
    public string $observacao;
    public int $quantidade;

    public function __construct(
        string $id_pedido,
        string $id_produto,
        string $observacao,
        int $quantidade
    ) {
        $this->id_pedido = $id_pedido;
        $this->id_produto = $id_produto;
        $this->observacao = $observacao;
        $this->quantidade = $quantidade;
    }
}
