<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\File;
use App\Services\FolderService;
use Illuminate\Http\Request;
use App\Http\Requests\FileRequest;
use App\Http\Requests\FolderRequest;
use App\Models\Patient;

use Exception;

class FolderController extends Controller
{
    private $folderService;

    public function __construct(FolderService $service)
    {
        $this->folderService = $service;
    }
    public function store(FolderRequest $request, Patient $patient)
    {
        $storage = env('FILESYSTEM_DRIVER');
        try {
            $this->folderService->store($request->validated(), $patient->id, $storage);
        } catch (Exception $e) {
            abort(500, $e->getMessage());
        }

        return redirect()->route('patient.show', $patient);
    }

    public function show(Folder $folder)
    {
        $folder->loadMissing(['subFolders', 'patient']);
        $patient = $folder->patient;

        $parent_folder_collection = $this->folderService->getParentFolders($folder->parent_folder_id, $folder->level);


        return view('patient.folders.show', compact('folder', 'patient', 'parent_folder_collection', ));
    }

    public function update(FolderRequest $request, Folder $folder)
    {
        $folder->update($request->validated());

        return redirect()->route('folder.view', $folder)
            ->with('flash_message', 'updated');
    }
    public function destroy(Folder $folder)
    {
        $folder->loadFiles();
        
        $storage = env('FILESYSTEM_DRIVER');

        $isDeleted = $this->folderService->destroy(
            $folder->folder_path,
            $folder,
            $storage
        );

        if ($folder->level != 1) {
            $parent = Folder::findOrFail($folder->parent_folder_id);
            return redirect()->route('folder.view', $parent)->with('flash_message', 'deleted');
        }

        $patient = $folder->patient;
        return redirect()->route('patient.show', $patient)->with('flash_message', 'deleted');
    }

    public function showFiles(Folder $folder)
    {
        return $this->folderService->getFilesDataTables($folder);
    }

    public function storeFile(FileRequest $request, Folder $folder)
    {
        $storage = env('FILESYSTEM_DRIVER');
        $stored = $this->folderService->storeFile($folder, $request->file('file'), $storage);

        if ($stored) {
            return redirect()->route('folder.view', $folder)->with('flash_message', 'Addedd!');
        } else {
            abort(500, 'No es posible completar la solicitud');
        }
    }
    public function destroyFile(File $file)
    {
        $storage = env('FILESYSTEM_DRIVER');

        $this->folderService->destroyFile($file, $storage);

        return response()->json([
            "success" => true
        ]);
    }
    public function downloadFile(File $file)
    {
        $storage = env('FILESYSTEM_DRIVER');

        return $this->folderService->downloadFile($file, $storage);
    }

}
