<?php
namespace App\Aplicacao\Produto;


class RemoverProdutoDto
{
    public string $idProduto;


    public function __construct(string $id)
    {
        $this->idProduto = $id;
    }
}