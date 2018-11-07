<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->group('/api', function () use ($app) {
    // Version group
    $app->get('/login/{numDocumento}&{contra}', 'login');
    $app->get('/ficha/{numeroFicha}', 'buscarFicha');
    $app->get('/ficha2', 'Ficha');
    $app->get('/buscarArticulo/{idArticulo}', 'buscarArticulo');
    $app->get('/idNovedad', 'buscarNovedad');
    $app->post('/crearNovedad', 'crearNovedad');
    $app->post('/articuloNovedad', 'articuloNovedad');
    $app->get('/ambiente/{idAmbiente}', 'buscarAmbiente');
    $id = '{id}';

});
