<?php
    require __DIR__.'/vendor/autoload.php';

    define('TITLE', 'Cadastrar Tags');

    use \App\Entity\tag;

    $nova_tag = new tag;
    if(isset($_POST['nome'])){
        $nova_tag->name = $_POST['nome'];

        #echo "<pre>"; print_r($nova_tag); echo "</pre>"; exit;
        $nova_tag->cadastrar();
        header('location: home_tag.php?status=success');
        exit;
    }
	include __DIR__.'/includes/header.php';
	include __DIR__.'/includes/formulario_tag.php';
	include __DIR__.'/includes/footer.php';

 ?>