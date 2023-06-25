<?php
namespace App\Aplicacao\Cliente;


class CadastrarClienteDto
{
    public string $nomeCliente;
    public string $cpfCliente;
    public string $emailCliente;


    public function __construct(string $cpf, string $nome, string $email)
    {
        $this->nomeCliente = $nome;
        $this->cpfCliente = $cpf;
        $this->emailCliente = $email;
    }
}