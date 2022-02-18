<?php
    require __DIR__.'/vendor/autoload.php';

    use \App\Entity\produto;
    use \App\Entity\prod_tag;

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

    //echo "<pre>"; print_r($novo_produto); echo "</pre>"; exit;

    //VALIDAÇÂO DO POST
    if(isset($_POST['excluir'])){
        $prod_tag_temp = new prod_tag;
        $prod_tag_temp->product_id = $novo_produto->id;
        $prod_tag_temp->excluirByProduct();
        $novo_produto->excluir();
        header('location: produtos.php?status=success');
        exit;
    }
	include __DIR__.'/includes/header.php';
	include __DIR__.'/includes/confirmar_exclusao.php';
	include __DIR__.'/includes/footer.php';

 ?>