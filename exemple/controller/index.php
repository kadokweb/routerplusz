<?php

require dirname(__DIR__, 2) . "/vendor/autoload.php";
require __DIR__ . "/Test/Kadok.php";
require __DIR__ . "/Test/Name.php";

use KadokCode\Router\Router;

define("BASE", "https://www.localhost/Kadokcode/router/exemple/controller");
$router = new Router(BASE);

/**
 * routes
 */
$router->namespace("Test");

$router->get("/", "Kadok:home");
$router->get("/edit/{id}", "Kadok:edit");
$router->post("/edit/{id}", "Kadok:edit");

/**
 * group by routes and namespace
 */
$router->group("admin");

$router->get("/", "Kadok:admin");
$router->get("/user/{id}", "Kadok:admin");
$router->get("/user/{id}/profile", "Kadok:admin");
$router->get("/user/{id}/profile/{photo}", "Kadok:admin");

/**
 * named routes
 */
$router->group("name");
$router->get("/", "Name:home", "name.home");
$router->get("/hello", "Name:hello", "name.hello");

$router->get("/redirect", "Name:redirect", "name.redirect");
$router->get("/redirect/{category}/{page}", "Name:redirect", "name.redirect");
$router->get("/params/{category}/page/{page}", "Name:params", "name.params");

/**
 * Group Error
 */
$router->group("error")->namespace("Test");
$router->get("/{errcode}", "Kadok:notFound");

/**
 * execute
 */
$router->dispatch();

if ($router->error()) {
    var_dump($router->error());
    //router->redirect("/error/{$router->error()}");
}
