<?php
require_once("../classes/autoload.php");

class Categoria extends Persistencia{
    private $id_categoria;
    private $descricao;

    function __construct($id_categoria = 0, $descricao = ""){
        $this->setIdCategoria($id_categoria);
        $this->setDescricao($descricao);
    }

    function inserir(){
        $sql = "INSERT INTO Categorias(descricao) VALUES (:descricao)";
        $parametros = [
            ':descricao' => $this->getDescricao(),
        ];
        Database::executar($sql, $parametros);
    }

    function alterar(){
        $sql = "UPDATE Categorias SET descricao = :descricao WHERE id_categoria = :id_categoria";
        $parametros = [
            ':id_categoria' => $this->getIdCategoria(),
            ':descricao' => $this->getDescricao(),
        ];
        Database::executar($sql, $parametros);
    }

    function excluir(){
        $sql = "DELETE FROM Categorias WHERE id_categoria = :id_categoria";
        $parametros = [
            ':id_categoria' => $this->getIdCategoria(),
        ];
        Database::executar($sql, $parametros);
    }

    public static function listar($tipo = 0, $busca = ""):array{
        $sql = "SELECT * FROM Categorias";
        if($tipo > 0){
            switch($tipo){
                case 1: 
                    $sql .= " WHERE id_categoria = :busca"; 
                    break;
                case 2: 
                    $sql .= " WHERE descricao = :busca"; 
                    $busca = "%{$busca}%";
                    break;
                default:
                    throw new Exception("Tipo de busca inválido.");
            }
        }
        $parametros = array();

        if($tipo > 0){
            $parametros = array(':busca' => $busca);
        }

        $comando = Database::executar($sql, $parametros);
        $categorias = array();

        while($registro = $comando->fetch(PDO::FETCH_ASSOC)){
            $categoria = new Categoria($registro['id_categoria'], $registro['descricao']);
            array_push($categorias, $categoria);
        }
        return $categorias;
    }

    /**
     * Get the value of id_categoria
     */
    public function getIdCategoria(){
        return $this->id_categoria;
    }

    /**
     * Set the value of id_categoria
     */
    public function setIdCategoria($id_categoria): self{
        $this->id_categoria = $id_categoria;
        return $this;
    }

    /**
     * Get the value of descricao
     */
    public function getDescricao(){
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     */
    public function setDescricao($descricao): self{
        $this->descricao = $descricao;
        return $this;
    }
}
?>