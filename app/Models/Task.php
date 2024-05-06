<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Task extends Model implements HasMedia
{
    use HasFactory,SoftDeletes,InteractsWithMedia;
    protected $guarded = [];

    /*public function project(): HasOne
    {
        return $this->HasOne(Project::class);
    }*/
    public function stage(): HasOne
    {
        return $this->HasOne(Stage::class);
    }
    public function activity(): HasOne
    {
        return $this->HasOne(Activity::class);
    }
}
