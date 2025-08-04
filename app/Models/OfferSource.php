<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class OfferSource extends Model
{
    use HasUuids;
    protected $fillable = [
        'label',
        'reference',
    ];

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
}
