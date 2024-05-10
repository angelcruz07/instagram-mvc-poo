<?php 

namespace KingDev\InstagramMvc\lib;


class View {
    protected $d = [];
    
    function render(string $name, array $data = []){
        $this->d = $data;
        require 'src/views/'.$name.'.php';
    }
}