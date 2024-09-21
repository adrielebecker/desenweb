<?php
    require_once("../classes/Database.class.php");
    require_once("../classes/UnidadeMedida.class.php");
    require_once("../classes/Formas.class.php");

    abstract class Triangulo extends Formas{
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
            $sql = "INSERT INTO triangulo(ladoA, ladoB, ladoC, cor, unidadeMedida, fundo, tipo) VALUES (:ladoA, :ladoB, :ladoC, :cor, :unidadeMedida, :fundo, :tipo)";
            $parametros = [
                ':ladoA' => $this->getLadoA(),
                ':ladoB' => $this->getLadoB(),
                ':ladoC' => $this->getLadoC(),
                ':cor' => parent::getCor(),
                ':unidadeMedida' => parent::getUnidadeMedida()->getIdUnidadeMedida(),
                ':fundo' => parent::getFundo(),
                ':tipo' => $this->nome()
            ];

            Database::executar($sql, $parametros);
        }

        public function alterar(){
            $sql = "UPDATE triangulo SET ladoA = :ladoA, ladoB = :ladoB, ladoC = :ladoC, cor = :cor, unidadeMedida = :unidadeMedida, fundo = :fundo, tipo = :tipo WHERE id_triangulo = :id_triangulo";
            $parametros = [
                ':id_triangulo' => parent::getId(),
                ':ladoA' => $this->getLadoA(),
                ':ladoB' => $this->getLadoB(),
                ':ladoC' => $this->getLadoC(),
                ':cor' => parent::getCor(),
                ':unidadeMedida' => parent::getUnidadeMedida()->getIdUnidadeMedida(),
                ':fundo' => parent::getFundo(),
                ':tipo' => $this->nome()
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

        public static function listar($tipo = 0, $busca = "") : array{
            $sql = "SELECT * FROM triangulo ";
            if($tipo > 0){
                switch($tipo){
                    case 1: 
                        $sql .= " AND id_triangulo = :busca"; 
                        break;
                    case 2: 
                        $sql .= " AND ladoA = :busca"; 
                        break;
                    case 3: 
                        $sql .= " AND ladoB = :busca"; 
                        break;
                    case 4: 
                        $sql .= " AND ladoC = :busca"; 
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
                
                if($registro['ladoA'] == $registro['ladoB'] && $registro['ladoB'] == $registro['ladoC']){
                    $triangulo = new Equilatero($registro['id_triangulo'], $registro['ladoA'], $registro['ladoB'], $registro['ladoC'], $registro['cor'], $unidade, $registro['fundo']);
                }elseif(($registro['ladoA'] == $registro['ladoB'] && $registro['ladoB'] != $registro['ladoC']) || ($registro['ladoB'] == $registro['ladoC'] && $registro['ladoC'] != $registro['ladoA']) || ($registro['ladoA'] == $registro['ladoC'] && $registro['ladoC'] != $registro['ladoB'])){
                    $triangulo = new Isosceles($registro['id_triangulo'], $registro['ladoA'], $registro['ladoB'], $registro['ladoC'], $registro['cor'], $unidade, $registro['fundo']);
                } elseif($registro['ladoA'] != $registro['ladoB'] && $registro['ladoA'] != $registro['ladoC'] && $registro['ladoB'] != $registro['ladoC']){
                    $triangulo = new Escaleno($registro['id_triangulo'], $registro['ladoA'], $registro['ladoB'], $registro['ladoC'], $registro['cor'], $unidade, $registro['fundo']);
                } 

                array_push($formas, $triangulo);
            }
            return $formas;
        } //ou seja, precisa ser tudo igual
        abstract public function desenhar();
        abstract public function calcularArea();
        abstract public function calcularPerimetro();
        abstract public function nome():string;


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
