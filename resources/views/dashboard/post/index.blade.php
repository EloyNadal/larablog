@extends('dashboard.master')

@section('content')

<a class="btn btn-success  mt-3 mb-3" href="{{ route('post.create') }}">Crear</a>

<form action="{{ route('post.index') }}" class="form-inline mb-3">
    <select name="created_at" id="created_at" class="form-control">
        <option value="DESC">Descendente</option>
        <option {{request('created_at') == 'ASC' ? "selected" : "" }} value="ASC">Ascendente</option>
    </select>

    <input type="text" value="{{ request('search') }}" name="search" placeholder="Buscar..." class="form-control">
    <button type="submit" class="btn btn-success ml-2">Enviar</button>
</form>

<table class="table">
    <thead>
        <tr>
            <td>Id</td>
            <td>Título</td>
            <td>Categoría</td>
            <td>Posteado</td>
            <td>Creación</td>
            <td>Actualización</td>
            <td>Acciones</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
        <tr>
            <td>{{ $post->id }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->category->title }}</td>
            <td>{{ $post->posted }}</td>
            <td>{{ $post->created_at->format('d-m-Y') }}</td>
            <td>{{ $post->updated_at->format('d-m-Y') }}</td>
            <td>
                <a class="btn btn-primary" href="{{ route('post.show', $post->id) }}">Ver</a>
                <a class="btn btn-primary" href="{{ route('post.edit', $post->id) }}">Actualizar</a>
                <a class="btn btn-primary" href="{{ route('post-comment.post', $post->id) }}">Comentarios</a>
                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"
                    data-id="{{ $post->id }}">Eliminar</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $posts->appends([
    'created_at' => request('created_at'),
    'search' => request('search')
    ])
    ->links() }}

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id=" modalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p>¿Seguro que desea borrar el registro seleccionado?</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <form id="formDelete" action="{{ route('post.destroy', 0) }}"
                    data-action="{{ route('post.destroy', 0) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Borrar</button>
                </form>
            </div>

        </div>
    </div>
</div>


<script>
    window.onload = function(){

        $('#deleteModal').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget); // Button that triggered the modal
            var id = button.data('id'); // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

            //obtenemos el id del data action del form
            var action = $('#formDelete').attr('data-action').slice(0, -1) + id;

            //Le asignamos el nuevo id
            $('#formDelete').attr('action', action);

            var modal = $(this);
            modal.find('.modal-title').text('Vas a borrar el POST ' + id);
        });

    }
</script>



@endsection
