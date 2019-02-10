<?php

class Categoria{

    private $id;
    private $nome;

    public function listar(){
        $query = 'SELECT * FROM categorias ORDER BY nome ';
        $conexao = Conexao::getConection();
        $result = $conexao->query($query);
        return $result->fetchAll();
    }

    public function atualizar(){
        $query = 'UPDATE categorias SET nome = :nome 
                WHERE id = :id ';
        $conexao = Conexao::getConection();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id', $this->id);
        $stmt->bindValue(':nome', $this->nome);
        return $stmt->execute();
    }

    public function buscaCategoria(){
        $query = 'SELECT * FROM categorias WHERE id = :id';
        $conexao = Conexao::getConection();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id', $this->id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function excluir(){
        $query = 'DELETE FROM categorias WHERE id = :id';
        $conexao = Conexao::getConection();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id', $this->id);
        return $stmt->execute();
    }

    public function inserir(){
        $query = 'INSERT INTO categorias (nome) VALUES (:nome)';
        $conexao = Conexao::getConection();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':nome', $this->nome);
        return $stmt->execute();
    }
    public function getNome() {return $this->nome;}
    public function setNome($nome){
        $this->nome = $nome;
        return $this;
    }

    public function getId(){ return $this->id; }
    public function setId($id) {
        $this->id = $id;
        return $this;
    }
}

?>