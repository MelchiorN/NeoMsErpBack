<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Payment extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'date',
        'amount',
        'mode_payment_id',
        'invoice_id',
    ];

    public function modePayment()
    {
        return $this->belongsTo(ModePayment::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
