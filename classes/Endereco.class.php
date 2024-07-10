<?php
    require_once("../classes/Database.class.php");
    require_once("../classes/Login.class.php");

    class Endereco{
        private $idendereco;
        private $cep;
        private $pais;
        private $estado;
        private $cidade;
        private $bairro;
        private $rua;
        private $numero;
        private $complemento;
        private $idlivro;

        public function __construct($idendereco = 0, $cep = "null", $pais = "null", $estado = "null", $cidade = "null", $bairro = "null", $rua = "null", $numero = "null", $complemento = "null", $idlivro = 0){
            $this->setIdEndereco($idendereco);
            $this->setCep($cep);
            $this->setPais($pais);
            $this->setEstado($estado);
            $this->setCidade($cidade);
            $this->setBairro($bairro);
            $this->setRua($rua);
            $this->setNumero($numero);
            $this->setComplemento($complemento);
            $this->setIdlivro($idlivro);
        }
        /**
         * Get the value of idendereco
         */
        public function getIdEndereco(){
            return $this->idendereco;
        }

        /**
         * Set the value of idendereco
         */
        public function setIdEndereco($idendereco){
            $this->idendereco = $idendereco;
            return $this;
        }

        /**
         * Get the value of cep
         */
        public function getCep(){
            return $this->cep;
        }

        /**
         * Set the value of cep
         */
        public function setCep($cep){
            $this->cep = $cep;
            return $this;
        }

        /**
         * Get the value of pais
         */
        public function getPais(){
            return $this->pais;
        }

        /**
         * Set the value of pais
         */
        public function setPais($pais){
            $this->pais = $pais;
            return $this;
        }

        /**
         * Get the value of estado
         */
        public function getEstado(){
            return $this->estado;
        }

        /**
         * Set the value of estado
         */
        public function setEstado($estado){
            $this->estado = $estado;
            return $this;
        }

        /**
         * Get the value of cidade
         */
        public function getCidade(){
            return $this->cidade;
        }

        /**
         * Set the value of cidade
         */
        public function setCidade($cidade){
            $this->cidade = $cidade;
            return $this;
        }

        /**
         * Get the value of bairro
         */
        public function getBairro(){
            return $this->bairro;
        }

        /**
         * Set the value of bairro
         */
        public function setBairro($bairro){
            $this->bairro = $bairro;
            return $this;
        }

        /**
         * Get the value of rua
         */
        public function getRua(){
            return $this->rua;
        }

        /**
         * Set the value of rua
         */
        public function setRua($rua){
            $this->rua = $rua;
            return $this;
        }

        /**
         * Get the value of numero
         */
        public function getNumero(){
            return $this->numero;
        }

        /**
         * Set the value of numero
         */
        public function setNumero($numero){
            $this->numero = $numero;
            return $this;
        }

        /**
         * Get the value of complemento
         */
        public function getComplemento(){
            return $this->complemento;
        }

        /**
         * Set the value of complemento
         */
        public function setComplemento($complemento){
            $this->complemento = $complemento;
            return $this;
        }

        /**
         * Get the value of idlivro
         */
        public function getIdlivro(){
            return $this->idlivro;
        }

        /**
         * Set the value of idlivro
         */
        public function setIdlivro($idlivro){
            $this->idlivro = $idlivro;
            return $this;
        }

        public function incluir(){
            $conexao = Database::getInstance();
            $sql = 'INSERT INTO endereco(cep, pais, estado, cidade, bairro, rua, numero, complemento, idlivro) 
                    VALUES (:cep, :pais, :estado, :cidade, :bairro, :rua, :numero, :complemento, :idlivro)';
            $comando = $conexao->prepare($sql);
            $comando->bindValue(':cep', $this->cep);
            $comando->bindValue(':pais', $this->pais);
            $comando->bindValue(':estado', $this->estado);
            $comando->bindValue(':cidade', $this->cidade);
            $comando->bindValue(':bairro', $this->bairro);
            $comando->bindValue(':rua', $this->rua);
            $comando->bindValue(':numero', $this->numero);
            $comando->bindValue(':complemento', $this->complemento);
            $comando->bindValue(':idlivro', $this->idlivro);
            try {
                return $comando->execute();
            } catch (PDOException $e) {
                throw new Exception("Erro ao executar o comando no banco de dados: ".$e->getMessage()." - ".$comando->errorInfo()[2]);
            }
        }

        
    }
?>