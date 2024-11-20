<?php
require_once("../classes/autoload.php");

class Livro extends Persistencia{
    private $id_livro;
    private $titulo;
    private $ano_publicacao;
    private $foto_capa;
    private $categoria;
    private $preco;

    function __construct($id_livro = 0, $titulo = "", $ano_publicacao = "", $foto_capa = "", Categoria $categoria = null, $preco = ""){
        $this->setIdLivro($id_livro);
        $this->setTitulo($titulo);
        $this->setAnoPublicacao($ano_publicacao);
        $this->setFotoCapa($foto_capa);
        $this->setCategoria($categoria);
        $this->setPreco($preco);
    }

    function inserir(){
        $sql = "INSERT INTO Livro(titulo, ano_publicacao, foto_capa, categoria, preco) VALUES (:titulo, :ano_publicacao, :foto_capa, :categoria, :preco)";
        $parametros = [
            ':titulo' => $this->getTitulo(),
            ':ano_publicacao' => $this->getAnoPublicacao(),
            ':foto_capa' => $this->getFotoCapa(),
            ':categoria' => $this->getCategoria()->getIdCategoria(),
            ':preco' => $this->getPreco(),
        ];
        Database::executar($sql, $parametros);
    }

    function alterar(){
        $sql = "UPDATE Livro SET titulo = :titulo, ano_publicacao = :ano_publicacao, foto_capa = :foto_capa, categoria = :categoria, preco = :preco WHERE id_livro = :id_livro";
        $parametros = [
            ':id_livro' => $this->getIdLivro(),
            ':titulo' => $this->getTitulo(),
            ':ano_publicacao' => $this->getAnoPublicacao(),
            ':foto_capa' => $this->getFotoCapa(),
            ':categoria' => $this->getCategoria()->getIdCategoria(),
            ':preco' => $this->getPreco(),
        ];
        Database::executar($sql, $parametros);
    }

    function excluir(){
        $sql = "DELETE FROM Livro WHERE id_livro = :id_livro";
        $parametros = [
            ':id_livro' => $this->getIdLivro(),
        ];
        Database::executar($sql, $parametros);
    }

    public static function listar($tipo = 0, $busca = ""):array{
        $sql = "SELECT * FROM Livro";
        if($tipo > 0){
            switch($tipo){
                case 1: 
                    $sql .= " WHERE id_livro = :busca"; 
                    break;
                case 2: 
                    $sql .= " WHERE titulo = :busca"; 
                    $busca = "%{$busca}%";
                    break;
                case 3: 
                    $sql .= ' WHERE categoria LIKE :busca';
                    $busca = "%{$busca}%";
                    break;
                case 4: 
                    $sql .= ' WHERE preco LIKE :busca';
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
        $livros = array();

        while($registro = $comando->fetch(PDO::FETCH_ASSOC)){
            $categoria = Categoria::listar(1, $registro['categoria'])[0];
            $livro = new Livro($registro['id_livro'], $registro['titulo'], $registro['ano_publicacao'], $registro['foto_capa'], $categoria, $registro['preco']);
            array_push($livros, $livro);
        }
        return $livros;
    }

    /**
     * Get the value of id_livro
     */
    public function getIdLivro(){
        return $this->id_livro;
    }

    /**
     * Set the value of id_livro
     */
    public function setIdLivro($id_livro): self{
        $this->id_livro = $id_livro;
        return $this;
    }

    /**
     * Get the value of titulo
     */
    public function getTitulo(){
        return $this->titulo;
    }

    /**
     * Set the value of titulo
     */
    public function setTitulo($titulo): self{
        $this->titulo = $titulo;
        return $this;
    }

    /**
     * Get the value of ano de publicação
     */
    public function getAnoPublicacao(){
        return $this->ano_publicacao;
    }

    /**
     * Set the value of ano_publicacao
     */
    public function setAnoPublicacao($ano_publicacao): self{
        $this->ano_publicacao = $ano_publicacao;
        return $this;
    }

    /**
     * Get the value of foto_capa
     */
    public function getFotoCapa(){
        return $this->foto_capa;
    }

    /**
     * Set the value of foto_capa
     */
    public function setFotoCapa($foto_capa): self{
        $this->foto_capa = $foto_capa;
        return $this;
    }
    
    /**
     * Get the value of categoria
     */
    public function getCategoria(){
        return $this->categoria;
    }

    /**
     * Set the value of categoria
     */
    public function setCategoria(?Categoria $categoria): self{
        $this->categoria = $categoria;
        return $this;
    }
    
    /**
     * Get the value of preco
     */
    public function getPreco(){
        return $this->preco;
    }

    /**
     * Set the value of preco
     */
    public function setPreco($preco): self{
        $this->preco = $preco;
        return $this;
    }
}
?>