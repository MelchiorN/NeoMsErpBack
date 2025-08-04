<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ModePayment extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'label',
        'statut',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
