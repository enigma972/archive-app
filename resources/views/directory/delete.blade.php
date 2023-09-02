<form method="post" action="{{ route('directory.delete', ['id'=> $directory->id]) }}" onsubmit="return confirm('Etes-vous sûr de vouloir supprimer cet element?');">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger btn-block mt-3">Supprimer</button>
</form>
