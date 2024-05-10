<?php 

namespace KingDev\InstagramMvc\controllers;

use KingDev\InstagramMvc\lib\Controller;
use KingDev\InstagramMvc\lib\UtilImages;
use KingDev\InstagramMvc\models\User;

class Singup extends Controller{

    public function __construct(){
        parent::__construct();
    }

    public function register(){
        $username = $this->post('username');
        $password = $this->post('password');
        $profile = $this->file('profile');

        if(!is_null($username) &&
           !is_null($password) &&
          !is_null($profile)
          ){
           
            $pictureName= UtilImages::storeImage($profile);
            $user = new User($username, $password);
            $user->setProfile($pictureName);
            $user->save();
            header('location: /instagram-mvc/login');
        }else {
            $this->render('errors/index');
        }
    }

}


