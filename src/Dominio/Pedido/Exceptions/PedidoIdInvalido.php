<?php


namespace App\Dominio\Produto\Exceptions;


class PedidoIdInvalido extends \DomainException
{
    public function __construct()
    {
        parent::__construct("O Id do Pedido Informado e invalido!");
    }
}
