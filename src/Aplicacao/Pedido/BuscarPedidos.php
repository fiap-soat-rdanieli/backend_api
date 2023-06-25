<?php

namespace App\Aplicacao\Pedido;

use App\Dominio\Produto\Interfaces\RepositorioPedido;

class BuscarPedidos
{

    private RepositorioPedido $repositorio;

    public function __construct(RepositorioPedido $repositorio)
    {
        $this->repositorio = $repositorio;
    }

    public function executa(): array
    {
        return $this->repositorio->buscarTodos();
    }
}
