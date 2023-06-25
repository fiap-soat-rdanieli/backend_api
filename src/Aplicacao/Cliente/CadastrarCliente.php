<?php
namespace App\Aplicacao\Cliente;

use App\Dominio\Cliente\Cliente;
use App\Dominio\Cliente\Cpf;
use App\Dominio\Cliente\Email;
use App\Dominio\Cliente\Interfaces\RepositorioCliente;

class CadastrarCliente
{

    private RepositorioCliente $repositorioCliente;

    public function __construct(RepositorioCliente $repositorioCliente)
    {
        $this->repositorioCliente = $repositorioCliente;
    }

    public function executa(CadastrarClienteDto $dados): void
    {
        $cliente = new Cliente(new Cpf($dados->cpfCliente),  new Email($dados->emailCliente),$dados->nomeCliente);
        $this->repositorioCliente->cadastrar($cliente);
    }
}