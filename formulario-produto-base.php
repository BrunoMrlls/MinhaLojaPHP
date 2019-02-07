        <tr>
            <td>Nome:</td>
            <td>
                <input class="form-control" type="text" name="nome" value="<?=$produto->getNome()?>"><br/>
            </td>
        </tr>
        <tr>
            <td>Preço:</td>
            <td>
                <input class="form-control" type="number" name="preco" value="<?=$produto->getPreco()?>"><br/>
            </td>
        </tr>
        <tr>
            <td>Descrição:</td>
            <td>
                <textarea class="form-control" type="text" name="descricao"><?=$produto->getDescricao()?></textarea>
            </td>
        </tr> 
        <tr>
            <td></td>
            <td> <input type="checkbox" name="usado" value="<?=$produto->getUsado()?>" <?=$usado?>>Usado</td>
        </tr>
        <tr>
            <td>Categoria:</td>
            <td>
                <select class="form-control" name="categoria_id" >
                    <?php 
                        foreach ($categorias as $c):
                            $categoriaSelecionada = $produto->getCategoria()->getId() == $c->getId();
                            $selecao = $categoriaSelecionada ? "selected='selected'": "";
                    ?>
                        <option value="<?=$c->getId()?>" <?=$selecao?> > <?=$c->getNome()?> </option>
                    <?php endforeach?>
                </select>
            </td> 
        </tr> 
        <tr>
            <td>Tipo do Produto</td>
            <td>
                <select class="form-control" name="tipoProduto" >
                    <?php 
                        $tipos = array("Produto", "Livro Fisico", "Ebook");
                        foreach ($tipos as $tp):
                            $tipoSemCaracteresEspeciais = str_replace(" ", "", $tp); 
                            
                            $tipoProdutoSelecionado = get_class($produto) == $tp;
                            $selecao = $tipoProdutoSelecionado ? "selected='selected'": "";
                    ?>
                        <?php  if ($tp == "Livro Fisico") : ?>
                            <optgroup label="Livros">
                        <?php endif ?>
                                <option value="<?=$tipoSemCaracteresEspeciais?>" <?=$selecao?> > <?=$tp?> </option>
                        <?php if ($tp == "Ebook") :?>
                            </optgroup>
                        <?php endif ?>
                    <?php endforeach?>
                </select>
            </td>             
        </tr>
        <tr>
            <td>ISBN (caso seja um livro)</td>
            <td> <input class="form-control" type="text" name="isbn"
                 value="<?php if ($produto->temIsbn()){ echo $produto->getIsbn(); } ?>">
            </td>
        </tr>
        <tr>
            <td>Taxa de Impressão (caso seja um Livro Físico)</td>
            <td>
                <input type="text" class="form-control" name="taxaImpressao" 
                    value="<?php if ($produto->temTaxaImpressao()) { echo $produto->getTaxaImpressao(); } ?>" />
            </td>
         </tr>
        <tr>
            <td>WaterMark (caso seja um Ebook)</td>
            <td>
                <input type="text" class="form-control" name="waterMark" 
                    value="<?php if ($produto->temWaterMark()) { echo $produto->getWaterMark(); } ?>" />
            </td>
        </tr>