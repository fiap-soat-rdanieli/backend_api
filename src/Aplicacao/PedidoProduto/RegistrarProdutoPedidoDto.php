<?php

namespace App\Aplicacao\PedidoProduto;


class RemoverProdutoPedidoDto
{
    public string $id_pedido;
    public string $id_produto;

    public function __construct(
        string $id_pedido,
        string $id_produto
    ) {
        $this->id_pedido = $id_pedido;
        $this->id_produto = $id_produto;
    }
}
