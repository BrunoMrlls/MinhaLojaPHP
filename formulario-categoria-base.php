        <div class="form-group">
            <label for="nome"> Nome da categoria</label>
            <input type="hidden" visible="false" name="id"
                value="<?=$categoria->getId()?>">
            <input name="nome" required="true" 
                type="text" class="form-control" 
                placeholder="Nome categoria"
                value="<?=$categoria->getNome()?>">
        </div>