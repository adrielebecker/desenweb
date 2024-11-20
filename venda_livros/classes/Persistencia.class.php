<?php
    abstract class Persistencia{
        private $id;

        public function __construct($id = 0){
            $this->setId($id);
        }

        abstract public function inserir(); 
        abstract public function alterar();
        abstract public function excluir(); 
        abstract  public static function listar($tipo = 0, $busca = "") : array; 

        public function getId(){
            return $this->id;
        }

        public function setId($id): self{
            $this->id = $id;
            return $this;
        }
    }
?>