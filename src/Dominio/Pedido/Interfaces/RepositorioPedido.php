<?php


namespace App\Dominio\Pedido\Interfaces;

use App\Dominio\Cliente\Cpf;
use App\Dominio\Pedido\Pedido;
use App\Shared\PedidoId;

interface RepositorioPedido{

    public function novo(Pedido $pedido): Pedido;

    /**
     * @return Pedidos[]
     */
    public function buscarTodos(): array;

    /**
     * @return Pedidos[]
     */
    public function buscarPorStatus(string $status): array;

    public function attStatus(PedidoId $id, string $status): void;

    public function checkout(PedidoId $id): void;

}