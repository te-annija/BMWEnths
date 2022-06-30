<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'image_path', 'date', 'location', 'user_id', 'registred'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function userParticipations()
    {
        return $this->belongsToMany(User::class);
    }
}
