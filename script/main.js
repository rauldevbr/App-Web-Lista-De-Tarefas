function editar(id_tarefa, txt_tarefa, page) {
    //criar um form de edição
    page = page != '' ? '&pag=' + page : '';
    let form = document.createElement('form');
    form.action = 'tarefa_controller.php?acao=update' + page;
    form.method = 'post';
    form.className = 'row';

    //colocar um input
    let inputTarefa = document.createElement('input');
    inputTarefa.type = 'text';
    inputTarefa.name = 'update_tarefa';
    inputTarefa.className = 'col-9 form-control';
    inputTarefa.value = txt_tarefa;

    //criar um input hidden para passar o id da tarefa
    let inputId = document.createElement('input');
    inputId.type = 'hidden';
    inputId.name = 'id_tarefa';
    inputId.value = id_tarefa;

    //colocar um button para submit
    let button = document.createElement('button');
    button.type = 'submit';
    button.className = 'col-3 btn btn-info';
    button.innerHTML = 'Atualizar';

    form.appendChild(inputTarefa);
    form.appendChild(inputId);
    form.appendChild(button);

    let tarefaEl = document.getElementById('tarefa_' + id_tarefa);

    tarefaEl.innerHTML = '';

    //Inclui o form na página
    tarefaEl.insertBefore(form, tarefaEl[0]);
}

function del(id, page) {
    page = page != '' ? '&pag=' + page : '';
    location.href = 'index.php?acao=deletar&id_tarefa=' + id + page;
}

function marcarRealizada(id, page) {
    page = page != '' ? '&pag=' + page : '';
    location.href = 'index.php?acao=marcarRealizada&id_tarefa=' + id + page;
}