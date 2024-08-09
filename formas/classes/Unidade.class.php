<?php
    require_once('Database.class.php');

    class Unidade{
        private $id_unidadeMedida;
        private $descricao;

        public function __construct($id_unidadeMedida = 0, $descricao = "null"){
            $this->setIdUnidadeMedida($id_unidadeMedida);
            $this->setDescricao($descricao);
        }

        public function inserir(){
            $sql = "INSERT INTO unidadeMedida(id_unidadeMedida  , descricao) VALUES (:id_unidadeMedida, :descricao)";
            $parametros = [':id_unidadeMedida' => $this->id_unidadeMedida,
                            ':descricao' => $this->descricao
                        ];
            Database::executar($sql, $parametros);
        }

        public function alterar(){
            $sql = "UPDATE unidadeMedida SET descricao = :descricao WHERE id_unidadeMedida = : id_unidadeMedida";
            $parametros = [
                'id_unidadeMedida' => $this->id_unidadeMedida,
                'descricao' => $this->descricao
            ];
            Database::executar($sql, $parametros);
        }

        public function excluir(){
            $sql = "DELETE FROM unidadeMedida WHERE id_unidadeMedida = :id_unidadeMedida";
            $parametros = ['id_unidadeMedida' => $this->id_unidadeMedida];
            return Database::executar($sql, $parametros);
        }

        public static function listar($tipo = 0, $busca = "null"){
            $conexao = Database::getInstance();
            $sql = "SELECT * FROM unidadeMedida";
            if ($tipo > 0 )
                switch($tipo){
                    case 1: 
                        $sql .= " WHERE id_unidadeMedida  = :busca"; 
                        break;
                    case 2: 
                        $sql .= " WHERE descricao like :busca"; $busca = "%{$busca}%";
                        break;
                }
            $comando = $conexao->prepare($sql); 
            if ($tipo > 0 ){
               $comando->bindValue(':busca',$busca);
            }

            $comando->execute();
            $unidades = array(); 
            while($registro = $comando->fetch(PDO::FETCH_ASSOC)){
               $unidade = new Unidade($registro['id_unidadeMedida'], $registro['descricao']);
               array_push($unidades,$unidade);
            }
            return $unidades; 
        }

        /**
         * Get the value of id_unidadeMedida
         */
        public function getIdUnidadeMedida()
        {
                return $this->id_unidadeMedida;
        }

        /**
         * Set the value of id_unidadeMedida
         */
        public function setIdUnidadeMedida($id_unidadeMedida): self
        {
                $this->id_unidadeMedida = $id_unidadeMedida;

                return $this;
        }

        /**
         * Get the value of descricao
         */
        public function getDescricao()
        {
                return $this->descricao;
        }

        /**
         * Set the value of descricao
         */
        public function setDescricao($descricao): self
        {
                $this->descricao = $descricao;

                return $this;
        }
    }

?>