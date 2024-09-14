<?php
    require_once("../classes/Database.class.php");
    require_once("../classes/UnidadeMedida.class.php");
    require_once("../classes/Formas.class.php");

    class Triangulo extends Formas{
        private $ladoA;
        private $ladoB;
        private $ladoC;

        public function __construct($id = 0, $ladoA = 0, $ladoB = 0, $ladoC = 0, $cor = "", UnidadeMedida $unidade_medida = null, $fundo = "null"){
            parent::__construct($id, $cor, $unidade_medida, $fundo); //chamando o construtor da classe pai
            $this->setLadoA($ladoA);
            $this->setLadoB($ladoB);
            $this->setLadoC($ladoC);
        }

        public function inserir(){ //assinatura do método
            $sql = "INSERT INTO triangulo(ladoA, ladoB, ladoC, cor, unidadeMedida, fundo) VALUES (:ladoA, :ladoB, :ladoC, :cor, :unidadeMedida, :fundo)";
            $parametros = [
                ':ladoA' => $this->getLadoA(),
                ':ladoB' => $this->getLadoB(),
                ':ladoC' => $this->getLadoC(),
                ':cor' => parent::getCor(),
                ':unidadeMedida' => parent::getUnidadeMedida()->getIdUnidadeMedida(),
                ':fundo' => parent::getFundo(),
            ];

            Database::executar($sql, $parametros);
        }

        public function alterar(){
            $sql = "UPDATE triangulo SET ladoA = :ladoA, ladoB = :ladoB, ladoC = :ladoC, cor = :cor, unidadeMedida = :unidadeMedida, fundo = :fundo WHERE id_triangulo = :id_triangulo";
            $parametros = [
                ':id_triangulo' => parent::getId(),
                ':ladoA' => $this->getLadoA(),
                ':ladoB' => $this->getLadoB(),
                ':ladoC' => $this->getLadoC(),
                ':cor' => parent::getCor(),
                ':unidadeMedida' => parent::getUnidadeMedida()->getIdUnidadeMedida(),
                ':fundo' => parent::getFundo(),
            ];

            Database::executar($sql, $parametros);
        }

        public function excluir(){
            $sql = "DELETE FROM triangulo WHERE id_triangulo = :id_triangulo";
            $parametros = [
                ':id_triangulo' => parent::getId()
            ];

            Database::executar($sql, $parametros);
        }

        public static function listar($tipo = 0, $busca = ""):array{
            $sql = "SELECT * FROM triangulo";
            if($tipo > 0){
                switch($tipo){
                    case 1: 
                        $sql .= " WHERE id_triangulo = :busca"; 
                        break;
                    case 2: 
                        $sql .= " WHERE ladoA = :busca"; 
                        break;
                    case 3: 
                        $sql .= " WHERE ladoB = :busca"; 
                        break;
                    case 4: 
                        $sql .= " WHERE ladoC = :busca"; 
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
                $triangulo = new Triangulo($registro['id_triangulo'], $registro['ladoA'], $registro['ladoB'], $registro['ladoC'], $registro['cor'], $unidade, $registro['fundo']);
                array_push($formas, $triangulo);
            }
            return $formas;
        }
    
        // public function DesenharQuadrado(){
            // return "<div style='display: inline-block;
            //         width:".$this->getLado().$this->getUnidadeMedida()->getDescricao().";
            //         height:".$this->getLado().$this->getUnidadeMedida()->getDescricao().";
            //         background-color:".$this->getCor().";
            //         background-image: url(\"{$this->getFundo()}\")'></div>";
        // }
        
        // abstract public function calcularArea();
        // abstract public function calcularPerimetro();


        /**
         * Get the value of ladoA
         */
        public function getLadoA()
        {
                return $this->ladoA;
        }

        /**
         * Set the value of ladoA
         */
        public function setLadoA($ladoA): self
        {
                $this->ladoA = $ladoA;

                return $this;
        }

        /**
         * Get the value of ladoB
         */
        public function getLadoB()
        {
                return $this->ladoB;
        }

        /**
         * Set the value of ladoB
         */
        public function setLadoB($ladoB): self
        {
                $this->ladoB = $ladoB;

                return $this;
        }

        /**
         * Get the value of ladoC
         */
        public function getLadoC()
        {
                return $this->ladoC;
        }

        /**
         * Set the value of ladoC
         */
        public function setLadoC($ladoC): self
        {
                $this->ladoC = $ladoC;

                return $this;
        }
    }
?>
