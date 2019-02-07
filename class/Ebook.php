<?php
    
class Ebook extends Livro{

    private $waterMark; //marca d'agua    

    public function getWaterMark(){return $this->waterMark;}
    public function setWaterMark($waterMark){
        $this->waterMark = $waterMark;
        return $this;
    }
}
?>