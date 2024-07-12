<?php
    require_once("../classes/Database.class.php");
    require_once("../classes/Login.class.php");

    class Endereco{
        private $idendereco;
        private $cep;
        private $pais;
        private $estado;
        private $cidade;
        private $bairro;
        private $rua;
        private $numero;
        private $complemento;
        private $idlivro;

        public function __construct($idendereco = 0, $cep = "null", $pais = "null", $estado = "null", $cidade = "null", $bairro = "null", $rua = "null", $numero = "null", $complemento = "null", $idlivro = 0){
            $this->setIdEndereco($idendereco);
            $this->setCep($cep);
            $this->setPais($pais);
            $this->setEstado($estado);
            $this->setCidade($cidade);
            $this->setBairro($bairro);
            $this->setRua($rua);
            $this->setNumero($numero);
            $this->setComplemento($complemento);
            $this->setIdlivro($idlivro);
        }
        
        public function incluir(){
            $sql = 'INSERT INTO endereco(cep, pais, estado, cidade, bairro, rua, numero, complemento, idlivro) 
                    VALUES (:cep, :pais, :estado, :cidade, :bairro, :rua, :numero, :complemento, :idlivro)';
            $parametros = array(':cep'=>$this->getCep(),
                                ':pais'=>$this->getPais(),
                                ':estado'=>$this->getEstado(),
                                ':cidade'=>$this->getCidade(),
                                ':bairro'=>$this->getBairro(),
                                ':rua'=>$this->getRua(),
                                ':numero'=>$this->getNumero(),
                                ':complemento'=>$this->getComplemento(),
                                ':idlivro'=>$this->getIdlivro());
            Database::executar($sql, $parametros);
        }

        public function excluir(){
            $sql = 'DELETE FROM endereco WHERE idendereco = :id';
            $parametros = array(':id'=> $this->getIdEndereco());
            return Database::executar($sql, $parametros);
        }

        public function alterar(){
            $sql = 'UPDATE endereco SET cep = :cep, pais = :pais, estado = :estado, cidade = :cidade, bairro = :bairro, rua = :rua, numero = :numero, complemento = :complemento, idlivro = :idlivro WHERE idendereco = :id';
            $parametros = [':id' => $this->getIdendereco(),
                        ':cep' => $this->getCep(),
                        ':pais' => $this->getPais(),
                        ':estado' => $this->getEstado(),
                        ':cidade' => $this->getCidade(),
                        ':bairro' => $this->getBairro(),
                        ':rua' => $this->getRua(),
                        ':numero' => $this->getNumero(),
                        ':complemento' => $this->getComplemento(),
                        ':idlivro' => $this->getIdlivro()]; 
            return Database::executar($sql, $parametros);
        }   

        public static function listar($tipo = 0, $busca = "" ){
            $conexao = Database::getInstance();
            // montar consulta
            $sql = "SELECT * FROM endereco";        
            if ($tipo > 0 )
                switch($tipo){
                    case 1: $sql .= " WHERE id = :busca"; break;
                    case 2: $sql .= " WHERE cep like :busca"; $busca = "%{$busca}%"; break;
                    case 3: $sql .= " WHERE rua like :busca";  $busca = "%{$busca}%";  break;
                    case 4: $sql .= " WHERE pais like :busca";  $busca = "%{$busca}%";  break;
                    case 5: $sql .= " WHERE idlivro = :busca";  break;
                }
            $comando = $conexao->prepare($sql);      
            if ($tipo > 0 )
                $comando->bindValue(':busca',$busca); 
            $comando->execute();
            $enderecos = array();            
            while($registro = $comando->fetch()){  
                $endereco = new Endereco($registro['idendereco'], $registro['cep'], $registro['pais'], $registro['estado'], $registro['cidade'], $registro['bairro'], $registro['rua'], $registro['numero'], $registro['complemento'], $registro['idlivro']); array_push($enderecos,$endereco); 
            }
            return $enderecos;  
        }    
        
        /**
         * Get the value of idendereco
         */
        public function getIdEndereco(){
            return $this->idendereco;
        }

        /**
         * Set the value of idendereco
         */
        public function setIdEndereco($idendereco){
            $this->idendereco = $idendereco;
            return $this;
        }

        /**
         * Get the value of cep
         */
        public function getCep(){
            return $this->cep;
        }

        /**
         * Set the value of cep
         */
        public function setCep($cep){
            $this->cep = $cep;
            return $this;
        }

        /**
         * Get the value of pais
         */
        public function getPais(){
            return $this->pais;
        }

        /**
         * Set the value of pais
         */
        public function setPais($pais){
            $this->pais = $pais;
            return $this;
        }

        /**
         * Get the value of estado
         */
        public function getEstado(){
            return $this->estado;
        }

        /**
         * Set the value of estado
         */
        public function setEstado($estado){
            $this->estado = $estado;
            return $this;
        }

        /**
         * Get the value of cidade
         */
        public function getCidade(){
            return $this->cidade;
        }

        /**
         * Set the value of cidade
         */
        public function setCidade($cidade){
            $this->cidade = $cidade;
            return $this;
        }

        /**
         * Get the value of bairro
         */
        public function getBairro(){
            return $this->bairro;
        }

        /**
         * Set the value of bairro
         */
        public function setBairro($bairro){
            $this->bairro = $bairro;
            return $this;
        }

        /**
         * Get the value of rua
         */
        public function getRua(){
            return $this->rua;
        }

        /**
         * Set the value of rua
         */
        public function setRua($rua){
            $this->rua = $rua;
            return $this;
        }

        /**
         * Get the value of numero
         */
        public function getNumero(){
            return $this->numero;
        }

        /**
         * Set the value of numero
         */
        public function setNumero($numero){
            $this->numero = $numero;
            return $this;
        }

        /**
         * Get the value of complemento
         */
        public function getComplemento(){
            return $this->complemento;
        }

        /**
         * Set the value of complemento
         */
        public function setComplemento($complemento){
            $this->complemento = $complemento;
            return $this;
        }

        /**
         * Get the value of idlivro
         */
        public function getIdlivro(){
            return $this->idlivro;
        }

        /**
         * Set the value of idlivro
         */
        public function setIdlivro($idlivro){
            $this->idlivro = $idlivro;
            return $this;
        }
    }
?>