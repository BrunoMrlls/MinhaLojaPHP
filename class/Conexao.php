<?php 

class Conexao{

    public static function getConection(){
        $c = new PDO(DB_DRIVER.':host='.DB_HOST.';dbname='.DB_DATABASE, DB_USERNAME, DB_PASSWORD);
        $c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $c;
    }

}
