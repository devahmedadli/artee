<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileDownloaderController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $path = urldecode($request->input('file_path'));
        // dd($path);
        
        // Check if the file exists using the default disk
        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'File not found');
        }

        // Get the file name
        $name = microtime(true) . '.' . pathinfo($path, PATHINFO_EXTENSION);

        // Get the file's MIME type
        $mimeType = Storage::disk('public')->mimeType($path);

        // Return the file download response with name and content type
        return Storage::disk('public')->download($path, $name, ['Content-Type' => $mimeType]);
    }
}
