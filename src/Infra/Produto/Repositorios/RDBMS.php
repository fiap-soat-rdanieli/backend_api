<?php

namespace App\Infra\Produto\Repositorios;

use App\Dominio\Produto\Exceptions\CampoNaoEditavel;
use App\Dominio\Produto\Exceptions\ProdutosDaCategoriaNaoEncontrados;
use App\Dominio\Produto\Interfaces\RepositorioProduto;
use App\Dominio\Produto\Produto;
use App\Dominio\Produto\Propriedades\Categorias;
use App\Dominio\Produto\Propriedades\Valor;
use App\Shared\DataBase;
use App\Shared\ProdutoId;

class RDBMS implements RepositorioProduto
{

    public function cadastrar(Produto $produto): void
    {

        $dao = new DataBase;

        $query = "INSERT INTO soat.produto VALUES (:id, :nome, :desc, :cat, :valor);";

        $dao->query($query, [
            'id' => $produto->id(),
            'nome' => $produto->nome(),
            'desc' => $produto->descricao(),
            'cat' => $produto->categoria(),
            'valor' => $produto->valor()
        ]);
    }

    /**
     * @return Produto[]
     */
    public function buscarCategoria(Categorias $categoria): array
    {


        $dao = new DataBase;

        $query = "SELECT * FROM soat.produto WHERE categoria = :cat";

        $result = $dao->query($query, [
            'cat' => $categoria
        ]);

        if (empty($result['data'])) {
            throw new ProdutosDaCategoriaNaoEncontrados();
        }
        return array_map(
            fn ($el) => new Produto(new ProdutoId($el['id']), $el['nome'], $el['descricao'], new Categorias($el['categoria']), new Valor($el['valor'])),
            $result['data']
        );
    }
    /**
     * @return Produto[]
     */
    public function buscarTodos(): array
    {
        $dao = new DataBase;

        $query = "SELECT * FROM soat.produto;";

        $result = $dao->query($query);

        if (empty($result['data'])) {
            throw new ProdutosDaCategoriaNaoEncontrados();
        }
        return array_map(
            fn ($el) => new Produto(new ProdutoId($el['id']), $el['nome'], $el['descricao'], new Categorias($el['categoria']), new Valor($el['valor'])),
            $result['data']
        );
    }

    public function editar(ProdutoId $id, string $campo, string $valor): void
    {

        $params = [];
        $params[$campo] = $valor;
        switch ($campo) {
            case "nome":
            case "descricao":
            case "valor":
            case "categoria":
                break;
            default:
                throw new CampoNaoEditavel($campo);
        }

        $dao = new DataBase;

        $query = "UPDATE soat.produto SET $campo = :$campo";

        $dao->query($query, $params);
    }

    public function remover(ProdutoId $id): void
    { 
        $dao = new DataBase;
        $query = "DELETE FROM soat.produto WHERE id = :id";

        $dao->query($query, ["id" => $id]);
    }
}
