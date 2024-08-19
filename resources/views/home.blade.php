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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.min.js" integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
            <div class="card-body">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="d-flex">
                            <h2>Lista de Tarefas</h2>
                        </div>

                        <button type="button" data-target="#addModal" class="btn btn-success" data-toggle="modal">Nova Tarefa</button>
                    </div>

                    <br>

                    <table class="table table-striped table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Tarefa</th>
                                <th>Descrição</th>
                                <th>Status</th>
                                <th>Data de Entrega</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($todolist as $item)
                            <tr>
                                <th scope="row">{{ $item->id }}</th>
                                <td>{{ $item->task }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->status }}</td>
                                <td>{{ $item->due_date }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('todo.edit', $item->id) }}" class="btn btn-primary btn-sm">Editar</a>

                                    <form action="{{route('todo.destroy') }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <button type="submit" class="btn btn-danger btn-sm">Deletar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('todo.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Adicionar Tarefa</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" name="task" required>
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Data de Entrega</label>
                            <input type="date" class="form-control" name="due_date" required>
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-select" name="status">
                                <option value="Pendente">Pendente</option>
                                <option value="Em Progresso">Em Progresso</option>
                                <option value="Concluída">Concluída</option>
                            </select>
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Descrição</label>
                            <textarea class="form-control" name="description" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                        <input type="submit" class="btn btn-success" value="Enviar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

<script>
    let table = new DataTable('#myTable');
</script>

</html>