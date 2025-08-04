<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class ProjectStep extends Model
{
    use HasUuids;

    protected $fillable = [
        'label',
        'estimated_start_date',
        'actual_start_date',
        'estimated_end_date',
        'actual_end_date',
        'comment',
        'status',
        'project_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
