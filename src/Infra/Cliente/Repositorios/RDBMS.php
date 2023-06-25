<?php


namespace App\Infra\Cliente\Repositorios;

use App\Dominio\Cliente\Cliente;
use App\Dominio\Cliente\Cpf;
use App\Dominio\Cliente\Email;
use App\Dominio\Cliente\Exceptions\ClienteNaoEncontrado;
use App\Dominio\Cliente\Interfaces\RepositorioCliente;
use App\Shared\DataBase;

class RDBMS implements RepositorioCliente
{
    public function cadastrar(Cliente $cliente): void
    {

        $dao = new DataBase;

        $query = "INSERT INTO soat.cliente VALUES (:cpf, :name, :email);";

        $dao->query($query, ['cpf' => $cliente->cpf(), 'name' => $cliente->nome(), 'email' => $cliente->email()]);
    }

    public function buscarCpf(Cpf $cpf): Cliente
    {
        $dao = new DataBase;

        $query = "SELECT * FROM soat.cliente WHERE cpf = :cpf";

        $result = $dao->query($query, ['cpf' => $cpf]);

        if (empty($result['data'])) {
            throw new ClienteNaoEncontrado($cpf);
        }

        return new Cliente($cpf, new Email($result['data'][0]['email']), $result['data'][0]['nome']);
    }

    public function buscarTodos(): array
    {
        $dao = new DataBase;

        $query = "SELECT * FROM soat.cliente;";

        $result = $dao->query($query);

        return array_map(
            fn ($el) => new Cliente(new Cpf($el['cpf']), new Email($el['email']), $el['nome']),
            $result['data']
        );
    }
}
