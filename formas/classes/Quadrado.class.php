<?php
    require_once('Database.class.php');
    
    class Quadrado{
        private $id_quadrado;
        private $cor;
        private $lado;
        private $unidadeMedida;

        
        public function __construct($id_quadrado = 0, $lado = "null", $cor = "null", Unidade $unidadeMedida = null){
            $this->setIdQuadrado($id_quadrado);
            $this->setLado($lado);
            $this->setCor($cor);
            $this->setUnidadeMedida($unidadeMedida);
        }

        public function inserir(){
            $sql = "INSERT INTO quadrado(id_quadrado, lado, cor, unidadeMedida) VALUES (:id_quadrado, :lado, :cor, :unidadeMedida)";
            $parametros = [':id_quadrado' => $this->getIdQuadrado(),
                            ':lado' => $this->getLado(),
                            ':cor' => $this->getCor(),
                            'unidadeMedida' => $this->getUnidadeMedida()->getIdUnidadeMedida()
                        ];
            Database::executar($sql, $parametros);
        }

        public function alterar(){
            $sql = "UPDATE quadrado SET id_quadrado = :id_quadradro, lado = :lado, cor = :cor, unidadeMedida = :unidadeMedida)";
            $parametros = [':id_quadrado' => $this->getIdQuadrado(),
                            ':lado' => $this->getLado(),
                            ':cor' => $this->getCor(),
                            'unidadeMedida' => $this->getUnidadeMedida()->getIdUnidadeMedida()
                        ];
            Database::executar($sql, $parametros);
        }

        public function excluir(){       
            $sql = 'DELETE FROM quadrado WHERE id_quadrado = :id_quadrado';
            $parametros = array(':id_quadrado'=> $this->id_quadrado);
            return Database::executar($sql, $parametros);
        }  

        public static function listar($tipo = 0, $busca = "null"){
            $conexao = Database::getInstance();
            $sql = "SELECT * FROM quadrado, unidadeMedida";
            if($tipo > 0){
                switch($tipo){
                    case 1: 
                        $sql .= " WHERE id_quadrado= :busca";
                        break;
                    case 2: 
                        $sql .= " WHERE cor like :busca"; 
                        $busca = "%{$busca}%"; 
                        break;
                    case 3: 
                        $sql .= " WHERE lado like :busca"; 
                        $busca = "%{$busca}%"; 
                        break;
                    case 4: 
                        $sql .= " WHERE descricao like :busca";  
                        $busca = "%{$busca}%";  
                        break;
                }
                // $parametros = array();
                $comando = $conexao->prepare($sql); 
                
                if ($tipo > 0 ){
                    $comando->bindValue(':busca', $busca);
                    // $parametros = [':busca' => $busca];
                }

                $comando->execute();
                // $comando = Database::executar($sql, $parametros);
                $quadrados = array();
            
                while($registro = $comando->fetch(PDO::FETCH_ASSOC)){
                    $unidadeMedida = Unidade::listar(1, $registro['unidadeMedida'])[0];
                    $quadrado = new Quadrado($registro['id_quadrado'], $registro['lado'], $registro['cor'], $unidadeMedida);
                    array_push($quadrados,$quadrado);
                }
                return $quadrados; 
            }
        }

        public function DesenharQuadrado(){
            return "<div class='quadrado' style='diplay:block' 
                    width:{$this->getLado()}{$this->getUnidadeMedida()->getIdUnidadeMedida()};
                    height: {$this->getLado()}{$this->getUnidadeMedida()->getIdUnidadeMedida()};
                    background-color:{$this->getCor()}></div>";
        }

        public function getIdQuadrado(){
            return $this->id_quadrado;
        }

        public function setIdQuadrado($id_quadrado): self{
            $this->id_quadrado = $id_quadrado;
            return $this;
        }

        public function getCor(){
            return $this->cor;
        }

        public function setCor($cor): self{
            $this->cor = $cor;
            return $this;
        }

        public function getLado(){
            return $this->lado;
        }

        public function setLado($lado): self{
            $this->lado = $lado;
            return $this;
        }

        public function getUnidadeMedida(){
            return $this->unidadeMedida;
        }

        public function setUnidadeMedida(Unidade $unidadeMedida): self{
            $this->unidadeMedida = $unidadeMedida;
            return $this;
        }
    }
?>