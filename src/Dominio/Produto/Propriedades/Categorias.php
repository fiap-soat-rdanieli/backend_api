<?php

namespace App\Dominio\Produto\Propriedades;

use InvalidArgumentException;

class Categorias
{
    const CATEGORIAS = ['lanche', 'bebida', 'acompanhamento', 'sobremesa'];

    private string $categoria;

    public function __construct(string $categoria)
    {

        if (!in_array($categoria, self::CATEGORIAS))
            throw new InvalidArgumentException('Categoria Invalida!');

        $this->categoria = $categoria;
    }

    public function __toString(): string
    {
        return $this->categoria;
    }
}
