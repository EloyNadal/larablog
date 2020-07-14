
    @csrf

    <div class="form-group">
        <label for="name">Nombre</label>
    <input name="name" type="text" class="form-control" id="name" placeholder="Titulo" value="{{ old('name', $user->name) }}">

        @error('name')
        <small class="text-danger">{{ $message }}</small>
        @enderror

    </div>

    <div class="form-group">
        <label for="surname">Apellido</label>
        <input type="text" name="surname" class="form-control" id="surname" placeholder="Surname" value="{{ old('surname', $user->surname) }}">

        @error('surname')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ old('email', $user->email) }}">

        @error('email')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    @if ($pasw)
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Password" value="{{ old('password', $user->password) }}">

        @error('password')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    @endif


    <input class="btn btn-primary" type="submit" value="Guardar">

