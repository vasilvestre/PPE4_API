<?php
// Routes

$app->post('/techniciens', function (\Slim\Http\Request $request, \Slim\Http\Response $response, $args) {
//    $firebase = Firebase::fromServiceAccount(__DIR__.'/Firebase/ppe4-db-firebase-adminsdk-094r8-34a6a11e6d.json');
//    $database = $firebase->getDatabase();
//    $reference = $database->getReference('Techniciens/0');
//    $snapshot = $reference->getSnapshot();
    $input = json_decode($request->getBody());
    $position = R::dispense('position');

    return $newResponse;
});

$app->get('/latlong', function(\Slim\Http\Request $request, \Slim\Http\Response $response, $args){
    $this->db;
    $positions = R::getAll('SELECT * FROM position');
    foreach ($positions as &$position){
        $counter = R::findOne('position',
            'IMEI = ?',[$position['IMEI']]
        );
        $counter->counter -= 1;
    }
    R::storeAll($positions);
    $positions = R::inspect('position');
    $newResponse = $response->withHeader('Content-type', 'application/json');
    return $newResponse->withJson($positions);
});



$app->get('/[{name}]', function ($request, \Slim\Http\Response $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.html', $args);
});


