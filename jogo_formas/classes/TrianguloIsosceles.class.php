<?php
    require_once("../classes/Database.class.php");
    require_once("../classes/UnidadeMedida.class.php");
    require_once("../classes/Formas.class.php");

    class Isosceles extends Triangulo{
        public function __construct($id = 0, $ladoA = 0, $ladoB = 0, $ladoC = 0, $cor = "", UnidadeMedida $unidade_medida = null, $fundo = "null"){
            parent::__construct($id, $ladoA, $ladoB, $ladoC, $cor, $unidade_medida, $fundo);
        }
        
        public function nome(): string {
            return "Isósceles";
        }

        public function calcularPerimetro(){
            $perimetro = parent::getLadoA() + parent::getLadoB() + parent::getLadoC();   
            return round($perimetro, 2);
        }

        public function calcularArea(){
            $sp = (parent::getLadoA() + parent::getLadoB() + parent::getLadoC()) / 2;   
            $area = sqrt($sp * ($sp - parent::getLadoA()) * ($sp - parent::getLadoB()) * ($sp - parent::getLadoC()));
            
            return round($area, 2);
        }
        
        public function angulo(){
            $angulos = array();
            $a = parent::getLadoA();
            $b = parent::getLadoB();
            $c = parent::getLadoC();

            $cosA = (pow($b, 2) + pow($c, 2) - pow($a, 2)) / (2 * $b * $c);
            $cosB = (pow($a, 2) + pow($c, 2) - pow($b, 2)) / (2 * $a * $c);
            $cosC = (pow($a, 2) + pow($b, 2) - pow($c, 2)) / (2 * $a * $b);
            $anguloA = round(rad2deg(acos($cosA)));
            $anguloB = round(rad2deg(acos($cosB)));
            $anguloC = round(rad2deg(acos($cosC)));

            $angulos = ['a' => $anguloA,
                        'b' => $anguloB,
                        'c' => $anguloC,
                    ];
                
            $soma = $anguloA + $anguloB + $anguloC;
            if($soma == 180){
                return $angulos;
            } else{
                return "Ângulos não correspondem!";
            }
        }

        public static function listar($tipo = 0, $busca = ""):array{
            $sql = "SELECT * FROM triangulo WHERE tipo = 'Isósceles'";
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
                $triangulo = new Isosceles($registro['id_triangulo'], $registro['ladoA'], $registro['ladoB'], $registro['ladoC'], $registro['cor'], $unidade, $registro['fundo']);
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