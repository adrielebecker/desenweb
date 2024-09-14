<?php
    abstract class Formas{ //torna essa classe abstrata, ou seja, não permite que um objeto seja instanciado concretamente.
        private $id;
        private $cor;
        private $unidade_medida;
        private $fundo; 

        public function __construct($id = 0, $cor = "", UnidadeMedida $unidade_medida = null, $fundo = "null"){
            $this->setId($id);
            $this->setCor($cor);
            $this->setUnidadeMedida($unidade_medida);
            $this->setFundo($fundo);
        }

        abstract public function inserir(); //faz com que as classes filhas tenham que implementar esse método
        abstract public function alterar();
        abstract public function excluir(); //tanto na filha quando no pai precisam ter a mesma assinatura
        // abstract  public static function listar($tipo = 0, $busca = "") : array; //ou seja, precisa ser tudo igual
        // abstract public function DesenharQuadrado();
        // abstract public function calcularArea();
        // abstract public function calcularPerimetro(   );

        public function getId(){
            return $this->id;
        }

        public function setId($id): self{
            $this->id = $id;
            return $this;
        }

        public function getCor(){
            return $this->cor;
        }

        public function setCor($cor): self{
            $this->cor = $cor;
            return $this;
        }

        public function getUnidadeMedida(){
            return $this->unidade_medida;
        }

        public function setUnidadeMedida(UnidadeMedida $unidade_medida): self{
            $this->unidade_medida = $unidade_medida;
            return $this;
        }

        public function getFundo(){
            return $this->fundo;
        }

        public function setFundo($fundo): self{
            $this->fundo = $fundo;
            return $this;
        }
    }
?>