<?php
namespace App\Db;

use \PDO;

class Database{
    /**
     * Host de conexão com o banco de dados
     * @var string
     */
    const HOST = 'localhost';

    /**
     * Nome do banco de dados
     * @var string
     */
    const NAME = 'promobit';

    /**
     * User de conexão com o banco de dados
     * @var string
     */
    const USER = 'root';

    /**
     * Senha de conexão com o banco de dados
     * @var string
     */
    const PASS = '';

    /**
     * Nome da tabela a ser manipulada
     * @var string
     */
    private $table;

    /**
     * Instância de conexão com o banco de dados
     * @var PDO
     */
    private $connection;

    /**
     * Define tabela e instância de conexão
     * @param string
     */
    public function __construct($table = null){
        $this->table = $table;
        $this->setConnection();
    }

    /**
     * Método responsável por criar uma conexão com o banco de dados
     * 
     */
    private function setConnection(){
        try{
            $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME, self::USER, self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die('ERROR: '.$e->getMessage());
        }
    }


    /**
     * Método responsável por executar querys
     * @param string $query
     * @param array $params
     * @return PDOStatement
     */
    public function execute($query, $params = []){
        try{
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
        }catch(PDOException $e){
            die('ERROR: '.$e->getMessage());
        }
        
    }

    /**
     * Método responsável por inserir dados no banco
     * @param array $values [ campo => valor]
     * @return integer id
     */
    public function insert($values){
        //DADOS DA QUERY
        $fields = array_keys($values);
        $binds = array_pad([], count($fields), '?');
        #echo "<pre>";print_r($binds); echo "</pre>"; exit;

        //MONTA A QUERY
        $query = 'INSERT INTO '. $this->table. ' ('. implode(',',$fields). ') VALUES ('. implode(',', $binds) .')';

        //Executa o insert
        $this->execute($query, array_values($values));

        return $this->connection->lastInsertId();
    }

    /**
     * Método responsável por executar uma consulta no banco
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param string $fields
     * @return PDOStatement
     */
    public function select($where = null, $order = null, $limit = null, $fields = '*'){
        $where = strlen($where) ? 'WHERE '. $where : '';
        $order = strlen($order) ? 'ORDER BY '. $order : '';
        $limit = strlen($limit) ? 'LIMIT '. $limit : '';

        
        $query = 'SELECT '. $fields.' FROM '. $this->table. ' '.$where. ' '.$order. ' '.$limit;
        /*
        if($this->table == 'product_tag'){
            echo "<pre>"; print_r($query); echo "</pre>";
        }else if($this->table == 'product'){
            echo "<pre>"; print_r($query); echo "</pre>";
        }*/
        return $this->execute($query);
    }

    /**
     * Método responsável por executar atualizações no banco
     * @param string $where
     * @param array $values [fields => value]
     * @return boolean
     */
    public function update($where, $values){
        //Dados da query
        $fields = array_keys($values);
        //Monta Query
        $query = 'UPDATE '. $this->table. ' SET '.implode('=?,', $fields). '=? WHERE '.$where;

        //Executar a query
        $this->execute($query, array_values($values));
        return true;
    }

    /**
     * Método responsável por executar atualizações no banco
     * @param string $where
     * @return boolean
     */
    public function delete($where){
        //MONTA A QUERY
        $query = 'DELETE FROM '. $this->table. ' WHERE '.$where;

        //Executar a query
        $this->execute($query);
        return true;
    }

}