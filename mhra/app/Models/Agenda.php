<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $table = 'agenda';

    protected $fillable = [
        'details',
        'event_id',
        'annual_conference_id',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function annual_conference()
    {
        return $this->belongsTo(AnnualConference::class);
    }
}
