<?php
    require_once("../classes/Database.class.php");
    require_once("../classes/UnidadeMedida.class.php");
    require_once("../classes/Formas.class.php");

    class Escaleno extends Triangulo{
        public function __construct($id = 0, $ladoA = 0, $ladoB = 0, $ladoC = 0, $cor = "", UnidadeMedida $unidade_medida = null, $fundo = "null"){
            parent::__construct($id, $ladoA, $ladoB, $ladoC, $cor, $unidade_medida, $fundo);
        }
        
        public function nome(): string {
            return "Escaleno";
        }

        public function calcularArea(){
            $altura = (parent::getLadoA() * sqrt(3)) / 2;
            return $altura;
        }

        public function calcularPerimetro(){
            $perimetro = parent::getLadoA() + parent::getLadoB() + parent::getLadoC();   
            return $perimetro;
        }

        public static function listar($tipo = 0, $busca = ""):array{
            $sql = "SELECT * FROM triangulo WHERE tipo = 'Escaleno'";
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
                $triangulo = new Escaleno($registro['id_triangulo'], $registro['ladoA'], $registro['ladoB'], $registro['ladoC'], $registro['cor'], $unidade, $registro['fundo']);
                array_push($formas, $triangulo);
            }
            return $formas;
        }
        
        public function desenhar(){
            return "<div style='display: inline-block;
                border-left:".parent::getLadoA().$this->getUnidadeMedida()->getDescricao().";
                border-right:".parent::getLadoB().$this->getUnidadeMedida()->getDescricao().";
                border-bottom:".parent::getLadoC().$this->getUnidadeMedida()->getDescricao().";
                background-color:".$this->getCor().";
                background-image: url(\"{$this->getFundo()}\")'></div>";
        }
        
    }
?>