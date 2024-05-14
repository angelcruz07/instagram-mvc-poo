<?php 

namespace Instagram\lib;


class View {
    protected $d = [];

    public function __construct(){

    }
    
    function render(string $name, array $data = []){
        $this->d = $data;
        require 'src/views/' .$name. '.php';
    }
}