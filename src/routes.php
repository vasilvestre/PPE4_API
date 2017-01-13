<?php
// Routes

$app->get('/techniciens', function (\Slim\Http\Request $request, \Slim\Http\Response $response, $args) {
    $uri = $request->getUri();
    $results = $this->db->query("SELECT loginT, prenom
            from technicien");
    $this->logger->info($results);
    $data = [
        'status' => 200,
        'request' => $uri->getPath(),
        'techniciens' => [
            '0' => [
                'name' => 'jean',
                'location' => [
                    'x' => 12,
                    'y' => 24
                ],
                'status' => 'away'
                ],
            '1' => [
                'name' => 'valentin',
                'location' => [
                    'x' => 69,
                    'y' => 34
                ],
                'status' => 'available'
            ],
            ]];
    $newResponse = $response->withJson($data);

    return $newResponse;
});

$app->get('/[{name}]', function ($request, \Slim\Http\Response $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});


