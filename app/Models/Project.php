<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasUuids;
    protected $fillable = [
        'name',
        'start_date',
        'estimated_end_date',
        'end_date',
        'comment',
        'offer_id',
    ];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
}
