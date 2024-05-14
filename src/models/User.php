<?php 

namespace Instagram\models;
use Instagram\lib\Model;
use PDO;
use PDOException;
use Instagram\lib\Database;


class User extends Model{
    private  int $id;
    private array $post;
    private string $profile;

    public function __construct(
        private string $username,
        private string $password,
    )
    {
        parent::__construct();
        $this->post = [];
        $this->profile = '';
        $this->id =  -1;
    }

    public static function exists($username){
        $query = $this->prepare('SELECT * FROM users WHERE username = :username');
        $query->execute([
            'username' => $username
        ]);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    private function getHashedPassword(){
        return password_hash($this->password, PASSWORD_DEFAULT, ['cost' => 10]);
    }

    public function comparePasswords($current){
        try{
            return password_verify($current, $this->password);
        }catch(PDOException $e){
            return NULL;
        }
    }

    public function save(){
        try{
            $hash = $this->getHashedPassword($this->password);
            $query = $this->prepare('INSERT INTO users (username, password, profile) VALUES(:username, :password, :profile)');
            $query->execute([
                'username'  => $this->username, 
                'password'  => $hash,
                'profile'  => $this->profile,
                ]);
            return true;
        }catch(PDOException $e){
            error_log($e -> getMessage());
            return false;
        }
    } 

    public static function get($username){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM users WHERE username = :username');
            $query->execute([ 'username' => $username]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            error_log($data['username']);
            error_log($data['password']);
            $user = new User($data['username'], $data['password']);
            $user->setId($data['user_id']);
            $user->setProfile($data['profile']);
            return $user;
        }catch(PDOException $e){
            return false;
        }
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