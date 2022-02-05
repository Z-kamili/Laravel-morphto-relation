<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function image()
    {
        return $this->morphOne('App\Models\Image', 'imageable');
    }
}
