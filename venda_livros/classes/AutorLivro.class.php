<?php
require_once("../classes/autoload.php");

class AutorLivro extends Persistencia{
    private $id_autor_livro;
    private $autor;
    private $livro;

    function __construct($id_autor_livro = 0, $autor = 0, $livro = 0){
        $this->setAutorLivro($id_autor_livro);
        $this->setAutor($autor);
        $this->setLivro($livro);
    }

    function inserir(){
        $sql = "INSERT INTO AutorLivro(autor, livro) VALUES (:autor, :livro)";
        $parametros = [
            ':autor' => $this->getAutor(),
            ':livro' => $this->getLivro(),
        ];
        Database::executar($sql, $parametros);
    }

    function alterar(){
        $sql = "UPDATE AutorLivro SET autor = :autor, livro = :livro WHERE id_autor_livro = :id_autor_livro";
        $parametros = [
            ':id_autor_livro' => $this->getAutorLivro(),
            ':autor' => $this->getAutor(),
            ':livro' => $this->getLivro(),
        ];
        Database::executar($sql, $parametros);
    }

    function excluir(){
        $sql = "DELETE FROM AutorLivro WHERE id_autor_livro = :id_autor_livro";
        $parametros = [
            ':id_autor_livro' => $this->getAutorLivro(),
        ];
        Database::executar($sql, $parametros);
    }

    public static function listar($tipo = 0, $busca = ""):array{
        $sql = "SELECT * FROM AutorLivro";
        if($tipo > 0){
            switch($tipo){
                case 1: 
                    $sql .= " WHERE id_autor_livro = :busca"; 
                    break;
                case 2: 
                    $sql .= " WHERE autor = :busca"; 
                    break;
                case 2: 
                    $sql .= " WHERE livro = :busca"; 
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
        $obras = array();

        while($registro = $comando->fetch(PDO::FETCH_ASSOC)){
            $obra = new AutorLivro($registro['id_autor_livro'], $registro['autor'], $registro['livro']);
            array_push($obras, $obra);
        }
        return $obras;
    }

    /**
     * Get the value of autor-livro
     */
    public function getAutorLivro(){
        return $this->id_autor_livro;
    }

    /**
     * Set the value of autor-livro
     */
    public function setAutorLivro($id_autor_livro): self{
        $this->id_autor_livro = $id_autor_livro;
        return $this;
    }

     /**
     * Get the value of livro
     */
    public function getLivro(){
        return $this->livro;
    }

    /**
     * Set the value of livro
     */
    public function setLivro($livro): self{
        $this->livro = $livro;
        return $this;
    }

    /**
     * Get the value of autor
     */
    public function getAutor(){
        return $this->autor;
    }

    /**
     * Set the value of autor
     */
    public function setAutor($autor): self{
        $this->autor = $autor;
        return $this;
    }
}
?>