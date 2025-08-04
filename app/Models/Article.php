<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Article extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'label',
        'description',
        'price',
        'number',
        'minimum_limit',
        'maximum_limit',
    ];
    public function orders(){
        return $this-> belongToMany(Order::class,'article_order')->withPivot('quantity')->withTimestamps();
    }
}
