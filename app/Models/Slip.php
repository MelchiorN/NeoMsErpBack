<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Slip extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'date',
        'address',
    ];

    public function slipType()
    {
        return $this->belongsTo(SlipType::class);
    }
}
