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
        $produtos = [];
        $produtos_names = '';
        $registros = prod_tag::getProdIds('tag_id = '.$tag->id);
        //echo '<pre>'; print_r($registros); echo '</pre>';
        foreach($registros as $reg){
            if(isset($reg)){
                #echo '<pre>'; print_r($temp); echo '</pre>'; exit;
                #echo 'ID do Produto'.$reg->product_id;
                array_push($produtos, produto::getProduto($reg->product_id));
            }
        }
        foreach($produtos as $prod){
            #echo '<pre>'; print_r($prod); echo '</pre>';
            $produtos_names .= $prod->name.', ';
        }
        $resultados .= '<tr>
                           <td>'.$tag->id.'</td>
                           <td>'.$tag->name.'</td>
                           <td>'.$produtos_names.'</td>
                        </tr>';
    }

    $resultados = strlen($resultados) ? $resultados : '<tr>
                                                        <td colspan="4" class="text-center">
                                                            Nenhum Relatório Encontrado
                                                        </td>
                                                        </tr>';

?>

<main>
    <?=$mensagem?>

    <section>
        <table class="table bg-light mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Produtos</th>
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