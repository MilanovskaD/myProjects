<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $fillable = [
        'job_title',
        'name',
        'surname',
        'short_bio',
        'social_media',
        'profile_picture_path'
    ];
}
