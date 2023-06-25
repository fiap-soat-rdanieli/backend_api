<?php

namespace App\Api;

use App\Aplicacao\Produto\CadastrarProduto;
use App\Aplicacao\Produto\CadastrarProdutoDto;
use App\Aplicacao\Produto\EditarProduto;
use App\Aplicacao\Produto\EditarProdutoDto;
use App\Aplicacao\Produto\RemoverProduto;
use App\Aplicacao\Produto\RemoverProdutoDto;
use App\Dominio\Produto\Produto as PedidoProduto;
use App\Dominio\Produto\Propriedades\Categorias;
use App\Infra\Produto\Repositorios\RDBMS;
use Sohris\Http\Annotations\SessionJWT;
use Sohris\Http\Annotations\Needed;
use Sohris\Http\Annotations\HttpMethod;
use Sohris\Http\Annotations\Route;
use Sohris\Http\Router\RouterControllers\DRMRouter;
use Sohris\Http\Response;

use DomainException;
use Sohris\Http\Exceptions\StatusHTTPException;

class Produto extends DRMRouter
{


    /**
     *
     * @Route("/api/produto/lista")
     * @HttpMethod("GET")
     */
    public static function lista(\Psr\Http\Message\ServerRequestInterface $request)
    { 
        $repositorio = new RDBMS();
        try {
            $produtos = $repositorio->buscarTodos();
            return Response::Json(array_map(fn(PedidoProduto $produto) => $produto->toArray(), $produtos));
        } catch (DomainException $e) {
            return Response::Json(false);
        }
    }

    /**
     *
     * @Route("/api/produto/buscar")
     * @SessionJWT(false)
     * @HttpMethod("POST")
     * @Needed({
     *  "categoria"
     * })
     */
    public static function buscar(\Psr\Http\Message\ServerRequestInterface $request)
    {
        $repositorio = new RDBMS();
        try {
            $categoria = new Categorias($request->REQUEST['categoria']);
            $produtos = $repositorio->buscarCategoria($categoria);
            return Response::Json(array_map(fn(PedidoProduto $produto) => $produto->toArray(), $produtos));
        } catch (DomainException $e) {
            return Response::Json(false);
        }
    }

    /**
     *
     * @Route("/api/produto/cadastrar")
     * @HttpMethod("POST")
     * @Needed({
     *  "nome",
     *  "descricao",
     *  "categoria",
     *  "valor"
     * })
     */
    public static function cadastrar(\Psr\Http\Message\ServerRequestInterface $request)
    {
        try {
            $dadosProduto = new CadastrarProdutoDto(
                $request->REQUEST['nome'],
                $request->REQUEST['descricao'],
                $request->REQUEST['categoria'],
                $request->REQUEST['valor'],
            );
            $repositorio = new RDBMS();
            $useCase = new CadastrarProduto($repositorio);

            $useCase->executa($dadosProduto);
            return  Response::Json('ok');
        } catch (DomainException $e) {
            throw new StatusHTTPException($e->getMessage(), 500);
        }
    }

    /**
     *
     * @Route("/api/produto/editar")
     * @SessionJWT(false)
     * @HttpMethod("POST")
     * @Needed({
     *  "id",
     *  "campo",
     *  "valor"
     * })
     */
    public static function editar(\Psr\Http\Message\ServerRequestInterface $request)
    {
        try {
            $dadosProduto = new EditarProdutoDto(
                $request->REQUEST['id'],
                $request->REQUEST['campo'],
                $request->REQUEST['valor'],
            );

            $repositorio = new RDBMS();
            $useCase = new EditarProduto($repositorio);

            $useCase->executa($dadosProduto);
            return  Response::Json('ok');
        } catch (DomainException $e) {
            throw new StatusHTTPException($e->getMessage(), 500);
        }
    }

    /**
     *
     * @Route("/api/produto/remover")
     * @SessionJWT(false)
     * @HttpMethod("POST")
     * @Needed({
     *  "id"
     * })
     */
    public static function remover(\Psr\Http\Message\ServerRequestInterface $request)
    {
        try {
            $dadosProduto = new RemoverProdutoDto(
                $request->REQUEST['id'],
            );

            $repositorio = new RDBMS();
            $useCase = new RemoverProduto($repositorio);

            $useCase->executa($dadosProduto);
            return  Response::Json('ok');
        } catch (DomainException $e) {
            throw new StatusHTTPException($e->getMessage(), 500);
        }
    }
}
