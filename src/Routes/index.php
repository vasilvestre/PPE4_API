<?php

$app->get('/', function (\Slim\Http\Request $request, \Slim\Http\Response $response, $args) {
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->post('/login_check', function (\Slim\Http\Request $request, \Slim\Http\Response $response, $args) {
    $this->db;
    $params = $request->getHeaders();
    $result = R::findOne('technicien', 'login = :login and password = :password', [
        ':login' => $params['HTTP_LOGIN'][0],
        ':password' => $params['HTTP_PASSWORD'][0]
    ]);
    return $result == null ? 'nop' : 'true';
});