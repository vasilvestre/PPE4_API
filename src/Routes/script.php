<?php

$app->post('/boucle_intervention', function(\Slim\Http\Request $request, \Slim\Http\Response $response, $args){
    $this->db;
    $interventions = R::findAll('intervention');
    foreach ($interventions as $intervention){
        $entreprise = R::dispense('entreprise');
        $entreprise->nom = $intervention->entreprise;
        $entreprise->address = $intervention->address;
        R::store($entreprise);
    }
    $interventions = R::findAll('entreprise');
    $newResponse = $response->withHeader('Content-type', 'application/json');
    return $newResponse->withJson($interventions);
});