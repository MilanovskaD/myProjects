<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';

    protected $fillable = [
        'bought_by',
        'event_id',
        'annual_conference_id',
        'price_per_person',
        'price_per_company',
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
