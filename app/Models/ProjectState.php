<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class ProjectState extends Model
{
    use HasUuids;

    protected $fillable = [
        'label',
        'date',
        'project_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
