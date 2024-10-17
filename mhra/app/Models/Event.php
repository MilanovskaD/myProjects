<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $fillable = [
        'title',
        'theme',
        'description',
        'objective',
        'date',
        'location',
        'speaker_id',
    ];

    public function speaker()
    {
        return $this->belongsTo(Speaker::class);
    }

}
