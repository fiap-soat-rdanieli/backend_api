<?php

namespace App\Infra\Pedido\Repositorios;

use App\Dominio\Cliente\Cliente;
use App\Dominio\Pedido\Pedido;
use App\Dominio\Pedido\Interfaces\RepositorioPedido;
use App\Shared\DataBase;
use App\Shared\PedidoId;
use DateTime;

class RDBMS implements RepositorioPedido
{

    public function novo(Pedido $pedido): Pedido
    {
        $proximo_pedido = $this->proximoPedidoDia();
        $pedido->setRefId($proximo_pedido);
        $dao = new DataBase;
        $query = "INSERT INTO soat.pedido VALUES (:id, :ref, :cpf, :status, :criado, 0, 0);";

        $dao->query($query, [
            'id' => $pedido->id(),
            'ref' => $proximo_pedido,
            'cpf' => $pedido->cliente()->cpf(),
            'status' => $pedido->status(),
            'criado' => $pedido->criado()
        ]);

        return $pedido;
    }

    private function proximoPedidoDia()
    {
        $dao = new DataBase;

        $query = "SELECT count(0) + 1 as pedido FROM soat.pedido WHERE timestamp_criado >= UNIX_TIMESTAMP(DATE'" . date('Y-m-d') . "')";
        $result = $dao->query($query);

        return $result['data'][0]['pedido'];
    }

    public function attStatus(PedidoId $id, string $status): void
    {

        $dao = new DataBase;

        $query = "UPDATE soat.pedido SET status = :status WHERE id = :id";

        $dao->query($query, [
            'status' => $status,
            'id' => $id
        ]);
    }

    public function buscarTodos(): array
    {
        $dao = new DataBase;

        $query = "SELECT * FROM soat.pedido p LEFT JOIN soat.cliente c ON p.cliente_cpf = c.cpf;";

        $result = $dao->query($query);

        return array_map(
            fn ($el) => new Pedido(new PedidoId($el['id']), $el['ref_id'], Cliente::fromInfo($el), $el['status'], new DateTime(strtotime($el['timestamp_criado'])), $el['timestamp_checkout'], $el['timestamp_finalizado'], $el['valor']),
            $result['data']
        );
    }

    public function buscarPorStatus(string $status): array
    {
        $dao = new DataBase;

        $query = "SELECT * FROM soat.pedido p LEFT JOIN soat.cliente c ON p.cliente_cpf = c.cpf WHERE p.status = :status;";

        $result = $dao->query($query, ['status' => $status]);

        return array_map(
            fn ($el) => new Pedido(new PedidoId($el['id']), $el['ref_id'], Cliente::fromInfo($el), $el['status'], new DateTime(strtotime($el['timestamp_criado'])), $el['timestamp_checkout'], $el['timestamp_finalizado'], $el['valor']),
            $result['data']
        );
    }

    public function checkout(PedidoId $id): void
    {
        
        $dao = new DataBase;

        $query = "UPDATE soat.pedido SET status = 'Checkout' , timestamp_checkout = UNIX_TIMESTAMP(NOW()) WHERE id = :id";

        $dao->query($query, [
            'id' => $id
        ]);
    }
}
