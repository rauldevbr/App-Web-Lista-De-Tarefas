<?php
    class TarefaService {

        private $connection = null;
        private $tarefa = null;

        public function __construct(Connection $connection, Tarefa $tarefa) {
            $this->connection = $connection->getConnection();
            $this->tarefa = $tarefa;
        }
        
        public function select() {
            $qry =  ' Select tb_tarefas.id as id, id_status, tarefa, data_cadastrado, status ';
            $qry .= ' From tb_tarefas ';
            $qry .= ' inner join tb_status ';
            $qry .= ' on(tb_tarefas.id_status = tb_status.id) ';
            $stmt = $this->connection->prepare($qry);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function selectPendentes() {
            $qry =  ' Select tb_tarefas.id as id, id_status, tarefa, data_cadastrado, status ';
            $qry .= ' From tb_tarefas ';
            $qry .= ' inner join tb_status ';
            $qry .= ' on(tb_tarefas.id_status = tb_status.id) ';
            $qry .= ' Where tb_tarefas.id_status = :id_status ';

            $stmt = $this->connection->prepare($qry);
            $stmt->bindValue(':id_status', $this->tarefa->__get('id_status'));
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function insert() {
            $qry  = ' Insert into tb_tarefas(tarefa) ' .
                    ' Values(:pTarefa) ';

            $stmt = $this->connection->prepare($qry);
            $stmt->bindValue(':pTarefa', $this->tarefa->__get('tarefa'));
            $stmt->execute();
        }

        public function update() {
            $qry  = ' Update tb_tarefas ';
            $qry .= ' Set tarefa = ? ';           
            $qry .= ' Where id = ? ';

            $stmt = $this->connection->prepare($qry);
            $stmt->bindValue(1, $this->tarefa->__get('tarefa'));
            $stmt->bindValue(2, $this->tarefa->__get('id'));
            return $stmt->execute();          
        }

        public function delete() {
            $qry  = ' Delete From tb_tarefas ';
            $qry .= ' Where id = ?  '; 

            $stmt = $this->connection->prepare($qry);
            $stmt->bindValue(1, $this->tarefa->__get('id'));
            return $stmt->execute();      
        }

        public function updateStatus() {
            $qry  = ' Update tb_tarefas ';
            $qry .= ' Set id_status = ? ';
            $qry .= ' Where id = ?  '; 

            $stmt = $this->connection->prepare($qry);
            $stmt->bindValue(1, $this->tarefa->__get('id_status'));
            $stmt->bindValue(2, $this->tarefa->__get('id'));
            return $stmt->execute();      
        }


    }
