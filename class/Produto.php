<?php

class Produto{

    private $id;
    private $nome;
    private $preco;
    private $descricao;
    private $usado;
    private $categoria;
    private $tipoProduto;

    public function calculaImpostro(){ //polimorfismo cada classe filha tem seu % de calc
        return $this->preco * 0.195;
    }
    public function temIsbn(){
        return $this instanceof Livro;
    }
    public function temWaterMark(){
        return $this instanceof Ebook;
    }
    public function temTaxaImpressao(){
        return $this instanceof LivroFisico;
    }

    public function getId() { return $this->id; }
    public function setId($id){
        $this->id = $id;
        return $this;
    }
    public function getNome(){ return $this->nome; }
    public function setNome($nome){
        $this->nome = $nome;
        return $this;
    }
    public function getPreco(){ return $this->preco; }
    public function setPreco($preco){
        $this->preco = $preco;
        return $this;
    }
    public function getDescricao(){ return $this->descricao; }
    public function setDescricao($descricao){
        $this->descricao = $descricao;
        return $this;
    }
    public function getUsado() { return $this->usado; }
    public function setUsado($usado){
        $this->usado = $usado;
        return $this;
    }
    public function getCategoria(){ return $this->categoria; }
    public function setCategoria(Categoria $categoria){
        $this->categoria = $categoria;
        return $this;
    }

    public function getTipoProduto(){return $this->tipoProduto;}
    public function setTipoProduto($tipoProduto){
        $this->tipoProduto = $tipoProduto;
        return $this;
    }
}
?>