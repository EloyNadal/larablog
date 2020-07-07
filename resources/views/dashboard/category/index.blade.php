@extends('dashboard.master')

@section('content')

<a class="btn btn-success  mt-3 mb-3" href="{{ route('category.create') }}">Crear</a>

<table class="table">
    <thead>
        <tr>
            <td>Id</td>
            <td>Título</td>
            <td>Creación</td>
            <td>Actualización</td>
            <td>Acciones</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->title }}</td>
            <td>{{ $category->created_at->format('d-m-Y') }}</td>
            <td>{{ $category->updated_at->format('d-m-Y') }}</td>
            <td>
                <a class="btn btn-primary" href="{{ route('category.show', $category->id) }}">Ver</a>
                <a class="btn btn-primary" href="{{ route('category.edit', $category->id) }}">Actualizar</a>
                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"
                    data-id="{{ $category->id }}">Eliminar</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $categories->links() }}

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p>¿Seguro que desea borrar el registro seleccionado?</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <form id="formDelete" action="{{ route('category.destroy', 0) }}"
                    data-action="{{ route('category.destroy', 0) }}" method="POST">
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
            modal.find('.modal-title').text('Vas a borrar la Categoría ' + id);
        });

    }
</script>



@endsection
