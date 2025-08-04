<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class OfferType extends Model
{
    use HasUuids;
    protected $fillable = [
        'label',
    ];

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
}
