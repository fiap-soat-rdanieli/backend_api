<?php

namespace App\Aplicacao\Pedido;

use App\Dominio\Cliente\Cliente;
use App\Dominio\Cliente\Cpf;
use App\Dominio\Cliente\Email;
use App\Dominio\Pedido\Interfaces\RepositorioPedido;
use App\Dominio\Pedido\Pedido;
use App\Shared\PedidoId;
use DateTime;

class Checkout
{

    private RepositorioPedido $repositorio;

    public function __construct(RepositorioPedido $repositorio)
    {
        $this->repositorio = $repositorio;
    }

    public function executa(CheckoutDto $dados): void
    {
        $this->repositorio->checkout(new PedidoId($dados->pedido_id));
    }
}
