<?php

namespace App\Http\Controllers;

use App\Models\Directory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class DirectoryController extends Controller
{
    public function index()
    {
        $directories = Directory::all(['id', 'name']);

        return view('directory/index', [
            'directories' => $directories,
            'url' => route('directory.create'),
        ]);
    }

    public function show(int $id)
    {
        return view('directory.show', ['directory' => Directory::findOrFail($id)]);
    }

    public function create(Request $request)
    {
        if ($request->isMethod('POST')) {
            $validated = $request->validate([
                'name' => 'required|unique:directories|max:255',
            ]);
            $directory = Directory::create($validated);
            Storage::disk('uploads')->makeDirectory($validated['name']);

            return redirect()->route('directory.show', ['id' => $directory->id]);
        }

        return view('directory.new');
    }

    public function edit(int $id, Request $request)
    {
        $directory = Directory::findOrFail($id);

        if ($request->isMethod('POST')) {
            $validated = $request->validate([
                'name' => 'required|unique:directories|max:255',
            ]);
            $name = $validated['name'];

            Storage::disk('uploads')->move(Directory::__DIR__.'/'.$directory->name, Directory::__DIR__.'/'.$name);

            $directory->name = $name;
            $directory->save();
        }

        return view('directory.edit', ['directory' => $directory]);
    }

    public function delete(int $id)
    {
        $dir = Directory::findOrFail($id);
        try {
            rmdir(Directory::__DIR__ . '/' . $dir->name);
        } catch (\Throwable $th) {
            session(['message' => 'Assurez vous que le dossier soit vide']);

            return redirect()->route('directory.edit', ['id' => $dir->id]);
        }
        $dir->delete();

        return redirect()->route('directory.index');
    }
}
