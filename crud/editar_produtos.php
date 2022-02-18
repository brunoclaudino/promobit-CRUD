<?php
    require __DIR__.'/vendor/autoload.php';

    define('TITLE', 'Editar Produto');

    use \App\Entity\produto;


    //Validação do ID
    if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
        header('location:produtos.php?status=error');
        exit;
    }

    //CONSULTA PRODUTO
    $novo_produto = produto::getProduto($_GET['id']);
    #echo "<pre>"; print_r($temp_produto); echo "</pre>"; exit;

    //VALIDAÇÂO DO PRODUTO
    if(!$novo_produto instanceof produto){
        exit;
    }

    //VALIDAÇÂO DO POST
    if(isset($_POST['nome'], $_POST['tag'])){
        $novo_produto->name = $_POST['nome'];
        $novo_produto->tags= $_POST['tag'];

        //echo "<pre>"; print_r($novo_produto); echo "</pre>"; exit;
        $novo_produto->atualizar();
        header('location: produtos.php?status=success');
        exit;
    }
	include __DIR__.'/includes/header.php';
	include __DIR__.'/includes/formulario_produto.php';
	include __DIR__.'/includes/footer.php';

 ?>