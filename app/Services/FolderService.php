<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FolderService
{
    public function fileMv(string $filePath, string $folderName): string
    {
        // Получаем содержимое файла
        $content = file_get_contents($filePath);

        $hashedName = md5($filePath . time()) . '.' . 'jpeg';


        $storagePath = $folderName . '/' . $hashedName;

        Storage::disk('public')->put($storagePath, $content);

        // Получаем публичный путь
        return Storage::url($storagePath);
    }
}