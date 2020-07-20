
    @csrf

    <div class="form-group">
        <label for="title">Titulo</label>
    <input name="title" type="text" class="form-control" id="title" placeholder="Titulo" value="{{ old('title', $post->title) }}">

        @error('title')
        <small class="text-danger">{{ $message }}</small>
        @enderror

    </div>

    <div class="form-group">
        <label for="url_clean">Url limpia</label>
        <input type="text" name="url_clean" class="form-control" id="url_clean" placeholder="Url limpia" value="{{ old('url_clean', $post->url_clean) }}">

        @error('url_clean')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="category_id">Categorías</label>
        <select class="form-control" name="category_id" id="category_id">
            @foreach ($categories as $title => $id)
                <option {{ $post->category_id == $id ? 'selected="selected"' : '' }} value="{{ $id }}">{{ $title }}</option>
            @endforeach
        </select>

        @error('category_id')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="posted">Posteado</label>
        <select class="form-control" name="posted" id="posted">
            @include('dashboard.partials.option-yes-no', ['val' => $post->posted])
        </select>

        @error('posted')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>


    <div class="form-group">
        <label for="content">Contenido</label>
        <textarea name="content" type="text" class="form-control" id="content" rows="3" placeholder="Contenido" value="">{{ old('content', $post->content) }}</textarea>

        @error('content')
        <small class="text-danger">{{ $message }}</small>
        @enderror

    </div>

<input type="hidden" id="token" value="{{ crsf_token }}">
    <input class="btn btn-primary" type="submit" value="Guardar">

