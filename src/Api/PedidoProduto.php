<?php

namespace App\Api;

use App\Aplicacao\PedidoProduto\BuscarProdutoPedido;
use App\Aplicacao\PedidoProduto\BuscarProdutoPedidoDto;
use App\Aplicacao\PedidoProduto\RegistrarProdutoPedido;
use App\Aplicacao\PedidoProduto\RegistrarProdutoPedidoDto;
use App\Infra\PedidoProduto\Repositorios\RDBMS as RepositoriosRDBMS;
use Sohris\Http\Annotations\Needed;
use Sohris\Http\Annotations\HttpMethod;
use Sohris\Http\Annotations\Route;
use Sohris\Http\Router\RouterControllers\DRMRouter;
use Sohris\Http\Response;

use DomainException;
use Sohris\Http\Exceptions\StatusHTTPException;

class PedidoProduto extends DRMRouter
{

    /**
     *
     * @Route("/api/pedido_produto/add")
     * @HttpMethod("POST")
     * @Needed({
     *  "pedido_id",
     *  "produto_id",
     *  "observacao",
     *  "quantidade"
     * })
     */
    public static function add(\Psr\Http\Message\ServerRequestInterface $request)
    {
        try {
            $dadosProduto = new RegistrarProdutoPedidoDto(
                $request->REQUEST['pedido_id'],
                $request->REQUEST['produto_id'],
                $request->REQUEST['observacao'],
                $request->REQUEST['quantidade']
            );
            $repositorio = new RepositoriosRDBMS();
            $useCase = new RegistrarProdutoPedido($repositorio);

            $useCase->executa($dadosProduto);
            return  Response::Json("ok");
        } catch (DomainException $e) {
            throw new StatusHTTPException($e->getMessage(), 500);
        }
    }

    /**
     *
     * @Route("/api/pedido_produto/remove")
     * @HttpMethod("POST")
     * @Needed({
     *  "pedido_id",
     *  "produto_id"
     * })
     */
    public static function remove(\Psr\Http\Message\ServerRequestInterface $request)
    {
        try {
            $dadosProduto = new RegistrarProdutoPedidoDto(
                $request->REQUEST['pedido_id'],
                $request->REQUEST['produto_id'],
                $request->REQUEST['observacao'],
                $request->REQUEST['quantidade']
            );
            $repositorio = new RepositoriosRDBMS();
            $useCase = new RegistrarProdutoPedido($repositorio);

            $useCase->executa($dadosProduto);
            return  Response::Json("ok");
        } catch (DomainException $e) {
            throw new StatusHTTPException($e->getMessage(), 500);
        }
    }

    /**
     *
     * @Route("/api/pedido_produto/get")
     * @HttpMethod("POST")
     * @Needed({
     *  "pedido_id"
     * })
     */
    public static function get(\Psr\Http\Message\ServerRequestInterface $request)
    {
        try {
            $dadosProduto = new BuscarProdutoPedidoDto(
                $request->REQUEST['pedido_id']
            );
            $repositorio = new RepositoriosRDBMS();
            $useCase = new BuscarProdutoPedido($repositorio);

            $result = $useCase->executa($dadosProduto);
            return  Response::Json(array_map(fn ($el) => $el->toArray(), $result));
        } catch (DomainException $e) {
            throw new StatusHTTPException($e->getMessage(), 500);
        }
    }
}
