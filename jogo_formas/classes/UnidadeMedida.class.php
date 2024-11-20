<?php
    require_once("../classes/autoload.php");

    class UnidadeMedida{
        private $id_unidadeMedida;
        private $descricao;

        public function __construct($id_unidadeMedida = 0, $descricao = ""){
            $this->setIdUnidadeMedida($id_unidadeMedida);
            $this->setDescricao($descricao);
        }
        
        public function inserir(){
            $sql = "INSERT INTO unidadeMedida(descricao) VALUES (:descricao)";
            $parametros = [
                ':descricao' => $this->getDescricao()
            ];
            
            Database::executar($sql, $parametros);
        }

        public function alterar(){
            $sql = "UPDATE unidadeMedida SET descricao = :descricao WHERE id_unidadeMedida = :id_unidadeMedida";
            $parametros = [
                ':id_unidadeMedida' => $this->getIdUnidadeMedida(),
                ':descricao' => $this->getDescricao()
            ];

            Database::executar($sql, $parametros);
        }

        public function excluir(){
            $sql = "DELETE FROM unidadeMedida WHERE id_unidadeMedida = :id_unidadeMedida";
            $parametros = [
                ':id_unidadeMedida' => $this->getIdUnidadeMedida()
            ];
            
            Database::executar($sql, $parametros);
        }

        public static function listar($tipo, $busca){
            $sql = "SELECT * FROM unidadeMedida";
            if($tipo > 0){
                switch($tipo){
                    case 1: 
                        $sql .= " WHERE id_unidadeMedida = :busca"; 
                        break;
                    case 2: 
                        $sql .= " WHERE descricao = :busca"; 
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
            $unidades = array();

            while($registro = $comando->fetch(PDO::FETCH_ASSOC)){
                $unidadeMedida = new UnidadeMedida($registro['id_unidadeMedida'], $registro['descricao']);
                array_push($unidades, $unidadeMedida);
            }
            return $unidades;
        }
        /**
         * Get the value of id_unidadeMedida
         */
        public function getIdUnidadeMedida()
        {
                return $this->id_unidadeMedida;
        }

        /**
         * Set the value of id_unidadeMedida
         */
        public function setIdUnidadeMedida($id_unidadeMedida): self
        {
                $this->id_unidadeMedida = $id_unidadeMedida;

                return $this;
        }

        /**
         * Get the value of descricao
         */
        public function getDescricao()
        {
                return $this->descricao;
        }

        /**
         * Set the value of descricao
         */
        public function setDescricao($descricao): self
        {
                $this->descricao = $descricao;

                return $this;
        }
    }
?>