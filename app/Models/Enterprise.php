<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Enterprise extends Model
{
    use HasUuids;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
    ];

}
