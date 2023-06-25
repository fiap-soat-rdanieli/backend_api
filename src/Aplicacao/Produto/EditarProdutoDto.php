<?php
namespace App\Aplicacao\Produto;


class EditarProdutoDto
{
    public string $idProduto;
    public string $campoEdicao;
    public string $valorEdicao;


    public function __construct(string $id, string $campo, string $valor)
    {
        $this->idProduto = $id;
        $this->campoEdicao = $campo;
        $this->valorEdicao = $valor;
    }
}