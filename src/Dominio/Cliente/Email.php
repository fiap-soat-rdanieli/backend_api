<?php

namespace App\Dominio\Cliente;

class Email
{
    private $email;

    public function __construct($email = "")
    {
        if (!empty($email))
            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                throw new \InvalidArgumentException(
                    'Endereço de e-mail inválido'
                );
            }

        $this->email = $email;
    }

    public function __toString(): string
    {
        return $this->email;
    }
}
