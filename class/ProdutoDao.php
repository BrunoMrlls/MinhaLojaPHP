<?php 
require_once 'cabecalho.php';

class ProdutoDao{

    function listaProdutos(){
        $produtos = array();
        $query = "SELECT p.*, c.nome 'categoria_nome' FROM produto p
                    JOIN categorias c ON c.id = p.categoria_id
                ORDER BY nome";

        $conexao = Conexao::getConection();
        $result = $conexao->query($query);
        $lista = $result->fetchAll();

        foreach ($lista as $produtoArray) {    
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
        $query = "SELECT * FROM produto WHERE id = :id";
        $conexao = Conexao::getConection();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $produtoResult = $stmt->fetch();

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

        $waterMark = "";
        $isbn = "";
        $taxaImpressao = "0";
        if ($produto->temWaterMark()) $waterMark = $produto->getWaterMark();
        if ($produto->temIsbn()) $isbn = $produto->getIsbn();
        if ($produto->temTaxaImpressao()) $taxaImpressao = $produto->getTaxaImpressao();

        $query = " INSERT INTO produto 
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
                     :nome
                    , :preco
                    , :descricao
                    , :categoria_id
                    , :isUsado
                    , :isbn
                    , :tipoProduto
                    , :taxaImpressao
                    , :waterMark
                  ) "; 
        $conexao = Conexao::getConection();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':nome', $produto->getNome());
        $stmt->bindValue(':preco', $produto->getPreco());
        $stmt->bindValue(':descricao', $produto->getDescricao());
        $stmt->bindValue(':categoria_id', $produto->getCategoria()->getId());
        $stmt->bindValue(':isUsado', $produto->getUsado() == true ? 1 : 0);
        $stmt->bindValue(':isbn', $isbn);
        $stmt->bindValue(':tipoProduto', $produto->getTipoProduto());
        $stmt->bindValue(':taxaImpressao', $taxaImpressao);
        $stmt->bindValue(':waterMark', $waterMark);
        return $stmt->execute();
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
                      nome          = :nome
                    , preco         = :preco 
                    , descricao     = :descricao
                    , categoria_id  = :categoria_id
                    , usado         = :isUsado 
                    , tipoProduto   = :tipoProduto
                    , isbn          = :isbn 
                    , taxaImpressao = :taxaImpressao
                    , waterMark     = :waterMark 
                 WHERE id = :id " ; 
        $conexao = Conexao::getConection();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id', $produto->getId());
        $stmt->bindValue(':nome', $produto->getNome());
        $stmt->bindValue(':preco', $produto->getPreco());
        $stmt->bindValue(':descricao', $produto->getDescricao());
        $stmt->bindValue(':categoria_id', $produto->getCategoria()->getId());
        $stmt->bindValue(':isUsado', $produto->getUsado() == true ? 1 : 0);
        $stmt->bindValue(':tipoProduto', $tipoProduto);
        $stmt->bindValue(':isbn', $isbn);
        $stmt->bindValue(':taxaImpressao', $taxaImpressao);
        $stmt->bindValue(':waterMark', $waterMark);
        return $stmt->execute();
    }

    function removeProduto($id){
        $query="DELETE FROM produto WHERE id = :id";
        $conexao = Conexao::getConection();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

}

?>