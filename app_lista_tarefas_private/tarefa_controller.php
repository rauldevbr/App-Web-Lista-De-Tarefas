<?php
    require "connection.php";
    require "tarefa.model.php";
    require "tarefa.service.php";

    $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;
    if($acao == 'inserir') {
        //Classe de modelo
        $tarefa = new Tarefa();
        $tarefa->__set('tarefa', $_POST['tarefa']);    

        //Conexão com o banco
        $connection = new Connection();

        //Classe de serviço(CRUDS Sql)
        $tarefaService = new TarefaService($connection, $tarefa);
        $tarefaService->insert();
        
        header('Location: nova_tarefa.php?inclusao=1');
    } else if($acao == 'select') {
        $tarefa = new Tarefa();
        $connection = new Connection();

        $tarefaService = new TarefaService($connection, $tarefa);
        $tarefas = $tarefaService->select();       
    } else if($acao == 'update') {
        $tarefa = new Tarefa();
        $tarefa->__set('id', $_POST['id_tarefa'])
               ->__set('tarefa', $_POST['update_tarefa']);

        $connection = new Connection();

        $tarefaService = new TarefaService($connection, $tarefa);
        if($tarefaService->update()){
            if(isset($_GET['pag']) && $_GET['pag'] == 'index') {
                header('Location: index.php');
            } else {
                header('Location: todas_tarefas.php');
            }
        }
    } else if($acao == 'deletar') {
        $tarefa = new Tarefa();
        $tarefa->__set('id', $_GET['id_tarefa']);

        $connection = new Connection();

        $tarefaService = new TarefaService($connection, $tarefa);
        if($tarefaService->delete()){
            if(isset($_GET['pag']) && $_GET['pag'] == 'index') {
                header('Location: index.php');
            } else {
                header('Location: todas_tarefas.php');
            }
        }
    } else if($acao == 'marcarRealizada') {
        $tarefa = new Tarefa();
        $tarefa->__set('id', $_GET['id_tarefa'])
               ->__set('id_status', 2);

        $connection = new Connection();

        $tarefaService = new TarefaService($connection, $tarefa);
        if($tarefaService->updateStatus()) {
            if(isset($_GET['pag']) && $_GET['pag'] == 'index') {
                header('Location: index.php');
            } else {
                header('Location: todas_tarefas.php');
            }
        }
    } else if($acao == 'selectPendentes') { 
        $tarefa = new Tarefa();
        $tarefa->__set('id_status', 1);
        $connection = new Connection();

        $tarefaService = new TarefaService($connection, $tarefa);
        $tarefas = $tarefaService->selectPendentes();       
    }
?>