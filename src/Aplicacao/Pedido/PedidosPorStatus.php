<?php

namespace App\Aplicacao\Pedido;

use App\Dominio\Produto\Interfaces\RepositorioPedido;

class PedidosPorStatus
{

    private RepositorioPedido $repositorio;

    public function __construct(RepositorioPedido $repositorio)
    {
        $this->repositorio = $repositorio;
    }

    public function executa(PedidosPorStatusDto $dados): array
    {
        return $this->repositorio->buscarPorStatus($dados->status);
    }
}
