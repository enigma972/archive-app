<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau dossier</title>
</head>

<body>
    <h1>Nouveau dossier</h1>

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
        <input type="text" name="name" id="" required>
        @csrf
        <button type="submit">Valider</button>
    </form>
</body>

</html>
