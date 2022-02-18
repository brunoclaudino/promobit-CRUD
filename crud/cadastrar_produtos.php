<?php
    require __DIR__.'/vendor/autoload.php';

    define('TITLE', 'Cadastrar Produto');

    use \App\Entity\produto;

    $novo_produto = new produto;
    if(isset($_POST['nome'], $_POST['tag'])){
        $novo_produto->name = $_POST['nome'];
        $novo_produto->tags= $_POST['tag'];

        #echo "<pre>"; print_r($novo_produto); echo "</pre>"; exit;
        $novo_produto->cadastrar();
        header('location: produtos.php?status=success');
        exit;
    }
	include __DIR__.'/includes/header.php';
	include __DIR__.'/includes/formulario_produto.php';
	include __DIR__.'/includes/footer.php';

 ?>