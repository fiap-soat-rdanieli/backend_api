<?php

namespace App\Aplicacao\PedidoProduto;


class BuscarProdutoPedidoDto
{
    public string $id_pedido;

    public function __construct(
        string $id_pedido
    ) {
        $this->id_pedido = $id_pedido;
    }
}
