<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnualConference extends Model
{
    use HasFactory;

    protected $table = 'annual_conferences';

    protected $fillable = [
        'title',
        'theme',
        'description',
        'date',
        'location',
        'objective',
        'status',
        'speaker_id',
    ];

    public function speaker()
    {
        return $this->belongsTo(Speaker::class);
    }

}
