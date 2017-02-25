<?php

$app->get('/', function(\Slim\Http\Request $request, \Slim\Http\Response $response, $args){
    return $this->renderer->render($response, 'index.phtml', $args);
});