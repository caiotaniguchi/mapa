<?php
    class Edificio {
        public $id;
        public $nome;
        public $andarInicial;
        public $andarFinal;
        private $listaAndares;
        
        public function setId($id) {
            $this->id = $id;
        }
        
        public function getId() {
            return $this->id;
        }
        
        public function setNome($nome) {
            $this->nome = $nome;
        }
        
        public function getNome() {
            return $this->nome;
        }
                
        public function setAndarInicial($andarInicial) {
            $this->andarInicial = $andarInicial;
        }
        
        public function getAndarInicial() {
            return $this->andarInicial;
        }
        
        
        public function setAndarFinal($andarFinal) {
            $this->andarFinal = $andarFinal;
        }
        
        public function getAndarFinal() {
            return $this->andarFinal;
        }
        
        public function setListaAndares($listaAndares) {
            $this->listaAndares = $listaAndares;
        }
        
        public function getListaAndares() {
            return $this->listaAndares;
        }
        
}
?>
