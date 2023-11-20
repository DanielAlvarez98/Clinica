<?php

namespace App\Services;

class AllService
{
    public function store($model ,array $data)
    {
        return $model::create($data);
    }
    public function updateModel($model, array $data)
    {
        $model->update($data);
        return $model;
    }
    public function deleteModel($modelClass, $modelId)
    {
        $model = $modelClass::find($modelId);
        if ($model) {
            $model->delete();
            return true; 
        }
        return false;
    }

    public function deletePhoto($img)
    {
        if ($img !== 'assets/img/fotos/default.png') {
            if (!empty($img) && file_exists(public_path($img))) {
                unlink(public_path($img));
            }
        }
    }
}
