<?php

class Connection{
    public static function connect(){
        $link = new PDO("mysql:host=localhost;dbname=procurement","root","");
        
        return $link;
    }
    
}
