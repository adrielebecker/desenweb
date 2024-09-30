<?php
    require_once("../classes/Database.class.php");
    require_once("../classes/UnidadeMedida.class.php");
    require_once("../classes/Formas.class.php");

    class Equilatero extends Triangulo{
        public function __construct($id = 0, $ladoA = 0, $ladoB = 0, $ladoC = 0, $cor = "", UnidadeMedida $unidade_medida = null, $fundo = "null"){
            parent::__construct($id, $ladoA, $ladoB, $ladoC, $cor, $unidade_medida, $fundo);
        }
        
        public function nome(): string {
            return "Equilátero";
        }

        public function calcularPerimetro(){
            $perimetro = (parent::getLadoA() + parent::getLadoB() + parent::getLadoC()) / 2;   
            return round($perimetro, 2);
        }

        public function calcularArea(){
            $p = (parent::getLadoA() + parent::getLadoB() + parent::getLadoC()) / 2;   
            $area = sqrt($p * ($p - parent::getLadoA()) * ($p - parent::getLadoB()) * ($p - parent::getLadoC()));
            return round($area, 2);
        }

        public static function listar($tipo = 0, $busca = ""):array{
            $sql = "SELECT * FROM triangulo WHERE tipo = 'Equilátero'";
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
                $triangulo = new Equilatero($registro['id_triangulo'], $registro['ladoA'], $registro['ladoB'], $registro['ladoC'], $registro['cor'], $unidade, $registro['fundo']);
                array_push($formas, $triangulo);
            }
            return $formas;
        }
        public function desenhar(){
            return "<div style= 'width: 0;
                    height: 0;
                    border-left: ".parent::getLadoA().$this->getUnidadeMedida()->getDescricao()." solid transparent;
                    border-right: ".parent::getLadoB().$this->getUnidadeMedida()->getDescricao()." solid transparent;
                    border-bottom: ".parent::getLadoC().$this->getUnidadeMedida()->getDescricao()." solid ".$this->getCor().";'>
                </div>";
        }
        
    }
?>