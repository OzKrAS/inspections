<?php

namespace App\Repositories\FileRepository;
use App\Repositories\BaseRepository;

class FileRepository extends BaseRepository implements IFileRepository
{
    public function __construct(\App\File $model)
    {
        parent::__construct($model);
    }

}