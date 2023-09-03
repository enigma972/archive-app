<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>
    <h3>Le dossier {{ $directory->name }}</h3>
    <a href="{{ route('file.uploads', ['id' => $directory->id]) }}">Téléverser un fichier</a>
    <a href="{{ route('directory.edit', ['id' => $directory->id]) }}">Modifier le dossier</a>

    <ol>
        @foreach ($directory->files as $file)
        <li>
            <a href="{{ route('file.download', ['id' => $directory->id, 'reference' => $file->reference ]) }}">{{ $file->name }}</a> @include('files.delete')
        </li>
        @endforeach
    </ol>
</body>

</html>
