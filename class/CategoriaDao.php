<?php
require_once 'cabecalho.php';

class CategoriaDao{

function listaCategorias(){
    $categorias = array();
    $query = "SELECT * FROM categorias";
    $conexao = Conexao::getConection();
    $result = $conexao->query($query);
    $lista = $result->fetchAll();
    
    foreach( $lista as $categoriaArray ){
        $categoria = new Categoria();
        $categoria->setId($categoriaArray['id']);
        $categoria->setNome($categoriaArray['nome']);
        
        array_push($categorias, $categoria);
    }
    return $categorias;
}


}


?>