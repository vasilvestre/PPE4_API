<?php
// Routes
//    $firebase = Firebase::fromServiceAccount(__DIR__.'/Firebase/ppe4-db-firebase-adminsdk-094r8-34a6a11e6d.json');
//    $database = $firebase->getDatabase();
//    $reference = $database->getReference('Techniciens/0');
//    $snapshot = $reference->getSnapshot();

$app->get('/latlong', function(\Slim\Http\Request $request, \Slim\Http\Response $response, $args){
    $this->db;
    $positions = R::findAll('position', 'WHERE counter <> 0');
    foreach ($positions as &$position){
        $position->counter -= 1;
    }
    R::storeAll($positions);
    $newResponse = $response->withHeader('Content-type', 'application/json');
    return $newResponse->withJson($positions);
});

$app->put('/latlong', function(\Slim\Http\Request $request, \Slim\Http\Response $response, $args){
    $this->db;
    $params = $request->getHeaders();
    if ($params['HTTP_IMEI'] == null or $params['HTTP_X'] == null or $params['HTTP_Y'] == null){
        return $response->write('Veuillez spécifier votre IMEI et vos positions');
    }
    $presence = R::findOne('position', 'imei = ?', [$params['HTTP_IMEI'][0]]);
    if ($presence == null) {
        $message = 'Vous ne pouvez créer une nouvelle entrée.';
    }else{
        $presence->x = $params['HTTP_X'][0];
        $presence->y = $params['HTTP_Y'][0];
        $presence->updated_at = time();
        R::store($presence);
        $message = 'Technicien mit à jour !';
    }
    return $response->write($message);
});

$app->delete('/latlong', function(\Slim\Http\Request $request, \Slim\Http\Response $response, $args){
    $this->db;
    $params = $request->getHeaders();
    if ($params['HTTP_IMEI'] == null){
        return $response->write('Veuillez spécifier votre IMEI et vos positions');
    }
    $position = R::findOne('position', 'imei = ?', [$params['HTTP_IMEI'][0]]);
    $position == null ?:R::trash($position);
    if ($position == null){
        $message = 'Aucun IMEI est correspondant.';
    }else{
        R::trash($position);
        $message = 'IMEI supprimé de la base.';
    }

    return $response->write($message);
});