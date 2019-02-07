<?php 
class ProdutoDao{

    private $conexao;

    function __construct($conexao){
        $this->conexao = $conexao;
    }
    function listaProdutos(){
        $produtos = array();
        $query = "SELECT p.*, c.nome 'categoria_nome' FROM produto p
                    JOIN categorias c ON c.id = p.categoria_id
                ORDER BY nome";
        $resultado = mysqli_query($this->conexao, $query);
        
        while ( $produtoArray = mysqli_fetch_assoc($resultado) ){
            
            $categoria = new Categoria();
            $categoria->setNome($produtoArray['categoria_nome']);

            if ( $produtoArray['tipoProduto'] == 'LivroFisico') {
                $produto = new LivroFisico();
                $produto->setIsbn($produtoArray['isbn']);
                $produto->setTaxaImpressao($produtoArray['taxaImpressao']);
            
            } else if ($produtoArray['tipoProduto'] == 'Ebook') {
                $produto = new Ebook();
                $produto->setIsbn($produtoArray['isbn']);
                $produto->setWaterMark($produtoArray['waterMark']);
            
            }else{
                $produto = new Produto();
            }
            $produto->setId($produtoArray['id']);
            $produto->setNome($produtoArray['nome']);
            $produto->setPreco($produtoArray['preco']);
            $produto->setDescricao($produtoArray['descricao']);
            $produto->setUsado($produtoArray['usado']);
            $produto->setTipoProduto($produtoArray['tipoProduto']);
            $produto->setCategoria($categoria);
            array_push($produtos, $produto);  
        }
        return $produtos;
    }

    function buscaProduto($id){
        $query = "SELECT * FROM produto WHERE id = {$id}";
        $resultado = mysqli_query($this->conexao, $query);
        $produtoResult = mysqli_fetch_assoc($resultado);
        
        $categoria = new Categoria();
        $categoria->setId($produtoResult['categoria_id']);

        if ( $produtoResult['tipoProduto'] == "LivroFisico" ) {
            $produto = new LivroFisico();
            $produto->setIsbn($produtoResult['isbn']);
            $produto->setTaxaImpressao($produtoResult['taxaImpressao']);
        } else if ($produtoResult['tipoProduto'] == "Ebook") {
            $produto = new Ebook();
            $produto->setIsbn($produtoResult['isbn']);
            $produto->setwaterMark($produtoResult['waterMark']);            
        }else {
            $produto = new Produto();
        }
        $produto->setId($produtoResult['id']);
        $produto->setNome($produtoResult['nome']);
        $produto->setPreco($produtoResult['preco']);
        $produto->setDescricao($produtoResult['descricao']);
        $produto->setUsado($produtoResult['usado']);
        $produto->setTipoProduto($produtoResult['tipoProduto']);
        $produto->setCategoria($categoria);

        return $produto;
    }

    function insereProduto(Produto $produto){ 
        $produto->setNome( mysqli_real_escape_string($this->conexao, $produto->getNome()) );
        $produto->setDescricao( mysqli_real_escape_string($this->conexao, $produto->getDescricao()) );
        
        $waterMark = "";
        $isbn = "";
        $taxaImpressao = "0";
        if ($produto->temWaterMark()) $waterMark = $produto->getWaterMark();
        if ($produto->temIsbn())  $isbn = $produto->getIsbn();
        if ($produto->temTaxaImpressao()) $taxaImpressao = $produto->getTaxaImpressao();

        $query = "INSERT INTO produto 
            (nome
            , preco
            , descricao
            , categoria_id
            , usado
            , isbn
            , tipoProduto
            , taxaImpressao
            , waterMark) 
                  VALUES 
                  (
                     '{$produto->getNome()}'
                    , {$produto->getPreco()}
                    , '{$produto->getDescricao()}'
                    , '{$produto->getCategoria()->getId()}'
                    , {$produto->getUsado()}
                    , '{$isbn}'
                    , '{$produto->getTipoProduto()}'
                    , $taxaImpressao
                    , '{$waterMark}'
                  )"; 
        
        return mysqli_query($this->conexao, $query);
    }

    function alteraProduto(Produto $produto){
        if ($produto->temIsbn()) {
            $isbn = $produto->getIsbn();
        }
        $tipoProduto = get_class($produto);
        $waterMark = "";
        $taxaImpressao = "";
        if ($produto->temTaxaImpressao()){
            $taxaImpressao = $produto->getTaxaImpressao();
        } else if ($produto->temWaterMark()) {
            $waterMark = $produto->getWaterMark();
        }
        $query = "UPDATE produto SET 
                    nome='{$produto->getNome()}'
                    , preco={$produto->getPreco()} 
                    , descricao='{$produto->getDescricao()}'
                    , categoria_id={$produto->getCategoria()->getId()}
                    , usado={$produto->getUsado()} 
                    , tipoProduto='{$tipoProduto}'
                    , isbn='{$isbn}' 
                    , taxaImpressao='{$taxaImpressao}'
                    , waterMark='{$waterMark}' 
                 WHERE id = {$produto->getId()} " ; 

        return mysqli_query($this->conexao, $query);
    }

    function removeProduto($id){
        $query="DELETE FROM produto WHERE id = {$id}";
        return mysqli_query($this->conexao, $query);
    }

}

?>