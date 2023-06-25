<?php


namespace App\Dominio\Cliente\Exceptions;

use App\Dominio\Cliente\Cpf;

class ClienteNaoEncontrado extends \DomainException
{
    public function __construct(Cpf $cpf)
    {
        parent::__construct("Cliente com CPF $cpf não encontrado");
    }
}
