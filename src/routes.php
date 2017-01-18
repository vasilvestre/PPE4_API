<?php
// Routes

$app->get('/techniciens', function (\Slim\Http\Request $request, \Slim\Http\Response $response, $args) {
    $firebase = Firebase::fromServiceAccount(__DIR__.'/Firebase/ppe4-db-firebase-adminsdk-094r8-34a6a11e6d.json');
    $database = $firebase->getDatabase();
    $reference = $database->getReference('Techniciens/0');
    $snapshot = $reference->getSnapshot();
    var_dump($snapshot);die;
    $uri = $request->getUri();
    $data = [
        'status' => 200,
        'request' => $uri->getPath(),
        'techniciens' => [
            '0' => [
                'name' => 'Josh',
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
    return $this->renderer->render($response, 'index.html', $args);
});


