<?php 

namespace KingDev\InstagramMvc\models;

use KingDev\InstagramMvc\lib\Model;
use PDO;
use PDOException;



class User extends Model{
    private  int $id;
    private array $post;
    private string $profile;

    public function __construct(
        private string $username,
        private string $password,
    )
    {
        $this->post = [];
        $this->profile = '';
        $this->id =  -1;
    }

    public function save(){
        try{
            //TODO: validate username and password
            $hash = $this->getHashedPassword($this->password);
            $query = $this->prepare('INSERT INTO users (username, password, profiles)
                                     VALUES (:username, :password, :profile)');      

             $query->execute([
                    'username' => $this->username,
                    'password' => $hash,
                    'profile' => $this->profile
                ]);
                return true;

        }catch(PDOException $e){
            error_log($e -> getMessage());
            return false;
        }
    }

    private function getHashedPassword(){
        return password_hash($this->password, PASSWORD_DEFAULT, ['cost' => 10]);
    }

    public function getId($value){
        return $this->id = $value;
    }
    public function setId(){
        return $this->id;
    }

    public function getUsername($value){
        return $this->username = $value;
    }
    public function setUsername(){
        return $this->username;
    }

    public function getProfile(){
        return $this->profile;
    }
    public function setProfile($value){
        return $this->profile = $value;
    }
    public function getPosts(){
        return $this->post;
    }
    public function setPosts($value){
        return $this->post = $value;
    }
    // Solo definit el get y set
    // si se implementa cambiar la contrasena se obtiene el password
    
}