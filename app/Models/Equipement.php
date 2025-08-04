<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    use HasUuids;
    
    protected $fillable = [
        'group',
        'model',
        'serial_number',
        'comment',
        'registration_date',
    ];
    //
}
