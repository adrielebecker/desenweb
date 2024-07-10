<?php
    require_once("../classes/Database.class.php");
    
    class Login{
        private $id;
        private $usuario;
        private $senha;

        public function __construct($id, $usuario = "null", $senha = "null"){
            $this->setId($id); 
            $this->setUsuario($usuario);
            $this->setSenha($senha);
        }
    
        public function setUsuario($novoUsuario){
            if ($novoUsuario == "" && $novoUsuario != null)
                throw new Exception("Erro: Usuário inválido!");
            else
                $this->usuario = $novoUsuario;
        }
        
        public function setId($novoId){
            if ($novoId == "" && $novoId != null)
                throw new Exception("Erro: Id inválido!");
            else
                $this->id = $novoId;
        }

        public function setSenha($novaSenha){
            if ($novaSenha == "" && $novaSenha != null){
                echo 's:'.$novaSenha;
                throw new Exception("Erro: Senha inválida!");
            }
            else
                $this->senha = $novaSenha;
        }

        public function getId(){
            return $this->id;
        }
        public function getUsuario(){
            return $this->usuario;
        }
        public function getSenha(){
            return $this->senha;
        }

        public static function efetuarLogin($usuario, $senha){
            $conexao = Database::getInstance();
            $sql = 'SELECT * FROM livro WHERE usuario = :usuario AND senha = :senha';
            $comando = $conexao->prepare($sql);
            $comando->bindValue(':usuario', $usuario); //é para segunça, evita q o user escreva um comando SQL
            $comando->bindValue(':senha', $senha); //exemplo o delete
            if($comando->execute()){
                while($registro = $comando->fetch()){
                    $login = new Login($registro['id'], $registro['usuario'], $registro['senha']);
                    $livro = new Livro($registro['id'], $registro['autor'], $registro['genero'], $login);
                    return $livro;
                }
            }
            return false;
        }
    }
?>