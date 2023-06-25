<?php

namespace App\Dominio\PedidoProduto;

use App\Shared\PedidoId;
use App\Shared\ProdutoId;

class PedidoProduto
{
    private PedidoId $pedido;
    private ProdutoId $produto;
    private string $observacao;
    private int $quantidade;

    public function __construct(PedidoId $pedido, ProdutoId $produto, string $observacao, int $quantidade)
    {
        $this->pedido = $pedido;
        $this->produto = $produto;
        $this->observacao = $observacao;
        $this->quantidade = $quantidade;
    }

    public function pedido()
    {
        return $this->pedido;
    }

    public function produto()
    {
        return $this->produto;
    }

    public function observacao()
    {
        return $this->observacao;
    }

    public function quantidade()
    {
        return $this->quantidade;
    }

    public function toArray()
    {
        return [
            'pedido' => $this->pedido->__toString(),
            'produto' => $this->produto->__toString(),
            'observacao' => $this->observacao,
            'quantidade' => $this->quantidade
        ];
    }
}
