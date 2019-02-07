<?php
    
abstract class Livro extends Produto{

    private $isbn;

    public function calculaImpostro(){//polimorfismo imposto do livro é %6,5
        return $this->getPreco() * 0.065;
    }

    public function getIsbn(){return $this->isbn;}
    public function setIsbn($isbn){
        $this->isbn = $isbn;
        return $this;
    }
}

?>