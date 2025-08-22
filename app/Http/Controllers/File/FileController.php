<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Services\FileService;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function __construct(public FileService $fileService)
    {
    }

    public function destroy(File $file)
    {

        $this->fileService->destroyFile($file);


        return response()->json([
            'message' => 'Файл удалён успешно'
        ], 200);
    }
}
