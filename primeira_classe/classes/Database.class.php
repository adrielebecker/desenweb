<?php
require_once('../config/config.inc.php');

/**
 * A classe Database é responsável pela conexão
 * com o banco de dados
 */
class Database{
    //private $conexao;
    
    static public $lastId;

    /** Método para criar conexão com o banco de dados */
    public static function getInstance(){ 
        try{ // com tratamento de exceção para conexão com o BD
            // conectar com o banco 
            return new PDO(DSN, USUARIO, SENHA);
        }catch(PDOException $e){ // se ocorrer algum erro - pega a exceção ocorrida 
            echo "Erro ao conectar ao banco de dados: ".$e->getMessage(); // ... e apresenta mensagem de erro para o usuário
        }
    }

    public static function conectar(){
        return Database::getInstance();
    }

    public static function preparar($conexao, $sql){
        return  $conexao->prepare($sql);
    }
    
    public static function vincular($comando,$parametros = array()){
        foreach($parametros as $key=>$value){
            $comando->bindValue($key,$value); 
        }
        return $comando;
    }

    public static function executar($sql,$parametros = array()){
        $conexao = self::conectar();
        //$conexao->beginTransaction();
        $comando = self::preparar($conexao,$sql);
        $comando = self::vincular($comando, $parametros);
        try {
            $comando->execute();
            self::$lastId = $conexao->lastInsertId();
            //$conexao->commit();
            return true;
        }catch(PDOException $e){
            //$conexao->rollBack();
            throw new Exception ("Erro ao executar o comando no banco de dados: "
               .$e->getMessage()." - ".$comando->errorInfo()[2]);
        }
    }
}