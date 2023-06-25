<?php

namespace App\Aplicacao\Pedido;

class PedidosPorStatusDto
{
    public string $status;

    public function __construct(
        string $status
    ) {
        $this->status = $status;
    }
}
