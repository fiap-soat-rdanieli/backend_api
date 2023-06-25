<?php

namespace App\Dominio\Produto;

use App\Dominio\Produto\Propriedades\Categorias;
use App\Dominio\Produto\Propriedades\Valor;
use App\Shared\ProdutoId;

class Produto
{
    private ProdutoId $id;
    private string $nome;
    private string $descricao;
    private Categorias $categoria;
    private Valor $valor;


    public function __construct(ProdutoId $id, string $nome, string $descricao, Categorias $categoria, Valor $valor)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->categoria = $categoria;
        $this->descricao = $descricao;
        $this->valor = $valor;
    }

    public static function create(string $id, string $nome, string $descricao, string $categoria, float $valor)
    {
        $produto = new self(new ProdutoId($id), $nome, $descricao, new Categorias($categoria), new Valor($valor));
        return $produto;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function nome(): string
    {
        return $this->nome;
    }

    public function categoria(): string
    {
        return $this->categoria;
    }

    public function valor(): string
    {
        return $this->valor;
    }

    public function descricao(): string
    {
        return $this->descricao;
    }
    
    public function setNome(string $nome):void
    {
        $this->nome = $nome;
    }

    public function setCategoria(Categorias $categoria): void
    {
        $this->categoria = $categoria;
    }

    public function setValor(Valor $valor): void
    {
        $this->valor = $valor;
    }

    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }

    public function toArray(): array
    {
        return ["id" => $this->id->__toString(), "nome" => $this->nome, "descricao" => $this->descricao, "valor" => $this->valor->__toString(), "categoria" => $this->categoria->__toString()];
    }
}
