<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class MaintenanceContract extends Model
{
    use HasUuids;
     protected $fillable =[
       'name',
       'email',
       'phone',
       'address',
       'user_id',
       'client_id',
     ];

     public function user()
     {
         return $this->belongsTo(User::class);
     }

     public function client()
     {
         return $this->belongsTo(Client::class);
     }
}
