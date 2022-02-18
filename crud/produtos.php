<?php
    require __DIR__.'/vendor/autoload.php';

    use \App\Entity\produto;
    use \App\Entity\tag;
    use \App\Entity\prod_tag;

    $prod = produto::getProdutos();

    for($i = 0; $i< count($prod); $i++){
        $prod_temp = new prod_tag();
        $prod_tags = $prod_temp->getProdIds('product_id = '.$prod[$i]->id);
        foreach($prod_tags as $tag){
            $tag_temp = new tag();
            $tag_temp = $tag_temp->getTagById($tag->tag_id);
            $prod[$i]->tags .= $tag_temp->name.',';
        }
    }

    #echo "<pre>"; print_r($prod); echo "</pre>"; exit;

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
    foreach($prod as $produto){
        $resultados .= '<tr>
                           <td>'.$produto->id.'</td>
                           <td>'.$produto->name.'</td>
                           <td>'.$produto->tags.'</td>
                           <td>
                                <a href="editar_produtos.php?id='.$produto->id.'">
                                    <button type="button" class="btn btn-primary">Editar</button>
                                </a>

                                <a href="excluir_produtos.php?id='.$produto->id.'">
                                    <button type="button" class="btn btn-danger">Excluir</button>
                                </a>
                            </td>
                        </tr>';
    }

    $resultados = strlen($resultados) ? $resultados : '<tr>
                                                        <td colspan="4" class="text-center">
                                                            Nenhum Produto Encontrado
                                                        </td>
                                                        </tr>';

    ?>

<main>
    <?=$mensagem?>
    <section>
        <a href="cadastrar_produtos.php">
            <button class="btn btn-success">Novo Produto</button></a>
    </section>

    <section>
        <table class="table bg-light mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Tag</th>
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