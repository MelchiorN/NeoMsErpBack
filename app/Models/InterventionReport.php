<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class InterventionReport extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'diagnosis',
        'performed_test',
        'address',
        'date',
        'done_work',
        'client_id',
        'user_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
