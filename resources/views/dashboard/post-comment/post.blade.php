@extends('dashboard.master')

@section('content')

<div class="col-6 mb-3">
    {{-- Colocamos un uno --}}
    <form action="{{ route('post-comment.post', 1) }}" id="filterForm">
        <div class="form-row">

            <div class="col-10">
                <select name="" id="filterPost" class="form-control">
                    @foreach ($posts as $p)
                    <option value="{{ $p->id }}" {{ $post->id == $p->id ? 'selected' : ''}}>
                        {{ Str::limit($p->title, 20) }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-2">
                <button class="btn btn-success" type="submit">Enviar</button>
            </div>

        </div>
    </form>
</div>



@if (count($postComments) > 0)

<table class="table">
    <thead>
        <tr>
            <td>Id</td>
            <td>Titulo</td>
            <td>Aprovado</td>
            <td>Usuario</td>
            <td>Creación</td>
            <td>Actualización</td>
            <td>Acciones</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($postComments as $postComment)
        <tr>
            <td>{{ $postComment->id }}</td>
            <td>{{ $postComment->title }}</td>
            <td>{{ $postComment->approved }}</td>
            <td>{{ $postComment->user->name }}</td>
            <td>{{ $postComment->created_at->format('d-m-Y') }}</td>
            <td>{{ $postComment->updated_at->format('d-m-Y') }}</td>
            <td>
                {{-- <a class="btn btn-primary" href="{{ route('post-comment.show', $postComment->id) }}">Ver</a> --}}

                <button class="btn btn-primary" data-toggle="modal" data-target="#showModal"
                    data-id="{{ $postComment->id }}">Ver</button>

                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"
                    data-id="{{ $postComment->id }}">Eliminar</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $postComments->links() }}

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
                <form id="formDelete" action="{{ route('post-comment.destroy', 0) }}"
                    data-action="{{ route('post-comment.destroy', 0) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Borrar</button>
                </form>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id=" modalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p class="message"></p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>


<script>

    window.onload = function(){

        $('#showModal').on('show.bs.modal',  function (event) {

            var button = $(event.relatedTarget);
            var id = button.data('id');

            var modal = $(this);

            $.ajax({
                method: "GET",
                url: '{{ URL::to("/") }}/dashboard/post-comment/j-show/' +id,
            })
            .done(function(comment){
                modal.find('.modal-title').text(comment.title);
                modal.find('.message').text(comment.message);

            });


        });


        $('#deleteModal').on('show.bs.modal', function (event) {
            console.log("test");
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

        $('#filterForm').submit(function(){
            var action = $(this).attr('action');
            action = action.replace(/[0-9]/g, $("#filterPost").val());
            $(this).attr('action', action);
        });

    };
</script>

@else

<h1>No hay comentarios para el post seleccionado</h1>

@endif

@endsection
