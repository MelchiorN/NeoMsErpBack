<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class InvoiceType extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'label',
        'description',
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
