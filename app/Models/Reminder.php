<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Reminder extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'label',
        'date',
        'invoice_schedule_id',
        'user_id',
    ];

    public function invoiceSchedule()
    {
        return $this->belongsTo(InvoiceSchedule::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
