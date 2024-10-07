<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DownloadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function fileUploads(string $id)
    {
        try {
            $directoryPath = public_path("file_uploads/" . $id);
    
            if (!is_dir($directoryPath)) {
                return response()->json(['error' => 'Directory not found'], 404);
            }
    
            $zipFileName = "files_" . $id . ".zip";
            $zipFilePath = storage_path("app/" . $zipFileName);
    
            $zip = new \ZipArchive;
            if ($zip->open($zipFilePath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === TRUE) {
                $files = scandir($directoryPath);
                $files = array_diff($files, array('.', '..'));
    
                foreach ($files as $file) {
                    $filePath = $directoryPath . DIRECTORY_SEPARATOR . $file;
                    if (is_file($filePath)) {
                        $zip->addFile($filePath, $file);
                    }
                }
                $zip->close();
            } else {
                return response()->json(['error' => 'Unable to create zip file'], 500);
            }
    
            return response()->download($zipFilePath, $zipFileName)->deleteFileAfterSend(true);    
        } catch (Exception $e) {
            Log::error($e);
            return response()->json(['error' => 'Unable to fetch folder'], 500);
        }
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
