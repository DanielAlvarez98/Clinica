<?php

namespace App\Services;

use App\Models\File;
use App\Models\Folder;
use Exception;

use Yajra\DataTables\Facades\DataTables;

class FolderService
{
    public function store($request, int $patient_id, $storage)
    {
        $folder = Folder::create($request + [
            'id_patient' => $patient_id,
            "level" => 1
        ]);
        if ($folder) {
            $file_type = 'archivos';
            $category = 'pacientes';
            $belongsTo = 'pacientes';

            $directory = app(FileService::class)->makeDirectory(
                $folder,
                $file_type,
                $category,
                $belongsTo
            );

            $directory .= "/folders/" . $folder->id;


            $isStored = app(FileService::class)->storeDirectory(
                $directory,
                $storage
            );

            if ($isStored) {
                $folder->update([
                    "folder_path" => $directory
                ]);

                return $folder;
            }
        }
        throw new Exception(config('parameters.exception_message'));

    }

    public function getParentFolders(?int $folder_id, int $folder_level)
    {
        $parent_folder_collection = collect();
        $last_folder_id = $folder_id;

        for ($i = 1; $i < $folder_level; $i++) {
            $parent_folder = Folder::where('id', $last_folder_id)
                ->select('id', 'name', 'parent_folder_id')
                ->first();
            $parent_folder_collection = $parent_folder_collection->push($parent_folder);
            $last_folder_id = $parent_folder->parent_folder_id;
        }

        return $parent_folder_collection->reverse();
    }
    public function storeSubfolder($request, $course_id, $folder_id, $folder_level, $folder_path, $storage)
    {
        $subfolder = Folder::create($request + [
            'id_course' => $course_id,
            'parent_folder_id' => $folder_id,
            'level' => $folder_level + 1
        ]);

        if ($subfolder) {
            $subfolder->update(['folder_path' => $folder_path . '/' . $subfolder->id]);

            app(FileService::class)->storeDirectory(
                $subfolder->folder_path,
                $storage
            );
            return $subfolder;
        }
    }

    public function destroy($folder_path, Folder $folder, $storage)
    {
        if ($folder->files->isNotEmpty()) {
            foreach ($folder->files as $file) {
                app(FileService::class)->destroy(
                    $file,
                    $storage
                );
            }
        }

        $deleted_folders_ids = array($folder->id);
        $i = 0;

        while (array_key_exists($i, $deleted_folders_ids)) {
            $subFolders = Folder::where('parent_folder_id', $deleted_folders_ids[$i])
                ->with('files')->get();

            if (!$subFolders->isEmpty()) {
                foreach ($subFolders as $subFolder) {
                    if ($subFolder->files->isNotEmpty()) {
                        foreach ($subFolder->files as $file) {
                            app(FileService::class)->destroy(
                                $file,
                                $storage
                            );
                        }
                    }
                    array_push($deleted_folders_ids, $subFolder->id);
                }
            }

            $i++;
        }

        $isDeleted = Folder::whereIn('id', $deleted_folders_ids)->delete();

        if ($isDeleted) {
            app(FileService::class)->destroyDirectory($folder_path, $storage);
        }

        return $isDeleted;
    }
    public function getFilesDataTables(Folder $folder)
    {
        $allFiles = DataTables::of($folder->files())
            ->addColumn('filename', function ($file) {
                return '<a href="' . route('folders.file.download', $file) . '">' .
                    basename($file->file_path)
                    . '</a> ';
            })
            ->editColumn('file_type', function ($file) {
                return ucwords($file->file_type);
            })
            ->editColumn('category', function ($file) {
                return ucwords($file->category);
            })
            ->addColumn('parent_folder', function ($file) use ($folder) {
                return $folder->name;
            })
            ->editColumn('created_at', function ($file) {
                return $file->created_at;
            })
            ->editColumn('updated_at', function ($file) {
                return $file->updated_at;
            })
            ->addColumn('action', function ($file) {

                $btn = '<a href="javascript:void(0)" data-id="' .
                    $file->id . '" data-original-title="delete"
                                    data-url="' . route('patient.file.delete', $file) . '" class="deleteFile"><svg xmlns="http://www.w3.org/2000/svg" height="1em" class="svg_delet" viewBox="0 0 448 512"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                                    </a>';
                return $btn;
            })
            ->rawColumns(['filename', 'action'])
            ->make(true);

        return $allFiles;
    }

    public function storeFile(Folder $folder, $file, $storage)
    {
        $file_type = 'archivos';
        $category = 'pacientes';
        $belongsTo = 'folder';
        $relation = 'one_many';

        return app(FileService::class)->store(
            $folder,
            $file_type,
            $category,
            $file,
            $storage,
            $belongsTo,
            $relation
        );
    }

    public function destroyFile(File $file, $storage)
    {
        return app(FileService::class)->destroy($file, $storage);
    }

    public function downloadFile(File $file, $storage)
    {
        return app(FileService::class)->download($file, $storage);
    }

}