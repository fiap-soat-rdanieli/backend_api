<?php

namespace Tests\Dominio\Cliente;

use App\Aplicacao\Cliente\CadastrarCliente;
use App\Aplicacao\Cliente\CadastrarClienteDto;
use App\Dominio\Cliente\Cpf;
use App\Infra\Cliente\Repositorios\Memoria;
use PHPUnit\Framework\TestCase;

class CadastrarClienteTest extends TestCase
{


    public function testCadastro()
    {
        $dadosCliente = new CadastrarClienteDto(
            '123.456.789-10',
            'Teste',
            'email@example.com',
        );
        $repositorio = new Memoria();
        $useCase = new CadastrarCliente(
            $repositorio
        );

        $useCase->executa($dadosCliente);

        $cliente = $repositorio->buscarCpf(new Cpf('123.456.789-10'));

        $this->assertSame('Teste', (string) $cliente->nome());
        $this->assertSame('email@example.com', (string) $cliente->email());
    }
}
