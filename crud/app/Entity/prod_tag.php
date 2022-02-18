<?php
    namespace App\Entity;

    use \App\Db\Database;
    use \PDO;
    use \PDOException;

    class prod_tag{
        /**
         * Recebe o id do produto
         * @var integer
         */
        public $product_id;

        /**
         * Recebe o id da tag
         * @var integer
         */
        public $tag_id;


        public function cadastrar(){
            //Inserir no banco
            $db_prod_tag = new Database('product_tag');
            $this->id = $db_prod_tag->insert([
                'product_id' => $this->product_id,
                'tag_id'     => $this->tag_id
            ]);
            #echo "<pre>"; print_r($this); echo "</pre>"; exit;
            return true;
        }

        /**
         * Método responsável por atualizar no banco de dados
         * @return boolean
         */
        public function atualizar(){
            return (new Database('product_tag'))->update('id = '.$this->id, [
                'product_id' => $this->product_id,
                'tag_id'     => $this->tag_id
            ]);
        }

        /**
         * Método responsável por excluir  no banco de dados
         * @return boolean
         */
        public function excluirByTag(){
            return (new Database('product_tag'))->delete('tag_id = '.$this->tag_id);
        }
        public function excluirByProduct(){
            return (new Database('product_tag'))->delete('product_id = '.$this->product_id);
        }

        public static function getProdIds($where = null, $order = null, $limit = null){
            return (new Database('product_tag'))->select($where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
        }
    }