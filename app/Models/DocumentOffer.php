<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class DocumentOffer extends Model
{
    use HasUuids;
    protected $fillable = [
        'label',
        'description',
        'offer_id',
    ];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
}

