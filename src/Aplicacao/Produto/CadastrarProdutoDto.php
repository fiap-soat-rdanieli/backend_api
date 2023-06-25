<?php
namespace App\Aplicacao\Produto;


class CadastrarProdutoDto
{
    public string $nomeProduto;
    public string $descricaoProduto;
    public string $categoriaProduto;
    public string $valorProduto;


    public function __construct(string $nome, string $descricao, string $categoria, string $valor)
    {
        $this->nomeProduto = $nome;
        $this->descricaoProduto = $descricao;
        $this->categoriaProduto = $categoria;
        $this->valorProduto = $valor;
    }
}