<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_stage_activities')->withTimestamps();
    }
    public function stages()
    {
        return $this->belongsToMany(Stage::class, 'project_stage_activities')->withTimestamps();
    }
}
