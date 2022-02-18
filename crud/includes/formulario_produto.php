<main>
    <section>
        <a href="produtos.php">
        <button class="btn btn-success">Voltar</button>
        </a>
    </section>

    <h2 class="mt-3"><?=TITLE?><h2>
    <form method="post">
        <div class="form-group">
            <label>Nome</label>
            <input type="text" class="form-control" name="nome" placeholder="Nome do Produto" value="<?=$novo_produto->name?>">
        </div>

        <div class="form-group">
            <label>Tags</label>
            <input type="text" class="form-control" name="tag" placeholder="Separadas por vírgula e sem espaços" value="<?=$novo_produto->tags?>">
        </div>

        <div class="form-group">
            <button type="Submit" class="btn btn-success">Salvar</button>
        </div>
    </form>

</main>