<?php

namespace App\Http\Controllers;

use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    private $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function upload(Request $request){
        try {

            $file = $request->file('file');
            $fileableType = $request->input('fileable_type');
            $fileableId = $request->input('fileable_id');

            $storedFile = $this->fileService->store($file, $fileableType, $fileableId);

            return response()->json($storedFile);

        }catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function massStore(Request $request){
        try {

            $files = $request->file('files');
            $fileableType = 'App\\'.$request->input('fileable_type');
            $fileableId = $request->input('fileable_id');

            $storedFiles = $this->fileService->massStore($files, $fileableType, $fileableId);

            return response()->json($storedFiles);

        }catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function delete(Request $request){
        try {

            $this->fileService->deleteById($request->id);

            return response()->json([
                'message' => 'File deleted successfully'
            ]);

        }catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function download($id){
        try {

           return $this->fileService->download($id);

        }catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function list($fileableType, $fileableId){
        try {

            $files = $this->fileService->list("App\\{$fileableType}", $fileableId);

            return response()->json($files);

        }catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
