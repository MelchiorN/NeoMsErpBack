<?php

namespace App\Models;
// use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DeliveryNote extends Model
{
    //
    use HasUuids;

    protected $fillable = ['order_id', 'delivery_date', 'delivery_address', 'delivery_type'];
    // Relation : un bordereau appartient à une commande
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

     // Relation : un bordereau a plusieurs items
    public function items()
    {
        return $this->hasMany(DeliveryNoteItem::class);
    }
}
