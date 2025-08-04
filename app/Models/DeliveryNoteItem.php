<?php

namespace App\Models;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DeliveryNoteItem extends Model
{
    //
    use HasUuids;
    protected $fillable = [
        // 'id',
        'delivery_note_id',
        'article_id',
        'product_code',
        'designation',
        'serial_number',
        'quantity_ordered',
        'quantity_delivered'
    ];

    public function deliveryNote()
    {
        return $this->belongsTo(DeliveryNote::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

}
