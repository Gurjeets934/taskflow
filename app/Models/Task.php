<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

class Task extends Model
{
    //
    protected $fillable = [
    'title',
    'is_completed',
    'due_date',
    'attachment',
];

    public function project()
{
    return $this->belongsTo(Project::class);
}
}
