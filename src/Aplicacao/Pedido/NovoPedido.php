<?php

namespace App\Aplicacao\Pedido;

use App\Dominio\Cliente\Cliente;
use App\Dominio\Cliente\Cpf;
use App\Dominio\Cliente\Email;
use App\Dominio\Pedido\Pedido;
use App\Dominio\Produto\Interfaces\RepositorioPedido;
use App\Shared\PedidoId;
use DateTime;

class NovoPedido
{

    private RepositorioPedido $repositorio;

    public function __construct(RepositorioPedido $repositorio)
    {
        $this->repositorio = $repositorio;
    }

    public function executa(NovoPedidoDto $dados): Pedido
    {
        $pedido = new Pedido(new PedidoId(), 0, new Cliente(new Cpf($dados->cpf), new Email(''), ''), "Criado", new DateTime(),0,0,0);
        return $this->repositorio->novo($pedido);
    }
}
