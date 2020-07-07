
    @csrf

    <div class="form-group">
        <label for="title">Titulo</label>
    <input name="title" type="text" class="form-control" id="title" placeholder="Titulo" value="{{ old('title', $category->title) }}">

        @error('title')
        <small class="text-danger">{{ $message }}</small>
        @enderror

    </div>

    <div class="form-group">
        <label for="url_clean">Url limpia</label>
        <input type="text" name="url_clean" class="form-control" id="url_clean" placeholder="Url limpia" value="{{ old('url_clean', $category->url_clean) }}">

        @error('url_clean')
        <small class="text-danger">{{ $message }}</small>
        @enderror

    </div>

    <input class="btn btn-primary" type="submit" value="Guardar">

