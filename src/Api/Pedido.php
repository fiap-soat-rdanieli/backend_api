<?php

namespace App\Api;

use App\Aplicacao\Pedido\BuscarPedidos;
use App\Aplicacao\Pedido\Checkout;
use App\Aplicacao\Pedido\CheckoutDto;
use App\Aplicacao\Pedido\NovoPedido;
use App\Aplicacao\Pedido\NovoPedidoDto;
use App\Aplicacao\Pedido\PedidosPorStatus;
use App\Aplicacao\Pedido\PedidosPorStatusDto;
use App\Infra\Pedido\Repositorios\RDBMS;
use Sohris\Http\Annotations\Needed;
use Sohris\Http\Annotations\HttpMethod;
use Sohris\Http\Annotations\Route;
use Sohris\Http\Router\RouterControllers\DRMRouter;
use Sohris\Http\Response;

use DomainException;
use Sohris\Http\Exceptions\StatusHTTPException;

class Pedido extends DRMRouter
{

    /**
     *
     * @Route("/api/pedido/novo")
     * @HttpMethod("POST")
     * @Needed({
     *  "cliente"
     * })
     */
    public static function novo(\Psr\Http\Message\ServerRequestInterface $request)
    {
        try {
            $dadosProduto = new NovoPedidoDto(
                $request->REQUEST['cliente']
            );
            $repositorio = new RDBMS();
            $useCase = new NovoPedido($repositorio);

            $result = $useCase->executa($dadosProduto);
            return  Response::Json($result->id());
        } catch (DomainException $e) {
            throw new StatusHTTPException($e->getMessage(), 500);
        }
    }

    /**
     *
     * @Route("/api/pedido/lista")
     * @HttpMethod("GET")
     */
    public static function list(\Psr\Http\Message\ServerRequestInterface $request)
    {
        try {
            $repositorio = new RDBMS();
            $useCase = new BuscarPedidos($repositorio);
            $result = $useCase->executa();

            return  Response::Json(array_map(fn ($el) => $el->toArray(), $result));
        } catch (DomainException $e) {
            throw new StatusHTTPException($e->getMessage(), 500);
        }
    }

    /**
     *
     * @Route("/api/pedido/buscar_status")
     * @HttpMethod("POST")
     * @Needed({
     *  "status"
     * })
     */
    public static function buscar_status(\Psr\Http\Message\ServerRequestInterface $request)
    {
        try {
            $dadosProduto = new PedidosPorStatusDto(
                $request->REQUEST['status']
            );
            $repositorio = new RDBMS();
            $useCase = new PedidosPorStatus($repositorio);
            $result = $useCase->executa($dadosProduto);
            return  Response::Json(array_map(fn ($el) => $el->toArray(), $result));
        } catch (DomainException $e) {
            throw new StatusHTTPException($e->getMessage(), 500);
        }
    }

    /**
     *
     * @Route("/api/pedido/checkout")
     * @HttpMethod("POST")
     * @Needed({
     *  "id"
     * })
     */
    public static function checkout(\Psr\Http\Message\ServerRequestInterface $request)
    {
        try {
            $dadosProduto = new CheckoutDto(
                $request->REQUEST['id']
            );
            $repositorio = new RDBMS();
            $useCase = new Checkout($repositorio);
            $useCase->executa($dadosProduto);
            return  Response::Json("ok");
        } catch (DomainException $e) {
            throw new StatusHTTPException($e->getMessage(), 500);
        }
    }
}
