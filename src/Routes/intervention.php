<?php
/**
 * Created by PhpStorm.
 * User: vsilvestre
 * Description : routing and method for positions
 */

$app->get('/interventions', function(\Slim\Http\Request $request, \Slim\Http\Response $response, $args){
    $this->db;
    $results = R::findAll('intervention');
    $json = [
        'interventions' => array_values($results)
    ];
    $newResponse = $response->withHeader('Content-type', 'application/json');
    return $newResponse->withJson($json);
});

$app->get('/interventions/{id}', function(\Slim\Http\Request $request, \Slim\Http\Response $response, $args){
    $this->db;
    $id = $request->getAttribute('id');
    $result = R::findOne('intervention','id = ?', [$id]);
    $newResponse = $response->withHeader('Content-type', 'application/json');
    return $newResponse->withJson($result);
});

$app->post('/interventions', function(\Slim\Http\Request $request, \Slim\Http\Response $response, $args){
    $this->db;
    $params = $request->getHeaders();
    $result = R::dispense('intervention');
    $result->id_intervention = $params['HTTP_ID'][0];
    $result->entreprise = $params['HTTP_ENTREPRISE'][0];
    $result->address = $params['HTTP_ADDRESS'][0];
    $result->address_comp = $params['HTTP_ADDRESS_COMP'][0];
    $result->zipcode = $params['HTTP_ZIPCODE'][0];
    $result->city = $params['HTTP_CITY'][0];
    $result->contact_lastname = $params['HTTP_LASTNAME'][0];
    $result->contact_firstname = $params['HTTP_FIRSTNAME'][0];
    $result->contact_phone_number= $params['HTTP_PHONE_NUMBER'][0];
    $result->intervention_start = $params['HTTP_START'][0];
    $result->intervention_duration = $params['HTTP_DURATION'][0];
    $result->intervention_description = $params['HTTP_DESCRIPTION'][0];
    $result->picture = $params['HTTP_PICTURE'][0];//TODO: conversion base64 -> BLOB
    $result->updated_at = Date('now');
    $result->state = $params['HTTP_STATE'][0];
    $result->technicien = $params['HTTP_ID_TECHNICIEN'][0];
    R::store($result);
    return $response->withStatus(200);
});

$app->put('/interventions/{id}', function(\Slim\Http\Request $request, \Slim\Http\Response $response, $args){
    $this->db;
    $params = $request->getHeaders();
    $id = $request->getAttribute('id');
    $result = R::findOne('intervention','id = ?', [$id]);
    $result->state = $params['HTTP_STATE'][0];
    $result->updated_at = time();
    R::store($result);
});

$app->delete('/interventions/{id}', function(\Slim\Http\Request $request, \Slim\Http\Response $response, $args){
    $this->db;
    $id = $request->getAttribute('id');
    $result = R::findOne('intervention','id = ?', [$id]);
    R::trash($result);
});
