
<div class="form-group">
    <label for="title">Titulo</label>
    <input name="title" type="text" class="form-control" id="title" placeholder="Titulo" value="{{ $postComment->title }}" readonly>
</div>

<div class="form-group">
    <label for="user_id">Usuario</label>
    <input type="text" name="user_id" class="form-control" id="user_id" placeholder="Usuario"
        value="{{ $postComment->user->name }}" readonly>
</div>

<div class="form-group">
    <label for="approved">Aprovado</label>
    <input type="email" name="approved" class="form-control" id="approved" placeholder="Aprovado"
        value="{{ $postComment->approved }}" readonly>
</div>

<div class="form-group">
    <label for="message">Contenido</label>
    <textarea name="message" type="text" class="form-control" id="content" rows="3" placeholder="Mensaje"
        value="" readonly>{{ $postComment->message }}</textarea>
</div>
