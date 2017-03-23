<?php
/**
 * Created by PhpStorm.
 * User: vsilvestre
 * Description : routing and method for positions
 */

$app->get('/positions', function(\Slim\Http\Request $request, \Slim\Http\Response $response, $args){
    $this->db;
    $results = R::findAll('position');
    $newResponse = $response->withHeader('Content-type', 'application/json');
    return $newResponse->withJson($results);
});

$app->get('/positions/{id}', function(\Slim\Http\Request $request, \Slim\Http\Response $response, $args){
    $this->db;
    $id = $request->getAttribute('id');
    $result = R::findOne('position','id = ?', [$id]);
    $newResponse = $response->withHeader('Content-type', 'application/json');
    return $newResponse->withJson($result);
});

$app->post('/positions', function(\Slim\Http\Request $request, \Slim\Http\Response $response, $args){
    $this->db;
    $params = $request->getHeaders();
    $result = R::dispense('position');
    $result->imei = $params['HTTP_IMEI'][0];
    $result->latitude = $params['HTTP_LATITUDE'][0];
    $result->longitude = $params['HTTP_LONGITUDE'][0];
    $result->technicien = $params['HTTP_ID_TECHNICIEN'][0];
    $result->created_at = Date('now');
    $result->updated_at = Date('now');
    R::store($result);
    return $response->withStatus(200);
});

$app->put('/positions/{imei}', function(\Slim\Http\Request $request, \Slim\Http\Response $response, $args){
    $this->db;
    $params = $request->getHeaders();
    $imei = $request->getAttribute('imei');
    $result = R::findOne('position','imei = ?', [$imei]);
    $result->latitude = $params['HTTP_LATITUDE'][0];
    $result->longitude = $params['HTTP_LONGITUDE'][0];
    $result->updated_at = time();
    R::store($result);
});

$app->delete('/positions/{id}', function(\Slim\Http\Request $request, \Slim\Http\Response $response, $args){
    $this->db;
    $id = $request->getAttribute('id');
    $result = R::findOne('position','id = ?', [$id]);
    R::trash($result);
});
