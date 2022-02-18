<main>
    <section>
        <a href="home_tag.php">
        <button class="btn btn-success">Voltar</button>
        </a>
    </section>

    <h2 class="mt-3"><?=TITLE?><h2>
    <form method="post">
        <div class="form-group">
            <label>Nome</label>
            <input type="text" class="form-control" name="nome" placeholder="Nome da Tag" value="<?=$nova_tag->name?>">
        </div>

        <div class="form-group">
            <button type="Submit" class="btn btn-success">Salvar</button>
        </div>
    </form>

</main>