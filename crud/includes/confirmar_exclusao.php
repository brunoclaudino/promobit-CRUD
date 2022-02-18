<main>

    <h2 class="mt-3">Excluir Vaga<h2>
    <form method="post">
        <div class="form-group">
           <p>Você deseja realmente excluir o item <strong><?=$novo_produto->name?></strong>?</p>
        </div>

        <div class="form-group">
            <a href="produtos.php">
                <button type="button" class="btn btn-success">Cancelar</button>
            </a>
            <button type="Submit" name="excluir" class="btn btn-danger">Confirmar</button>
        </div>
    </form>
