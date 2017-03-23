<?php
// Routes

$setting = require __DIR__.'/settings.php';

$app = new \Slim\App($setting);

$app->group('/getdata' ,function() use($app){
    $app->get('/division/{name}','Middleware\ResponseData:getData_DailyFeedPrices');
});


$app->group('/postdata',function() use($app){
    $app->post('/zaeedata' ,'Middleware\RequestData:postData_DailyFeedPrices');
});

