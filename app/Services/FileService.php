<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileService
{
    protected $disk;

    public function __construct()
    {
        $this->disk = Storage::disk('public');
    }

    /**
     * Upload file
     * @param UploadedFile $file
     * @param string $folder
     * @return string
     */
    public function upload(UploadedFile $file, string $folder): string
    {
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

        $this->disk->putFileAs($folder, $file, $fileName);

        return $fileName;
    }

    /**
     * Delete file
     * @param string $fileName
     * @param string $folder
     * @return void
     */
    public function delete(string $fileName, string $folder): void
    {
        if ($this->disk->exists("$folder/$fileName")) {
            $this->disk->delete("$folder/$fileName");
        }
    }
}
