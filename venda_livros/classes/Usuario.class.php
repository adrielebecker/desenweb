<?php
    require_once("../classes/autoload.php");

    class Usuario extends Persistencia{
        private $id_usuario;
        private $nome;
        private $email;
        private $senha;
        private $cpf;
        private $nivel_permissao;

        function __construct($id_usuario = 0, $nome = "", $email = "", $senha = "", $cpf = "", $nivel_permissao = 0){
            $this->setIdUsuario($id_usuario);
            $this->setNome($nome);
            $this->setEmail($email);
            $this->setSenha($senha);
            $this->setCpf($cpf);
            $this->setNivelPermissao($nivel_permissao);
        }

        function inserir(){
            $sql = "INSERT INTO Usuario(nome, email, senha, cpf, nivel_permissao) VALUES (:nome, :email, :senha, :cpf, :nivel_permissao)";
            $parametros = [
                ':nome' => $this->getNome(),
                ':email' => $this->getEmail(),
                ':senha' => $this->getSenha(),
                ':cpf' => $this->getCpf(),
                ':nivel_permissao' => $this->getNivelPermissao(),
            ];
            Database::executar($sql, $parametros);
        }

        function alterar(){
            $sql = "UPDATE Usuario SET nome = :nome, email = :email, senha = :senha, cpf = :cpf, nivel_permissao = :nivel_permissao WHERE id_usuario = :id_usuario";
            $parametros = [
                ':id_usuario' => $this->getIdUsuario(),
                ':nome' => $this->getNome(),
                ':email' => $this->getEmail(),
                ':senha' => $this->getSenha(),
                ':cpf' => $this->getCpf(),
                ':nivel_permissao' => $this->getNivelPermissao(),
            ];
            Database::executar($sql, $parametros);
        }

        function excluir(){
            $sql = "DELETE FROM Usuario WHERE id_usuario = :id_usuario";
            $parametros = [
                ':id_usuario' => $this->getIdUsuario(),
            ];
            Database::executar($sql, $parametros);
        }

        public static function listar($tipo = 0, $busca = ""):array{
            $sql = "SELECT * FROM Usuario";
            if($tipo > 0){
                switch($tipo){
                    case 1: 
                        $sql .= " WHERE id_usuario = :busca"; 
                        break;
                    case 2: 
                        $sql .= " WHERE nivel_permissao = :busca"; 
                        break;
                    case 3: 
                        $sql .= ' WHERE nome LIKE :busca';
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
            $usuarios = array();

            while($registro = $comando->fetch(PDO::FETCH_ASSOC)){
                $usuario = new Usuario($registro['id_usuario'], $registro['nome'], $registro['email'], $registro['senha'], $registro['cpf'], $registro['nivel_permissao']);
                array_push($usuarios, $usuario);
            }
            return $usuarios;
        }

        /**
         * Get the value of id_usuario
         */
        public function getIdUsuario(){
            return $this->id_usuario;
        }

        /**
         * Set the value of id_usuario
         */
        public function setIdUsuario($id_usuario): self{
            $this->id_usuario = $id_usuario;
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
         * Get the value of email
         */
        public function getEmail(){
            return $this->email;
        }

        /**
         * Set the value of email
         */
        public function setEmail($email): self{
            $this->email = $email;
            return $this;
        }

        /**
         * Get the value of senha
         */
        public function getSenha(){
            return $this->senha;
        }

        /**
         * Set the value of senha
         */
        public function setSenha($senha): self{
            $this->senha = $senha;
            return $this;
        }

        /**
         * Get the value of cpf
         */
        public function getCpf(){
            return $this->cpf;
        }

        /**
         * Set the value of cpf
         */
        public function setCpf($cpf): self{
            $this->cpf = $cpf;
            return $this;
        }

        /**
         * Get the value of nivel_permissao
         */
        public function getNivelPermissao(){
            return $this->nivel_permissao;
        }

        /**
         * Set the value of nivel_permissao
         */
        public function setNivelPermissao($nivel_permissao): self{
            $this->nivel_permissao = $nivel_permissao;
            return $this;
        }
    }
?>