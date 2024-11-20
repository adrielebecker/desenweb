<?php
    require_once("../classes/autoload.php");

    class Circulo extends Formas{
        private $raio;

        public function __construct($id = 0, $raio = 0, $cor = "", UnidadeMedida $unidade_medida = null, $fundo = "null"){
            parent::__construct($id, $cor, $unidade_medida, $fundo); //chamando o construtor da classe pai
            $this->setRaio($raio);
        }

        public function inserir(){ //assinatura do método
            $sql = "INSERT INTO circulo(raio, cor, unidadeMedida, fundo) VALUES (:raio, :cor, :unidadeMedida, :fundo)";
            $parametros = [
                ':raio' => $this->getRaio(),
                ':cor' => parent::getCor(),
                ':unidadeMedida' => parent::getUnidadeMedida()->getIdUnidadeMedida(),
                ':fundo' => parent::getFundo(),
            ];

            Database::executar($sql, $parametros);
        }

        public function alterar(){
            $sql = "UPDATE circulo SET raio = :raio, cor = :cor, unidadeMedida = :unidadeMedida, fundo = :fundo WHERE id_circulo = :id_circulo";
            $parametros = [
                ':id_circulo' => parent::getId(),
                ':raio' => $this->getRaio(),
                ':cor' => parent::getCor(),
                ':unidadeMedida' => parent::getUnidadeMedida()->getIdUnidadeMedida(),
                ':fundo' => parent::getFundo(),
            ];

            Database::executar($sql, $parametros);
        }

        public function excluir(){
            $sql = "DELETE FROM circulo WHERE id_circulo = :id_circulo";
            $parametros = [
                ':id_circulo' => parent::getId()
            ];

            Database::executar($sql, $parametros);
        }

        public static function listar($tipo = 0, $busca = ""):array{
            $sql = "SELECT * FROM circulo";
            if($tipo > 0){
                switch($tipo){
                    case 1: 
                        $sql .= " WHERE id_circulo = :busca"; 
                        break;
                    case 2: 
                        $sql .= " WHERE raio = :busca"; 
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
                $circulo = new Circulo($registro['id_circulo'], $registro['raio'], $registro['cor'], $unidade, $registro['fundo']);
                array_push($formas, $circulo);
            }
            return $formas;
        }

        public function desenhar(){
            $diametro = $this->getRaio() * 2;
            return "<div style='
                    width:".$diametro.$this->getUnidadeMedida()->getDescricao().";
                    height:".$diametro.$this->getUnidadeMedida()->getDescricao().";
                    border-radius: 50%;
                    background-color:".$this->getCor().";
                    background-image: url(\"{$this->getFundo()}\")'></div>";
        }
        
        public function calcularArea(){
            $area = pow($this->getRaio(), 2) * pi();
            return round($area, 2);
        }
        
        public function calcularPerimetro(){
            $perimetro = 2 * pi() * $this->getRaio();
            return round($perimetro, 2);
        }

        public function getRaio(){
            return $this->raio;
        }

        public function setRaio($raio): self{
            $this->raio = $raio;
            return $this;
        }
    }
?>
