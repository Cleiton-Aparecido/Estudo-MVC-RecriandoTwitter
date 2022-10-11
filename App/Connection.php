<?php 
namespace App;

use Exception;

class connection{

    public function GetDb(){
        try{
            return new \PDO("mysql:dbname=twitter;host=localhost","root","");          
        }catch(Exception $e){
            echo "erro:".$e->getMessage();
        }
    }
}

?>