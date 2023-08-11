<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class FileService
{
    private $fileRepository;

    public function __construct(
        \App\Repositories\FileRepository\FileRepository $fileRepository
    )
    {
        $this->fileRepository = $fileRepository;
    }

    /**
     * @throws \Exception
     */
    public function store($file, $fileableType, $fileableId)
    {
        try {

            $uuid = Uuid::uuid4()->toString();
            $filename = "{$uuid}.{$file->extension()}";
            $pathToFile = "file/{$filename}";

            Storage::disk('local')->put($pathToFile, $file);

            return $this->fileRepository->create([
                'uuid' => $uuid,
                'name' => $file->getClientOriginalName(),
                'path' => $pathToFile,
                'mime_type' => $file->getClientMimeType(),
                'fileable_type' => $fileableType,
                'fileable_id' => $fileableId
            ]);

        }catch (\Exception $e){
            Log::error($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    public function massStore($files, $fileableType, $fileableId){
        try {

            $result = [];
            foreach ($files as $file){
                $uuid = Uuid::uuid4()->toString();
                $filename = "{$uuid}.{$file->extension()}";
                $pathToFile = "file/{$filename}";
                
                // dd($file);

                Storage::disk('local')
                ->put(
                    $pathToFile,
                    file_get_contents($file->getRealPath())
                );

                $result[] = $this->fileRepository->create([
                    'uuid' => $uuid,
                    'name' => $file->getClientOriginalName(),
                    'path' => $pathToFile,
                    'mime_type' => $file->getClientMimeType(),
                    'fileable_type' => $fileableType,
                    'fileable_id' => $fileableId
                ]);
            }

            return $result;

        }catch (\Exception $e){
            Log::error($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }


    public function massStoreBase64Files($files, $fileableType, $fileableId){
        try {

            $result = [];
            foreach ($files as $file){
                $f = finfo_open();
                $mimeType = finfo_buffer($f, base64_decode($file), FILEINFO_MIME_TYPE);
                $extension = Str::after($mimeType, '/');
                $uuid = Uuid::uuid4()->toString();
                // $filename = "{$uuid}.{$extension}";
                $filename = "{$uuid}.{$extension}";
                $pathToFile = "file/{$filename}";

                Storage::disk('local')
                    ->put(
                        $pathToFile,
                        base64_decode($file)
                    );

                $result[] = $this->fileRepository->create([
                    'uuid' => $uuid,
                    'name' => $filename,
                    'path' => $pathToFile,
                    'mime_type' => $mimeType,
                    'fileable_type' => $fileableType,
                    'fileable_id' => $fileableId
                ]);
            }

            return $result;

        }catch (\Exception $e){
            Log::error($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }


    public function storeBase64Img($file, $fileableType, $fileableId){
        try {
            $uuid = Uuid::uuid4()->toString();
            $filename = "{$uuid}.png";
            $pathToFile = "file/{$filename}";

            Storage::disk('local')
                ->put(
                    $pathToFile,
                    base64_decode($file)
                );

            $f = finfo_open();

            $mimeType = finfo_buffer($f, base64_decode($file), FILEINFO_MIME_TYPE);

            return $this->fileRepository->create([
                'uuid' => $uuid,
                'name' => $filename,
                'path' => $pathToFile,
                'mime_type' => $mimeType,
                'fileable_type' => $fileableType,
                'fileable_id' => $fileableId
            ]);

        }catch (\Exception $e){
            Log::error($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    // get file by id

    public function getById($id)
    {
        return $this->fileRepository->find($id);
    }

    // download file

    public function download($id)
    {
        $file = $this->fileRepository->find($id);
        return Storage::disk('local')->download($file->path, $file->name);
    }

    // delete file by id

    public function deleteById($id)
    {
        return $this->fileRepository->delete($id, 'uuid');
    }

    // list files of fileable type and fileable id

    public function list($fileableType, $fileableId)
    {
        return $this->fileRepository->search([
            ['fileable_type','=',$fileableType],
            ['fileable_id','=',$fileableId]
        ],['*'], ['*'], 'created_at', 'desc');
    }

    public function stream($id){
        $file = $this->fileRepository->find($id);
        return Storage::disk('local')->get($file->path);
    }

    public function getMimeType($id){
        $file = $this->fileRepository->find($id);
        return Storage::disk('local')->mimeType($file->path);
    }

    public function getFileInfo($id){
        $file = $this->fileRepository->find($id);
        return [
            'name' => $file->name,
            'size' => Storage::disk('local')->size($file->path),
            'last_modified' => Storage::disk('local')->lastModified($file->path),
            'mime_type' => Storage::disk('local')->mimeType($file->path),
        ];
    }

}