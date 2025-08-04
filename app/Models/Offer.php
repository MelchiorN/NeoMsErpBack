<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasUuids;
    protected $fillable = [
        'title',
        'description',
        'estimated_budget',
        'submission_date',
        'publication_date',
        'amount',
        'submission_deadline',
        'status',
        'offer_type_id',
        'offer_source_id',
        'enterprise_id',
        'user_id',

    ];
    public function offerType()
    {
    return $this->belongsTo(OfferType::class);
    }

    public function offerSource()
    {
    return $this->belongsTo(OfferSource::class);
    }

    public function enterprise()
    {
    return $this->belongsTo(Enterprise::class);
    }

    public function user()
    {
    return $this->belongsTo(User::class);
    }
}
