<?php

namespace App\Dominio\Cliente;

class Cliente
{
    private Cpf $cpf;
    private Email $email;
    private $nome;


    public function __construct(Cpf $cpf, Email $email, $nome = "")
    {
        $this->cpf = $cpf;
        $this->nome = $nome;
        $this->email = $email;
    }

    public static function fromInfo(array $info): self
    {
        var_dump($info);
        return new self(
            $info['cpf'] ? new Cpf($info['cpf']) : new Cpf(), 
            $info['email'] ? new Email($info['email']) : new Email(), 
            $info['nome']);
    }

    public function nome(): string
    {
        return $this->nome;
    }

    public function cpf(): Cpf
    {
        return $this->cpf;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function toArray(): array
    {
        return ["nome" => $this->nome, "email" => $this->email->__toString(), "cpf" => $this->cpf->__toString()];
    }
}
