<?php
    require_once("../classes/Database.class.php");
    require_once("../classes/UnidadeMedida.class.php");

    class Quadrado{
        private $id_quadrado;
        private $lado;
        private $cor;
        private $unidade_medida;

        public function __construct($id_quadrado = 0, $lado = 0, $cor = "", UnidadeMedida $unidade_medida = null){
            $this->setIdQuadrado($id_quadrado);
            $this->setLado($lado);
            $this->setCor($cor);
            $this->setUnidadeMedida($unidade_medida);
        }

        public function inserir(){
            $sql = "INSERT INTO quadrado(lado, cor, unidadeMedida) VALUES (:lado, :cor, :unidadeMedida)";
            $parametros = [
                ':lado' => $this->getLado(),
                ':cor' => $this->getCor(),
                ':unidadeMedida' => $this->getUnidadeMedida()->getIdUnidadeMedida()
            ];

            Database::executar($sql, $parametros);
        }

        public function alterar(){
            $sql = "UPDATE quadrado SET lado = :lado, cor = :cor, unidadeMedida = :unidadeMedida WHERE id_quadrado = :id_quadrado";
            $parametros = [
                ':id_quadrado' => $this->getIdQuadrado(),
                ':lado' => $this->getLado(),
                ':cor' => $this->getCor(),
                ':unidadeMedida' => $this->getUnidadeMedida()->getIdUnidadeMedida()
            ];

            Database::executar($sql, $parametros);
        }

        public function excluir(){
            $sql = "DELETE FROM quadrado WHERE id_quadrado = :id_quadrado";
            $parametros = [
                ':id_quadrado' => $this->getIdQuadrado()
            ];

            Database::executar($sql, $parametros);
        }

        public static function listar($tipo = 0, $busca = ""){
            $sql = "SELECT * FROM quadrado";
            if($tipo > 0){
                switch($tipo){
                    case 1: 
                        $sql .= " WHERE id_quadrado = :busca"; 
                        break;
                    case 2: 
                        $sql .= " WHERE lado = :busca"; 
                        break;
                    case 3: 
                        $sql .= ' WHERE cor LIKE :busca';
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
            $formas = array();

            while($registro = $comando->fetch(PDO::FETCH_ASSOC)){
                $unidade = UnidadeMedida::listar(1, $registro['unidadeMedida'])[0];
                $quadrado = new Quadrado($registro['id_quadrado'], $registro['lado'], $registro['cor'], $unidade);
                array_push($formas, $quadrado);
            }
            return $formas;
        }

        public function DesenharQuadrado(){
            return "<div style='display: inline-block;
                    width:".$this->getLado().$this->getUnidadeMedida()->getDescricao().";
                    height:".$this->getLado().$this->getUnidadeMedida()->getDescricao().";
                    background-color:".$this->getCor().";'></div>";
        }
        
        public function getIdQuadrado(){
            return $this->id_quadrado;
        }

        public function setIdQuadrado($id_quadrado): self{
            $this->id_quadrado = $id_quadrado;
            return $this;
        }

        public function getLado(){
            return $this->lado;
        }

        public function setLado($lado): self{
            $this->lado = $lado;
            return $this;
        }

        public function getCor(){
            return $this->cor;
        }

        public function setCor($cor): self{
            $this->cor = $cor;
            return $this;
        }

        public function getUnidadeMedida(){
            return $this->unidade_medida;
        }

        public function setUnidadeMedida(UnidadeMedida $unidade_medida): self{
            $this->unidade_medida = $unidade_medida;
            return $this;
        }
    }
?>
