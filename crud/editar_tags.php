<?php
    require __DIR__.'/vendor/autoload.php';

    define('TITLE', 'Editar Tags');

    use \App\Entity\tag;


    //Validação do ID
    if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
        header('location:home_tag.php?status=error');
        exit;
    }

    //CONSULTA PRODUTO
    $nova_tag = tag::getTagById($_GET['id']);
    #echo "<pre>"; print_r($temp_produto); echo "</pre>"; exit;

    //VALIDAÇÂO DO PRODUTO
    if(!$nova_tag instanceof tag){
        exit;
    }

    //VALIDAÇÂO DO POST
    if(isset($_POST['nome'])){
        $nova_tag->name = $_POST['nome'];

        //echo "<pre>"; print_r($novo_produto); echo "</pre>"; exit;
        $nova_tag->atualizar();
        header('location: home_tag.php?status=success');
        exit;
    }
	include __DIR__.'/includes/header.php';
	include __DIR__.'/includes/formulario_tag.php';
	include __DIR__.'/includes/footer.php';

 ?>