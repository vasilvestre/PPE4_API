<?php

$app->get('/', function (\Slim\Http\Request $request, \Slim\Http\Response $response, $args) {
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->post('/login_check', function (\Slim\Http\Request $request, \Slim\Http\Response $response, $args) {
    $this->db;
    $params = $request->getHeaders();
    $result = R::findOne('technicien', 'username = :username and password = :password', [
        ':username' => $params['HTTP_USERNAME'][0],
        ':password' => $params['HTTP_PASSWORD'][0]
    ]);
    $json['success'] = $result == null ? 'error' : 'success';
    $newResponse = $response->withHeader('Content-type', 'application/json');
    return $newResponse->withJson($json);
});