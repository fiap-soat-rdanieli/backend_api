<?php

namespace App\Infra\PedidoProduto\Repositorios;

use App\Dominio\PedidoProduto\PedidoProduto;
use App\Dominio\PedidoProduto\Interfaces\RepositorioPedidoProduto;
use App\Shared\DataBase;
use App\Shared\PedidoId;
use App\Shared\ProdutoId;

class RDBMS implements RepositorioPedidoProduto
{
    public function cadastrar(PedidoProduto $produto): void
    {
        $dao = new DataBase;

        $query = "INSERT IGNORE soat.pedido_produtos VALUES (:ped_id,:prod_id, :quant, :obs)";

        $dao->query($query, [
            "ped_id" => $produto->pedido(),
            "prod_id" => $produto->produto(),
            "quant" => $produto->quantidade(),
            "obs" => $produto->observacao()
        ]);
    }

    public function buscarPorPedido(PedidoId $id): array
    {
        $dao = new DataBase;

        $query = "SELECT * FROM soat.pedido_produtos WHERE pedido_id = :id";

        $result = $dao->query($query, [
            "id" => $id
        ]);
        if (empty($result['data'])) {
            return [];
        }

        return array_map(
            fn ($el) => new PedidoProduto(new PedidoId($el['pedido_id']), new ProdutoId($el['produto_id']), $el['observacao'], $el['quantidade']),
            $result['data']
        );
    }

    public function remover(PedidoId $id, ProdutoId $id_prod): void
    {
        $dao = new DataBase;

        $query = "DELETE FROM soat.pedidos_produtos WHERE pedido_id = :id AND produto_id = :prod";

        $dao->query($query, [
            "id" => $id,
            "prod" => $id_prod
        ]);
    }
}
