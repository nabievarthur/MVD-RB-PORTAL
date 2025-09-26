<?php

namespace App\Services;

use App\Models\Contracts\HasFiles;
use App\Models\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use InvalidArgumentException;

class FileService
{
    /**
     * Универсальный метод для загрузки файлов
     */
    public function uploadFile(string|UploadedFile $file, HasFiles $model, string $folderName): void
    {
        if (is_string($file) && str_starts_with($file, 'data:image')) {
            $this->handleBase64Image($file, $model, $folderName);
        } elseif ($file instanceof UploadedFile) {
            $this->uploadFiles($folderName, $model, $file);
        }
    }

    /**
     * Загрузка одного или нескольких файлов
     */
    public function uploadFiles(string $folderName, HasFiles $model, UploadedFile|array $files): void
    {
        $files = is_array($files) ? $files : [$files];
        $folders = [];

        foreach ($files as $file) {
            $path = $file->store($folderName, 'public');

            $this->storeFile(
                $model,
                $path,
                $file->getClientOriginalName(),
                $file->getClientMimeType(),
                $file->getSize()
            );

            $folders[] = $folderName;
        }

        $this->clearCacheFor($folders);
    }

    /**
     * Обработка base64 изображений
     */
    public function handleBase64Image(string $base64Image, HasFiles $model, string $folderName = 'uploads'): void
    {
        if (! preg_match('/^data:image\/(jpeg|jpg|png|gif|webp|bmp);base64,(.+)$/', $base64Image, $matches)) {
            throw new InvalidArgumentException('Invalid base64 image format');
        }

        $extension = strtolower($matches[1]) === 'jpeg' ? 'jpg' : strtolower($matches[1]);
        $decodedData = base64_decode($matches[2], true);

        if ($decodedData === false) {
            throw new InvalidArgumentException('Failed to decode base64 data');
        }

        if (strlen($decodedData) > 10 * 1024 * 1024) { // 10MB
            throw new InvalidArgumentException('File size too large');
        }

        $filename = $folderName.'/'.Str::uuid().'.'.$extension;
        Storage::disk('public')->put($filename, $decodedData);

        $this->storeFile(
            $model,
            $filename,
            'image.'.$extension,
            'image/'.$extension,
            strlen($decodedData)
        );

        $this->clearCacheFor([$folderName]);
    }

    /**
     * Удаление одного файла
     */
    public function destroyFile(File $file): void
    {
        $folderName = $this->deleteFile($file);
        $this->clearCacheFor([$folderName]);
    }

    /**
     * Удаление всех файлов модели
     */
    public function deleteModelFiles(HasFiles $model): void
    {
        $folders = [];

        foreach ($model->getFiles() as $file) {
            $folders[] = $this->deleteFile($file);
        }

        $this->clearCacheFor($folders);
    }

    /**
     * Сохранение информации о файле в базе
     */
    protected function storeFile(HasFiles $model, string $path, string $originalName, string $mimeType, int $size): void
    {
        $model->files()->create([
            'path' => $path,
            'original_name' => $originalName,
            'mime_type' => $mimeType,
            'size' => $size,
        ]);
    }

    /**
     * Удаление файла с диска и из базы, возврат имени папки
     */
    protected function deleteFile(File $file): string
    {
        if (Storage::disk('public')->exists($file->path)) {
            Storage::disk('public')->delete($file->path);
        }

        $pathParts = explode('/', $file->path);
        $folderName = $pathParts[0] ?: 'uploads';

        $file->delete();

        return $folderName;
    }

    /**
     * Очистка кеша для набора папок
     */
    protected function clearCacheFor(array $folders): void
    {
        foreach (array_unique($folders) as $folder) {
            Cache::tags([$this->getCacheTag($folder)])->flush();
        }
    }

    /**
     * Получение тега кеша на основе имени папки
     */
    protected function getCacheTag(string $folderName): string
    {
        return match ($folderName) {
            'leader_files' => 'leaders',
            'news_images' => 'news',
            'article_files' => 'articles',
            default => str_replace('_files', 's', $folderName),
        };
    }
}
