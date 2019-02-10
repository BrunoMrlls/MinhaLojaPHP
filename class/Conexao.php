<?php 

class Conexao{

    public static function getConection(){
        return new PDO(DB_DRIVER.':host='.DB_HOST.';dbname='.DB_DATABASE, DB_USERNAME, DB_PASSWORD);
    }

}
