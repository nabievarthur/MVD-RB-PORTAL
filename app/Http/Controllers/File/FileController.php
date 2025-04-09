<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function destroy(File $file, Request $request)
    {
        $file->delete();

        return response()->json([
            'message' => 'Файл удалён успешно'
        ], 200);
    }
}
