<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'last_name',
        'first_name',
        'email',
        'phone',
        'company_name',
        'is_archived',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * The primary key type.
     *
     * @var string
     */
    // protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    // public $incrementing = false;
}
