<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La liste de dossiers</title>
</head>

<body>
    <h1>La liste de dossiers</h1>

    <ol>
        @forelse ($directories as $directory)
        <li>
            <a href="{{ route('directory.show', ['id' => $directory->id]) }}"> {{ $directory->name }}</a>
        </li>
        @empty
        <p>Aucun dossiers.</p>
        @endforelse
    </ol>

    <a href="{{ $url }}">Créer un nouveau</a>
</body>

</html>
