<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FolderService
{
    public function fileMv($file, string $folderName): string
    {
        if (!($file instanceof \Illuminate\Http\UploadedFile)) {
            throw new \InvalidArgumentException('Expected an instance of UploadedFile.');
        }

        $originalName = $file->getClientOriginalName();
        $hashedName = md5($originalName . time()) . '.' . $file->getClientOriginalExtension();

        $storagePath = $folderName . '/' . $hashedName;

        Storage::disk('public')->put($storagePath, file_get_contents($file->getRealPath()));

        return Storage::url($storagePath);
    }
}