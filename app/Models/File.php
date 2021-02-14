<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
        'size',
    ];

    public static function booted()
    {
        //on ajoute automatiquement un uuid a la création
        static::creating(function ($file){
            $file->uuid = Str::uuid();
        });

        //quand on supprime un fichier peut importe ou on le supprime, on le supprimera aussi de amazon s3
        static::deleted(function ($file){
            Storage::disk('s3')->delete($file->path);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function links()
    {
        return $this->hasOne(FileLink::class);
    }
}
