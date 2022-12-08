<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Models\File;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function store(StoreFileRequest $request) {
        $file = $request->validated()['file'];        
        $file_name = $file->getClientOriginalName();

        Storage::disk('local')->put($file_name, $file);

        return response()->json([
            'data' => File::create([
                'filename' => $file_name
            ]),
        ], Response::HTTP_CREATED);
    }
}
