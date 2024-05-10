<?php

$router = new \Bramus\Router\Router();

session_start();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../config/');
$dotenv->load();


$router->get('/', function(){
    echo 'Inicio';
    echo $_ENV['DB'];
});

$router->get('/login', function(){
    echo 'Hola';
});


$router->post('/auth', function(){
    echo 'About';
});

$router->get('/signup', function(){
    echo 'About';
});

$router->post('/register', function(){
    echo 'About';
});

$router->get('/home', function(){
    echo 'home';
});

$router->post('/publish', function(){
    echo 'About';
});

$router->post('/profile', function(){
    echo 'About';
});

$router->get('/addLike', function(){
    echo 'About';
});

$router->get('/singout', function(){
    echo 'About';
});

$router->get('/profile/{username}', function($username){
    echo 'About';
});



$router->run();