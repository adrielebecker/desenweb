<?php
    require_once("../classes/Database.class.php");
    require_once("../classes/UnidadeMedida.class.php");
    require_once("../classes/Formas.class.php");

    class Quadrado extends Formas{
        private $lado;

        public function __construct($id = 0, $lado = 0, $cor = "", UnidadeMedida $unidade_medida = null, $fundo = "null"){
            parent::__construct($id, $cor, $unidade_medida, $fundo); //chamando o construtor da classe pai
            $this->setLado($lado);
        }

        public function inserir(){ //assinatura do método
            $sql = "INSERT INTO quadrado(lado, cor, unidadeMedida, fundo) VALUES (:lado, :cor, :unidadeMedida, :fundo)";
            $parametros = [
                ':lado' => $this->getLado(),
                ':cor' => parent::getCor(),
                ':unidadeMedida' => parent::getUnidadeMedida()->getIdUnidadeMedida(),
                ':fundo' => parent::getFundo(),
            ];

            Database::executar($sql, $parametros);
        }

        public function alterar(){
            $sql = "UPDATE quadrado SET lado = :lado, cor = :cor, unidadeMedida = :unidadeMedida, fundo = :fundo WHERE id_quadrado = :id_quadrado";
            $parametros = [
                ':id_quadrado' => parent::getId(),
                ':lado' => $this->getLado(),
                ':cor' => parent::getCor(),
                ':unidadeMedida' => parent::getUnidadeMedida()->getIdUnidadeMedida(),
                ':fundo' => parent::getFundo(),
            ];

            Database::executar($sql, $parametros);
        }

        public function excluir(){
            $sql = "DELETE FROM quadrado WHERE id_quadrado = :id_quadrado";
            $parametros = [
                ':id_quadrado' => parent::getId()
            ];

            Database::executar($sql, $parametros);
        }

        public static function listar($tipo = 0, $busca = ""):array{
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
                $quadrado = new Quadrado($registro['id_quadrado'], $registro['lado'], $registro['cor'], $unidade, $registro['fundo']);
                array_push($formas, $quadrado);
            }
            return $formas;
        }

        public function desenhar(){        
            return "<div style='display: inline-block;
                    width:".$this->getLado().$this->getUnidadeMedida()->getDescricao().";
                    height:".$this->getLado().$this->getUnidadeMedida()->getDescricao().";
                    background-color:".$this->getCor().";
                    background-image: url(\"{$this->getFundo()}\")'></div>";
        }
        
        public function calcularArea(){
            $area = $this->getLado() * $this->getLado();
            return round($area, 2);
        }

        public function calcularPerimetro(){
            $perimetro = $this->getLado() + $this->getLado() + $this->getLado() + $this->getLado();
            return round($perimetro, 2);
        }

        public function getLado(){
            return $this->lado;
        }

        public function setLado($lado): self{
            $this->lado = $lado;
            return $this;
        }
    }
?>
