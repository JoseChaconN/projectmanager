<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stage extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];
    
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_stages')->withTimestamps();
    }
    public function activities()
    {
        return $this->belongsToMany(Activity::class, 'project_stage_activities')->withTimestamps();
    }
}
