<?php
require_once("../classes/autoload.php");

class Autor extends Persistencia{
    private $id_autor;
    private $nome;
    private $sobrenome;

    function __construct($id_autor = 0, $nome = "", $sobrenome = ""){
        $this->setIdAutor($id_autor);
        $this->setNome($nome);
        $this->setSobrenome($sobrenome);
    }

    function inserir(){
        $sql = "INSERT INTO Autor(nome, sobrenome) VALUES (:nome, :sobrenome)";
        $parametros = [
            ':nome' => $this->getNome(),
            ':sobrenome' => $this->getSobrenome(),
        ];
        Database::executar($sql, $parametros);
    }

    function alterar(){
        $sql = "UPDATE Autor SET nome = :nome, sobrenome = :sobrenome WHERE id_autor = :id_autor";
        $parametros = [
            ':id_autor' => $this->getIdAutor(),
            ':nome' => $this->getNome(),
            ':sobrenome' => $this->getSobrenome(),
        ];
        Database::executar($sql, $parametros);
    }

    function excluir(){
        $sql = "DELETE FROM Autor WHERE id_autor = :id_autor";
        $parametros = [
            ':id_autor' => $this->getIdAutor(),
        ];
        Database::executar($sql, $parametros);
    }

    public static function listar($tipo = 0, $busca = ""):array{
        $sql = "SELECT * FROM Autor";
        if($tipo > 0){
            switch($tipo){
                case 1: 
                    $sql .= " WHERE id_autor = :busca"; 
                    break;
                case 2: 
                    $sql .= " WHERE nome = :busca"; 
                    $busca = "%{$busca}%";
                    break;
                case 3: 
                    $sql .= ' WHERE sobrenome LIKE :busca';
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
        $autores = array();

        while($registro = $comando->fetch(PDO::FETCH_ASSOC)){
            $autor = new Autor($registro['id_autor'], $registro['nome'], $registro['sobrenome']);
            array_push($autores, $autor);
        }
        return $autores;
    }

    /**
     * Get the value of id_autor
     */
    public function getIdAutor(){
        return $this->id_autor;
    }

    /**
     * Set the value of id_autor
     */
    public function setIdAutor($id_autor): self{
        $this->id_autor = $id_autor;
        return $this;
    }

    /**
     * Get the value of nome
     */
    public function getNome(){
        return $this->nome;
    }

    /**
     * Set the value of nome
     */
    public function setNome($nome): self{
        $this->nome = $nome;
        return $this;
    }

    /**
     * Get the value of sobrenome
     */
    public function getSobrenome(){
        return $this->sobrenome;
    }

    /**
     * Set the value of sobrenome
     */
    public function setSobrenome($sobrenome): self{
        $this->sobrenome = $sobrenome;
        return $this;
    }
}
?>