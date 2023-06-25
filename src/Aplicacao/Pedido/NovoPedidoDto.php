<?php

namespace App\Aplicacao\Pedido;

use App\Shared\PedidoId;

class NovoPedidoDto
{
    public string $cpf;

    public function __construct(
        string $cpf
    ) {
        $this->cpf = $cpf;
    }
}
