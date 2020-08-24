<?php

namespace App\Http\Controllers;

use App\file_metadata;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class FileMetadataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return file_metadata::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $inputs = $request->validate([
			'title' => 'required|string',
			'description' => 'required|string',
			'tags' => 'required|string'
        ]);

        if (!$request->hasFile('file')) {
			return response()->json([ 'error' => 'No file found.' ], 422);
        }
        
        $file = $request->file('file');

        if (!$file->isValid()) {
			return response()->json([ 'error' => 'File is not valid.' ], 422);
        }
        $fileExtension = $file->getClientOriginalExtension();
        // dd($fileExtension);
        // if ($file->getClientOriginalExtension() !== 'jpg' || $file->getClientOriginalExtension() !== 'mp4') {
		// 	return response()->json([ 'error' => 'File is not the right type.' ], 422);
        // }

        // $fileMimeType = $file->getMimeType();
        // dd($fileMimeType);
        // if ($fileMimeType !== "image/jpeg" || $fileMimeType !== 'mp4') {
		// 	return response()->json([ 'error' => 'File is not the right type.' ], 422);
        // }

        $name = 'file_' . time() .  '.' . $fileExtension;

		try {
			// $identifier = "{$clientUuid}/{$name}";
			$filePath = "{$name}";
            Storage::disk('public')->put($filePath, fopen($file, 'r+'));
        } catch(Throwable $e) {
            return response()->json([
				'error' => 'Columns were formatted incorrectly.',
				'errors' => $e->getErrors()
			], 422);
        }

        $fileMeta = new file_metadata();
        $fileMeta->title = $inputs["title"];
        $fileMeta->description = $inputs["description"];
        $fileMeta->tags = $inputs["tags"];
        $fileMeta->path = asset('storage/'.$name);
        $fileMeta->original_filename = $file->getClientOriginalName();
        $fileMeta->file_type = $fileExtension;
        $fileMeta->save();

        return response()->json(['status' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\file_metadata  $file_metadata
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $fileID)
    {
        $file = file_metadata::where("id", $fileID)->firstOrFail();

        return $file;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $inputs = $request->validate([
            'id' => 'required|string',
			'title' => 'required|string',
			'description' => 'required|string',
			'tags' => 'required|string'
        ]);
        $fileMeta = file_metadata::where("id", $inputs["id"])->firstOrFail();
        $fileMeta->title = $inputs["title"];
        $fileMeta->description = $inputs["description"];
        $fileMeta->tags = $inputs["tags"];
        $fileMeta->save();

        return response()->json(['status' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\file_metadata  $file_metadata
     * @return \Illuminate\Http\Response
     */
    public function destroy(file_metadata $file_metadata)
    {
        //
    }
}
