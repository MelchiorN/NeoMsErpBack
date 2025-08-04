<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Purchase extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'date',
        'quantity',
        'supplier_id',
        'article_id',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
