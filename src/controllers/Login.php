<?php

namespace Instagram\controllers;

use Instagram\lib\Controller;
use Instagram\models\User;


class Login extends Controller{

    function __construct()
    {
        parent::__construct();

        
    }

    public function auth($data){
        if(isset($data['username']) && isset($data['password'])){
            $username = $data['username'];
            $password = $data['password'];

            if(User::exists($username)){
                error_log('si existe');
                error_log('username: '.$username);
                $user = User::get($username);
                
                if($user->comparePasswords($password)){
                
                    $_SESSION["user"] = serialize($user);

                    header('location: home');
                }else{
                    echo "password incorrecto";
                }
            }else{
                header('location: /instagram/login');
            }
        }else{
            $this->render('errors/index');
        }
    }
}