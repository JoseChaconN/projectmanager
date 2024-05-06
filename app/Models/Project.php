<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class Project extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];

    public function stages()
    {
        return $this->belongsToMany(Stage::class, 'project_stages')->withTimestamps();
    }
    public function activities()
    {
        return $this->belongsToMany(Activity::class, 'project_stage_activities')->withTimestamps();
    }
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
