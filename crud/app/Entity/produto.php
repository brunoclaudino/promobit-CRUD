<?php
    namespace App\Entity;

    use \App\Db\Database;
    use \PDO;
    use \PDOException;
    use \App\Entity\tag;
    use \App\Entity\prod_tag;

    class produto{

        /**
         * Recebe o id do produto
         * @var integer
         */
        public $id;
        
        /**
         * Recebe o nome do produto
         * @var String
         */
        public $name;

        /**
         * Recebe uma string com as tags do produto
         * @var integer
         */
        public $tags;

        /**
         * Método responsável por cadastrar um novo produto no banco de dados
         * @return boolean
         */
        public function cadastrar(){
            //Inserir Produto no banco
            $db_produto = new Database('product');
            $this->id = $db_produto->insert([
                'name' => $this->name
            ]);

            $tags_separadas = explode(",", $this->tags);
            foreach($tags_separadas as $tag){
                $tags = new tag();
                $tag_temp = new tag();
                $tag_temp->name = $tag;
                $tags = $tags->getTags();
                $tag_existente = false;
                foreach($tags as $tag_resultado){
                    if($tag_resultado->name == $tag){
                        $tag_temp = $tag_resultado;
                        $tag_existente = true;
                        break;
                    }
                }
                if(!$tag_existente){
                    $tag_temp->cadastrar();
                }
                $tag_temp = $tag_temp->getTag($tag_temp->name);
                $db_product_tag = new Database('product_tag');
                $db_product_tag->insert([
                    'product_id' => $this->id,
                    'tag_id'     => $tag_temp->id
                ]);
            }

            #echo "<pre>"; print_r($this); echo "</pre>"; exit;
            return true;
        }

        /**
         * Método responsável por atualizar um produto no banco de dados
         * @return boolean
         */
        public function atualizar(){
            $prod_tag_temp = new prod_tag;
            $prod_tag_temp->product_id = $this->id;
            $prod_tag_temp->excluirByProduct();
            $tags_separadas = explode(",", $this->tags);
            foreach($tags_separadas as $tag){
                $tag_temp = tag::getTag($tag);
                if($tag_temp->id == null){
                    $nova_tag = new tag;
                    $nova_tag->name = $tag;
                    $nova_tag->cadastrar();
                    $tag_temp = tag::getTag($tag);
                }
                $prod_tag_temp->tag_id = $tag_temp->id;
                $prod_tag_temp->cadastrar();
            }
            return (new Database('product'))->update('id = '.$this->id, [
                'name' => $this->name
            ]);
        }

        /**
         * Método responsável por excluir um produto no banco de dados
         * @return boolean
         */
        public function excluir(){
            return (new Database('product'))->delete('id = '.$this->id);
        }

        /**
         * Método responsável por obter os produtos do banco de dados
         * @param string $where
         * @param string $order
         * @param string $limit
         * @return array instancias de produto
         */
        public static function getProdutos($where = null, $order = null, $limit = null){
            return (new Database('product'))->select($where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
        }

        /**
         * Método responsável por obter os produtos do banco de dados
         * @param integer $id
         * @return produto instancias de produto
         */
        public static function getProduto($id){
            return (new Database('product'))->select('id = '.$id)->fetchObject(self::class);
        }

    }