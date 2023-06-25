<?php


namespace App\Dominio\Cliente\Interfaces;

use App\Dominio\Cliente\Cliente;
use App\Dominio\Cliente\Cpf;

interface RepositorioCliente{

    public function cadastrar(Cliente $cliente):void;
    public function buscarCpf(Cpf $cliente): Cliente;
    /**
     * @return Cliente[]
     */
    public function buscarTodos(): array;

}