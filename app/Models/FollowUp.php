<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class FollowUp extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'label',
        'dateRelance',
        'invoice_schedule_id',
    ];

    public function invoiceSchedule()
    {
        return $this->belongsTo(InvoiceSchedule::class);
    }
}
