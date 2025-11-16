<?php

declare(strict_types=1);

namespace App\Interfaces;

use Illuminate\Http\UploadedFile;

interface ImageManagerInterface
{
    public function upload(UploadedFile $file, string $directory, ?string $filename = null): string;

    public function uploadMultiple(array $files, string $directory): array;

    public function delete(?string $path): bool;

    public function deleteMultiple(array $paths): bool;

    public function url(?string $path): ?string;

    public function exists(?string $path): bool;
}
