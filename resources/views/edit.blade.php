<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de Tarefas</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.min.css">
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.min.js"></script>

<body>
    <div class="container">
        <br>
        
        @if(\Session::has('msg'))
        <div class="alert alert-success" role="alert">
            {!! \Session::get('msg') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="card">
            <form action="{{ route('todo.update', $todolist->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="card-header">
                    <h4 class="card-title">Alterar Tarefa</h4>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" class="form-control" name="task" value="{{ $todolist->task }}" required>
                    </div>

                    <div class="form-group">
                        <label>Data de Entrega</label>
                        <input type="date" class="form-control" name="due_date" value="{{ $todolist->due_date }}" required>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-select" name="status">
                            <option @if($todolist->status == 'Pendente') selected @endif value="Pendente">Pendente</option>
                            <option @if($todolist->status == 'Em Progresso') selected @endif value="Em Progresso">Em Progresso</option>
                            <option @if($todolist->status == 'Concluída') selected @endif value="Concluída">Concluída</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Descrição</label>
                        <textarea class="form-control" name="description" required>{{ $todolist->description }}</textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('todo.home')}}" class="btn btn-default btn-sm">Cancelar</a>
                    <input type="submit" class="btn btn-info" value="Enviar">
                </div>
            </form>
        </div>
</body>

</html>