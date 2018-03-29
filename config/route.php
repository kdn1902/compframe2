<?php
return function(\FastRoute\RouteCollector $r) {
   $r->addRoute('GET', '/blog/{id:[0-9]+}', function ($request, $response) {
        return 'This is the post number'.$request->getAttribute('id');
    });
    $r->addRoute('GET', '/', '\App\Controllers\HelloController');
    $r->addRoute('GET', '/page[/{page}]', '\App\Controllers\HelloController');
};
