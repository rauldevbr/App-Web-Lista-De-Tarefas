<?php
    class Tarefa {
        private $id_tarefa = null;
        private $id_status = null;
        private $tarefa = null;
        private $data_cadastrado = null;

        public function __get($atrrib) {
            return $this->$atrrib;
        }

        public function __set($atrrib, $value) {
            $this->$atrrib = $value;
            return $this;
        }
    }
?>