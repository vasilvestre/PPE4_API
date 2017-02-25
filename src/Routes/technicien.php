<?php
/**
 * Created by PhpStorm.
 * User: vsilvestre
 * Description : routing and method for positions
 */

$app->get('/techniciens', function(\Slim\Http\Request $request, \Slim\Http\Response $response, $args){
    $this->db;
    $results = R::findAll('technicien');
    $newResponse = $response->withHeader('Content-type', 'application/json');
    return $newResponse->withJson($results);
});

$app->get('/techniciens/{id}', function(\Slim\Http\Request $request, \Slim\Http\Response $response, $args){
    $this->db;
    $id = $request->getAttribute('id');
    $result = R::findOne('technicien','id = ?', [$id]);
    $newResponse = $response->withHeader('Content-type', 'application/json');
    return $newResponse->withJson($result);
});

$app->post('/techniciens', function(\Slim\Http\Request $request, \Slim\Http\Response $response, $args){
    $this->db;
    $params = $request->getHeaders();
    $result = R::dispense('technicien');
    $result->id_technicien = $params['HTTP_ID'][0];
    $result->login = $params['HTTP_LOGIN'][0];
    $result->password = $params['HTTP_PASSWORD'][0];
    R::store($result);
    return $response->withStatus(200);
});

$app->put('/techniciens/{id}', function(\Slim\Http\Request $request, \Slim\Http\Response $response, $args){
    $this->db;
    $params = $request->getHeaders();
    $id = $request->getAttribute('id');
    $result = R::findOne('technicien','id = ?', [$id]);
    //TODO: Qu'est ce qui peut être mit à jour ?
    $result->updated_at = time();
    R::store($result);
});

$app->delete('/techniciens/{id}', function(\Slim\Http\Request $request, \Slim\Http\Response $response, $args){
    $this->db;
    $id = $request->getAttribute('id');
    $result = R::findOne('technicien','id = ?', [$id]);
    R::trash($result);
});
