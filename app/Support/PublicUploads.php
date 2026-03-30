<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PublicUploads
{
    public static function store(?UploadedFile $file, string $directory): ?string
    {
        if (!$file) {
            return null;
        }

        $targetDirectory = public_path('uploads/'.$directory);
        File::ensureDirectoryExists($targetDirectory);

        $extension = strtolower((string) ($file->extension() ?: $file->guessExtension() ?: 'bin'));
        $filename = Str::uuid()->toString().'.'.$extension;
        $file->move($targetDirectory, $filename);

        return 'uploads/'.$directory.'/'.$filename;
    }

    public static function delete(?string $relativePath): void
    {
        if (!$relativePath) {
            return;
        }

        $fullPath = public_path($relativePath);
        if (File::exists($fullPath)) {
            File::delete($fullPath);
        }
    }
}