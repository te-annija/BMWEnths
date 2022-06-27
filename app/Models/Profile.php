<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = ['description','BMW_model', 'body_type', 'year', 'engine', 'power', 'image_path'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
