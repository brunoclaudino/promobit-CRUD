<?php
    require __DIR__.'/vendor/autoload.php';

    use \App\Entity\produto;
    use \App\Entity\tag;
    use \App\Entity\prod_tag;

    $tags = tag::getTags();

    include __DIR__.'/includes/header.php';

    $mensagem = '';
    if(isset($_GET['status'])){
        switch ($_GET['status']){
            case 'success':
                $mensagem = '<div class="alert alert-success">Ação executada com sucesso!</div>';
                break;
            
            case 'error':
                $mensagem = '<div class="alert alert-danger">Ação não executada!</div>';
                break;
        }
    }
    
    $resultados = '';
    foreach($tags as $tag){
        $resultados .= '<tr>
                           <td>'.$tag->id.'</td>
                           <td>'.$tag->name.'</td>
                           <td>
                                <a href="editar_tags.php?id='.$tag->id.'">
                                    <button type="button" class="btn btn-primary">Editar</button>
                                </a>

                                <a href="excluir_tags.php?id='.$tag->id.'">
                                    <button type="button" class="btn btn-danger">Excluir</button>
                                </a>
                            </td>
                        </tr>';
    }

    $resultados = strlen($resultados) ? $resultados : '<tr>
                                                        <td colspan="4" class="text-center">
                                                            Nenhuma Tag Encontrada
                                                        </td>
                                                        </tr>';

?>

<main>
    <?=$mensagem?>
    <section>
        <a href="cadastrar_tags.php">
            <button class="btn btn-success">Nova Tag</button></a>
    </section>

    <section>
        <table class="table bg-light mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                <?=$resultados?>
            </tbody>
        </table>
    </section>

</main>

<?php
	include __DIR__.'/includes/footer.php';
?>