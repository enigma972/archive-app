<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier dossier</title>
</head>

<body>
    <h1>Modifier dossier</h1>

    <p>{{ session('message') }}</p>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="" method="post">
        <label for="">Nom du dossier</label>
        <input type="text" name="name" id="" value="{{ $directory->name }}" required>
        @csrf
        <button type="submit">Valider</button>
    </form>

    @include('directory.delete')
</body>

</html>
