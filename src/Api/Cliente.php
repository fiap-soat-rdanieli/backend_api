<?php

namespace App\Api;

use App\Aplicacao\Cliente\CadastrarCliente;
use App\Aplicacao\Cliente\CadastrarClienteDto;
use App\Dominio\Cliente\Cliente as ClienteCliente;
use App\Dominio\Cliente\Cpf;
use App\Infra\Cliente\Repositorios\Memoria;
use App\Infra\Cliente\Repositorios\RDBMS;
use Sohris\Http\Annotations\SessionJWT;
use Sohris\Http\Annotations\Needed;
use Sohris\Http\Annotations\HttpMethod;
use Sohris\Http\Annotations\Route;
use Sohris\Http\Router\RouterControllers\DRMRouter;
use Sohris\Http\Response;

use DomainException;
use Sohris\Http\Exceptions\StatusHTTPException;

class Cliente extends DRMRouter
{


    /**
     *
     * @Route("/api/cliente/lists")
     * @SessionJWT(false)
     * @HttpMethod("GET")
     */
    public static function list(\Psr\Http\Message\ServerRequestInterface $request)
    { 
        $repositorio = new RDBMS();
        try {
            $clientes = $repositorio->buscarTodos();
            return Response::Json(array_map(fn(ClienteCliente $cliente) => $cliente->toArray(), $clientes));
        } catch (DomainException $e) {
            return Response::Json(false);
        }
    }

    /**
     *
     * @Route("/api/cliente/buscar")
     * @SessionJWT(false)
     * @HttpMethod("POST")
     * @Needed({
     *  "cpf"
     * })
     */
    public static function buscar(\Psr\Http\Message\ServerRequestInterface $request)
    {
        $repositorio = new RDBMS();
        try {
            $cpf = new Cpf($request->REQUEST['cpf']);
            $cliente = $repositorio->buscarCpf($cpf);
            return Response::Json($cliente->toArray());
        } catch (DomainException $e) {
            return Response::Json(false);
        }
    }

    /**
     *
     * @Route("/api/cliente/cadastrar")
     * @SessionJWT(false)
     * @HttpMethod("POST")
     * @Needed({
     *  "cpf",
     *  "nome",
     *  "email"
     * })
     */
    public static function cadastrar(\Psr\Http\Message\ServerRequestInterface $request)
    {
        try {
            $dadosCliente = new CadastrarClienteDto(
                $request->REQUEST['cpf'],
                $request->REQUEST['nome'],
                $request->REQUEST['email'],
            );
            $repositorio = new RDBMS();
            $useCase = new CadastrarCliente($repositorio);

            $useCase->executa($dadosCliente);
            return  Response::Json('ok');
        } catch (DomainException $e) {
            throw new StatusHTTPException($e->getMessage(), 500);
        }
    }
}
