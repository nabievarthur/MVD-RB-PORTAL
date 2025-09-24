<?php

namespace App\Services;

use App\Models\Contracts\HasFiles;
use App\Models\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class FileService
{
    /**
     * Универсальный метод для загрузки файлов (поддерживает base64 и UploadedFile)
     */
    public function uploadFile($file, HasFiles $model, string $folderName): void
    {
        if (is_string($file) && strpos($file, 'data:image') === 0) {
            $this->handleBase64Image($file, $model, $folderName);
        } elseif ($file instanceof UploadedFile) {
            $this->uploadFiles($folderName, $model, $file);
        }
    }

    /**
     * Загрузка одного или нескольких файлов (традиционный способ)
     */
    public function uploadFiles(string $folderName, HasFiles $model, $files): void
    {
        $files = is_array($files) ? $files : [$files];

        foreach ($files as $file) {
            $path = $file->store($folderName, 'public');

            $model->files()->create([
                'path' => $path,
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getClientMimeType(),
                'size' => $file->getSize(),
            ]);
        }

        $this->clearCache($folderName);
    }

    /**
     * Обработка base64 изображений
     */
    public function handleBase64Image(string $base64Image, HasFiles $model, string $folderName = 'uploads'): void
    {
        if (! preg_match('/^data:image\/(jpeg|jpg|png|gif|webp|bmp);base64,(.+)$/', $base64Image, $matches)) {
            throw new \InvalidArgumentException('Invalid base64 image format');
        }

        $extension = strtolower($matches[1]);
        $data = $matches[2];
        // Нормализация расширений
        if ($extension === 'jpeg') {
            $extension = 'jpg';
        }

        $decodedData = base64_decode($data, true);
        if ($decodedData === false) {
            throw new \InvalidArgumentException('Failed to decode base64 data');
        }

        // Валидация размера файла (например, максимум 10MB)
        if (strlen($decodedData) > 10 * 1024 * 1024) {
            throw new \InvalidArgumentException('File size too large');
        }

        $filename = $folderName.'/'.uniqid('', true).'.'.$extension;

        Storage::disk('public')->put($filename, $decodedData);

        $model->files()->create([
            'path' => $filename,
            'original_name' => 'image.'.$extension,
            'mime_type' => 'image/'.$extension,
            'size' => strlen($decodedData),
        ]);

        $this->clearCache($folderName);
    }

    public function destroyFile(File $file): void
    {
        if (Storage::disk('public')->exists($file->path)) {
            Storage::disk('public')->delete($file->path);
        }

        $file->delete();

        $pathParts = explode('/', $file->path);
        $folderName = $pathParts[0];
        $this->clearCache($folderName);
    }

    /**
     * Удаление всех файлов модели
     */
    public function deleteModelFiles(HasFiles $model): void
    {
        $folderNames = [];

        foreach ($model->getFiles() as $file) {

            $pathParts = explode('/', $file->path);
            $folderName = $pathParts[0];
            $folderNames[$folderName] = true;

            if (Storage::disk('public')->exists($file->path)) {
                Storage::disk('public')->delete($file->path);
            }
            $file->delete();
        }

        foreach (array_keys($folderNames) as $folderName) {
            $this->clearCache($folderName);
        }
    }

    /**
     * Очистка кеша для конкретной папки
     */
    protected function clearCache(string $folderName): void
    {
        $cacheTag = $this->getCacheTag($folderName);
        Cache::tags([$cacheTag])->flush();
    }

    /**
     * Получение тега кеша на основе имени папки
     */
    protected function getCacheTag(string $folderName): string
    {
        $mapping = [
            'leader_files' => 'leaders',
            'news_images' => 'news',
            'article_files' => 'articles',
        ];

        return $mapping[$folderName] ?? str_replace('_files', 's', $folderName);
    }
}
