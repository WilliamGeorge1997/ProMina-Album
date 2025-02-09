<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'album_id', 'path'];

    public function album()
    {
        return $this->belongsTo(album::class);
    }
}
