<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Patient, File};

class Folder extends Model
{
    use HasFactory;
    protected $table = 'folders';
    protected $guarded = [];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'id_patient', 'id');
    }

  
    public function subFolders()
    {
        return $this->hasMany(self::class, 'parent_folder_id', 'id');
    }

    public function parentFolder()
    {
        return $this->belongsTo(self::class, 'parent_folder_id', 'id');
    }
    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }
    public function loadFiles()
    {
        return $this->load('files');
    }

}
