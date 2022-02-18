<?php
    namespace App\Entity;

    use \App\Db\Database;
    use \PDO;
    use \PDOException;

    class tag{
        /**
         * Recebe o id da tag
         * @var integer
         */
        public $id;
        
        /**
         * Recebe o nome da tag
         * @var String
         */
        public $name;

        /**
         * Método responsável por cadastrar um novo produto no banco de dados
         * @return boolean
         */
        public function cadastrar(){
            //Inserir Produto no banco
            $db_produto = new Database('tag');
            $this->id = $db_produto->insert([
                'name' => $this->name
            ]);
            #echo "<pre>"; print_r($this); echo "</pre>"; exit;
            return true;
        }

        /**
         * Método responsável por atualizar uma tag no banco de dados
         * @return boolean
         */
        public function atualizar(){
            return (new Database('tag'))->update('id = '.$this->id, [
                'name' => $this->name
            ]);
        }

        /**
         * Método responsável por excluir uma tag no banco de dados
         * @return boolean
         */
        public function excluir(){
            return (new Database('tag'))->delete('id = '.$this->id);
        }

        /**
         * Método responsável por obter as tags do banco de dados
         * @param string $where
         * @param string $order
         * @param string $limit
         * @return array instancias de tag
         */
        public static function getTags($where = null, $order = null, $limit = null){
            return (new Database('tag'))->select($where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
        }

        /**
         * Método responsável por obter as tags do banco de dados
         * @param string $name
         * @return produto instancias de tag
         */
        public static function getTag($name){
            return (new Database('tag'))->select('name = "'.$name.'"')->fetchObject(self::class);
        }

         /**
         * Método responsável por obter as tags do banco de dados
         * @param integer $id
         * @return produto instancias de tag
         */
        public static function getTagById($id){
            return (new Database('tag'))->select('id = '.$id)->fetchObject(self::class);
        }
    }