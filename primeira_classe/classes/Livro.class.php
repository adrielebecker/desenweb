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
        $sql = 'INSERT INTO Livro (autor, genero, usuario, senha) VALUES (:autor, :genero, :usuario, :senha)';
        $parametros = array(':autor'=>$this->autor,
                            ':genero'=>$this->genero,
                            ':usuario'=>$this->getLogin()->getUsuario(),
                            ':senha'=>$this->getLogin()->getSenha());

        Database::executar($sql, $parametros);
        
        $this->endereco->setIdlivro(Database::$lastId);
        $this->endereco->incluir();
    }    

    public function excluir(){
        $sql = 'DELETE FROM livro WHERE id = :id';
        $parametros = array(':id'=> $this->id);
        return Database::executar($sql, $parametros);
    }  

    public function alterar(){
        $sql = 'UPDATE livro SET autor = :autor, genero = :genero, usuario = :usuario, senha = :senha WHERE id = :id';
        $parametros = array(':id'=>$this->id,
                            ':autor',$this->autor,
                            ':genero',$this->genero,
                            ':usuario',$this->login->getUsuario(),
                            ':senha',$this->login->getSenha());
        return Database::executar($sql, $parametros);
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
            $login = new Login($registro['usuario'], $registro['senha']);
            $enderecos = Endereco::listar(5, $registro['id']);
            $endereco = count($enderecos) > 0 ? $enderecos[0] : null;
            $livro = new Livro($registro['id'], $registro['autor'], $registro['genero'], $login, $endereco);
            array_push($livros,$livro);
        }
        return $livros; 
    }    
}

?>