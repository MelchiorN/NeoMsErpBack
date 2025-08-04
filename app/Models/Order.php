<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Order extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'invoice_id',
        // 'date',
        'comment',
        'status',
        'user_id',
        'client_id',
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function invoice()
{
    return $this->belongsTo(Invoice::class);
}

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_order')
            ->withPivot( 'quantity')
            ->withTimestamps();
    }

     
}
