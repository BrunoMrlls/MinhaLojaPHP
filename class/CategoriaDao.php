<?php

class CategoriaDao{

    private $conexao;

    function __construct($conexao){
        $this->conexao = $conexao;
    }

function listaCategorias(){
    $categorias = array();
    $query = "SELECT * FROM categorias";
    $resultado = mysqli_query($this->conexao, $query);
    while( $categoriaArray = mysqli_fetch_assoc($resultado) ){
        $categoria = new Categoria();
        $categoria->setId($categoriaArray['id']);
        $categoria->setNome($categoriaArray['nome']);
        
        array_push($categorias, $categoria);
    }
    return $categorias;
}


}


?>