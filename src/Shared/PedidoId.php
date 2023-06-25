<?php

namespace App\Shared;

use App\Dominio\Produto\Exceptions\PedidoIdInvalido;

final class PedidoId
{
    private string $uuid;

    public function __construct(string $id = "")
    {
        if (!empty($id)) {
            $this->uuid = $id;
        } else {
            $this->uuid = UUID::v4();
        }
    }

    public function __toString()
    {
        return $this->uuid;
    }

}
