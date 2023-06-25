<?php


namespace App\Dominio\Cliente\Exceptions;

use App\Dominio\Cliente\Cpf;

class ClienteJaCadastrado extends \DomainException
{
    public function __construct(Cpf $cpf)
    {
        parent::__construct("Cliente com CPF $cpf ja cadastrado");
    }
}
