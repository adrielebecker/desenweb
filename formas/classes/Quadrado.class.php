<?php
    require_once('Database.class.php');

    class Quadrado{
        private $id;
        private $unidadeMedida;
        private $lado;
        private $cor;

        public function __construct($id = 0, $unidadeMedida = "null", $lado = 0, $cor = "null"){
            $this->setId($id);
            $this->setUnidadeMedida($unidadeMedida);
            $this->setLado($lado);
            $this->setCor($cor);
        }

        public function inserir(){
            $sql = "INSERT INTO quadrado(id, unidadeMedida, lado, cor) VALUES (:id, :unidadeMedida, :lado, :cor)";
            $parametros = [':id' => $this->id,
                            ':unidadeMedida' => $this->unidadeMedida,
                            ':lado' => $this->lado,
                            ':cor' => $this->cor];

            Database::executar($sql, $parametros);
        }

        public function alterar(){
            $sql = "UPDATE quadrado SET unidadeMedida = :unidadeMedida, lado = :lado, cor = :cor WHERE id = :id";
            $parametros = [':id' => $this->id,
                            ':unidadeMedida' => $this->unidadeMedida,
                            ':lado' => $this->lado,
                            ':cor' => $this->cor];
            Database::executar($sql, $parametros);
        }

        public function excluir(){       
            $sql = 'DELETE FROM quadrado WHERE id = :id';
            $parametros = array(':id'=> $this->id);
            return Database::executar($sql, $parametros);
        }  

        public static function listar($tipo = 0, $busca = "" ){
            $conexao = Database::getInstance();
            $sql = "SELECT * FROM quadrado";        
            if ($tipo > 0 )
                switch($tipo){
                 case 1: $sql .= " WHERE id = :busca"; break;
                 case 2: $sql .= " WHERE cor like :busca"; $busca = "%{$busca}%"; break;
                 case 3: $sql .= " WHERE unidadeMedida like :busca";  $busca = "%{$busca}%";  break;
                }
            $comando = $conexao->prepare($sql); 
            if ($tipo > 0 ){
               $comando->bindValue(':busca',$busca);
            }

            $comando->execute();
            $quadrados = array(); 
            while($registro = $comando->fetch()){
               $quadrado = new Quadrado($registro['id'], $registro['unidadeMedida'], $registro['lado'], $registro['cor']);
               array_push($quadrados,$quadrado);
            }
            return $quadrados; 
        }    

        /**
         * Get the value of id
         */
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         */
        public function setId($id): self
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of unidadeMedida
         */
        public function getUnidadeMedida()
        {
                return $this->unidadeMedida;
        }

        /**
         * Set the value of unidadeMedida
         */
        public function setUnidadeMedida($unidadeMedida): self
        {
                $this->unidadeMedida = $unidadeMedida;

                return $this;
        }

        /**
         * Get the value of lado
         */
        public function getLado()
        {
                return $this->lado;
        }

        /**
         * Set the value of lado
         */
        public function setLado($lado): self
        {
                $this->lado = $lado;

                return $this;
        }

        /**
         * Get the value of cor
         */
        public function getCor()
        {
                return $this->cor;
        }

        /**
         * Set the value of cor
         */
        public function setCor($cor): self
        {
                $this->cor = $cor;

                return $this;
        }
    }
?>