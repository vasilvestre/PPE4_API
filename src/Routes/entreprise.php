<?php
/**
 * Created by PhpStorm.
 * User: vsilvestre
 * Date: 17/05/17
 * Time: 15:15
 */

$app->get('/entreprises', function(\Slim\Http\Request $request, \Slim\Http\Response $response, $args){
    $this->db;
    $results = R::findAll('entreprise');
    $newResponse = $response->withHeader('Content-type', 'application/json');
    return $newResponse->withJson($results);
});

$app->get('/entreprises/{id}/interventions', function(\Slim\Http\Request $request, \Slim\Http\Response $response, $args){
    $this->db;
    $id = $request->getAttribute('id');
    $result = R::find('intervention','id_entreprise = ?', [$id]);
    $newResponse = $response->withHeader('Content-type', 'application/json');
    return $newResponse->withJson($result);
});

$app->post('/entreprises', function(\Slim\Http\Request $request, \Slim\Http\Response $response, $args){
    $this->db;
    $params = $request->getHeaders();
    $result = R::dispense('entreprise');
    $result->nom = $params['HTTP_NOM'][0];
    $result->address = $params['HTTP_ADDRESS'][0];
    R::store($result);
    return $response->withStatus(201);
});