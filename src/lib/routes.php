<?php

use Instagram\controllers\Signup;
use Instagram\controllers\Login;

$router = new \Bramus\Router\Router();
session_start();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../config/');
$dotenv->load();


$router->get('/', function(){
    echo 'Inicio';
    echo $_ENV['DB'];
});

$router->get('/login', function(){
    // $controller = new Login();
    // $controller->render('login/index');
    echo 'login';
});

$router->post('/auth', function(){
    // $controller = new Login();
    // $controller->auth('login/index');
    echo 'login';
});

$router->get('/signup', function() { 
    $controller = new Signup();
    $controller->render('signup/index');
});

$router->post('/register', function(){
    $controller = new Signup();
    $controller->register();
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