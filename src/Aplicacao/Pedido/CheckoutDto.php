<?php

namespace App\Aplicacao\Pedido;


class CheckoutDto
{
    public string $pedido_id;

    public function __construct(
        string $pedido_id
    ) {
        $this->pedido_id = $pedido_id;
    }
}
