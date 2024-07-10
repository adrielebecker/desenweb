<?php
require_once("../classes/Database.class.php");
require_once("../classes/Login.class.php");
require_once("../classes/Endereco.class.php");


class Livro{
    private $id;
    private $autor; 
    private $genero;
    private $login;
    private $endereco;

    public function __construct($id = 0, $autor = "null", $genero = "null", Login $login = null, Endereco $endereco = null){
        $this->setId($id); 
        $this->setAutor($autor);
        $this->setGenero($genero);
        $this->setLogin($login);
        $this->setEndereco($endereco);
    }

    public function setId($novoId){
        if ($novoId < 0)
            throw new Exception("Erro: id inválido!"); 
        else
            $this->id = $novoId;
    }

    public function setAutor($novoAutor){
        if ($novoAutor == "" && $novoAutor != null)
            throw new Exception("Erro: Autor inválido!");
        else
            $this->autor = $novoAutor;
    }
    public function setGenero($novoGenero){
        if ($novoGenero == "")
            throw new Exception("Erro: Gênero inválido!");
        else
            $this->genero = $novoGenero;
    }

    public function setLogin($login){ //posso definir como o tipo login e posso estabelecer um default
        $this->login = $login;
    }

    public function setEndereco($endereco){ 
        $this->endereco = $endereco;
    }

    public function getId(){
        return $this->id;
    }
    public function getAutor(){
        return $this->autor;
    }
    public function getGenero(){
        return $this->genero;
    }
    public function getLogin(){
        return $this->login;
    }
    
    public function getEndereco(){
        return $this->endereco;
    }

    public function incluir(){
        $conexao = Database::getInstance();
        $sql = 'INSERT INTO livro (autor, genero, usuario, senha) VALUES (:autor, :genero, :usuario, :senha)';
        // $conexao->beginTransaction();
        $comando = $conexao->prepare($sql); 
        $comando->bindValue(':autor',$this->autor);
        $comando->bindValue(':genero',$this->genero);
        $comando->bindValue(':usuario',$this->login->getUsuario()); //pega do objeto login, como é privado precisa usar o metódo get 
        $comando->bindValue(':senha',$this->login->getSenha());
        try {
            $comando->execute();
            $this->endereco->setIdlivro($conexao->lastInsertId());
            $this->endereco->incluir();
            // $conexao->commit();
            return true;
        } catch (PDOException $e) {
            // $conexao->rollBack();
            throw new Exception("Erro ao executar o comando no banco de dados: ".$e->getMessage()." - ".$comando->errorInfo()[2]);
        }
    }    

    public function excluir(){
        $conexao = Database::getInstance();
        $sql = 'DELETE FROM livro WHERE id = :id';
        $comando = $conexao->prepare($sql); 
        $comando->bindValue(':id', $this->id);
        return $comando->execute();
    }  

    public function alterar(){
        $conexao = Database::getInstance();
        $sql = 'UPDATE livro SET autor = :autor, genero = :genero, usuario = :usuario, senha = :senha WHERE id = :id';
        $comando = $conexao->prepare($sql); 
        $comando->bindValue(':id',$this->id);
        $comando->bindValue(':autor',$this->autor);
        $comando->bindValue(':genero',$this->genero);
        $comando->bindValue(':usuario',$this->login->getUsuario());
        $comando->bindValue(':senha',$this->login->getSenha());
        return $comando->execute();
    }    

    public static function listar($tipo = 0, $busca = "" ){
        $conexao = Database::getInstance();
        $sql = "SELECT * FROM livro";        
        if ($tipo > 0 )
            switch($tipo){
                case 1: $sql .= " WHERE id = :busca"; break;
                case 2: $sql .= " WHERE autor like :busca"; $busca = "%{$busca}%"; break;
                case 3: $sql .= " WHERE genero like :busca";  $busca = "%{$busca}%";  break;
            }

        $comando = $conexao->prepare($sql); 
        if ($tipo > 0 )
            $comando->bindValue(':busca',$busca);

        $comando->execute();
        $livros = array(); 

        while($registro = $comando->fetch()){
            $login = new Login($registro['id'], $registro['usuario'], $registro['senha']);
            // $endereco = new Endereco::listar(5, $registro['id'][0]);
            $livro = new Livro($registro['id'], $registro['autor'], $registro['genero'], $login);
            array_push($livros,$livro);
        }
        return $livros; 
    }    
}

?>