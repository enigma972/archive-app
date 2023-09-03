<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Directory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function uploads(Request $request, int $id)
    {
        $directory = Directory::findOrFail($id);

        if ($request->isMethod('POST') && $request->hasFile('file')) {
            $uploadedFile = $request->file('file');
            $file = new File();

            $file->name = $uploadedFile->getClientOriginalName();

            do {
                $reference = sha1(uniqid(more_entropy: true)).'.'.$uploadedFile->getClientOriginalExtension();
                /** @var \Illuminate\Database\Eloquent\Collection */
                $files = File::where('reference', '=', $reference)->get();
            } while (!$files->isEmpty());

            $file->reference = $reference;
            $file->directory_id = $directory->id;
            $file->save();

            $disk = Storage::disk('uploads');
            $path = $directory->name.'/'.$file->reference;
            $disk->put($path, $uploadedFile->getContent());

            return redirect()->route('directory.show', ['id' => $directory->id]);
        }

        return view('files.uploads');
    }

    public function download(int $id, string $reference)
    {
        $directory = Directory::findOrFail($id);
        $file = File::where(['reference' => $reference])->with('directory')->get()->first();

        if ($directory->id == $file->directory->id) {
            $filename = storage_path('uploads/'. $directory->name . '/' . $file->reference, $file->name);

            return response()->download($filename, $file->name);
        }

        return redirect()->route('directory.show', ['id' => $directory->id]);
    }

    public function delete(int $id)
    {
        $file = File::findOrFail($id);
        Storage::disk('uploads')->delete($file->reference);
        $file->delete();
        return redirect()->route('directory.show', ['id' => $file->directory->id]);
    }
}
