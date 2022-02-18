<?php
    require __DIR__.'/vendor/autoload.php';

    use \App\Entity\tag;
    use \App\Entity\prod_tag;

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

    //echo "<pre>"; print_r($novo_produto); echo "</pre>"; exit;

    //VALIDAÇÂO DO POST
    if(isset($_POST['excluir'])){
        $recorrencias = prod_tag::getProdIds();
        foreach($recorrencias as $reco){
            if($reco->tag_id == $nova_tag->id){
                $reco->excluirByTag();
            }
        }
        $nova_tag->excluir();
        header('location:home_tag.php?status=success');
        exit;
    }
	include __DIR__.'/includes/header.php';
	include __DIR__.'/includes/confirmar_exclusao_tag.php';
	include __DIR__.'/includes/footer.php';

 ?>