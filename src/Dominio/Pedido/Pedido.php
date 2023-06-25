<?php

namespace App\Dominio\Pedido;

use App\Dominio\Cliente\Cliente;
use App\Shared\PedidoId;
use DateTime;

class Pedido
{
    private PedidoId $id;
    private int $ref_id;
    private Cliente $cliente;
    private string $status;
    private DateTime $criado;
    private $checkout;
    private $finalizado;
    private float $valor;


    public function __construct(PedidoId $id, int $ref_id, Cliente $cliente, string $status, DateTime $criado, $checkout, $finalizado, float $valor)
    {
        $this->id = $id;
        $this->ref_id = $ref_id;
        $this->cliente = $cliente;
        $this->status = $status;
        $this->criado = $criado;
        $this->checkout = $checkout;
        $this->finalizado = $finalizado;
        $this->valor = $valor;
    }
    public function id(): string
    {
        return $this->id;
    }

    public function setRefId(int $id)
    {
        $this->ref_id = $id;
    }

    public function cliente()
    {
        return $this->cliente;
    }

    public function criado()
    {
        return $this->criado->format('U');
    }

    public function status()
    {
        return $this->status;
    }

    public function toArray()
    {
        return [
            "id" => $this->id,
            "ref_id" => $this->ref_id,
            "cliente" => $this->cliente->toArray(),
            "status" => $this->status,
            "criado" => $this->criado->format('U'),
            "checkout" => $this->checkout,
            "finalizado" => $this->finalizado,
            "valor" => $this->valor
        ];
    }
}
