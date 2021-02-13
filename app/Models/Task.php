<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'completed'];

    protected $touches = ['project'];

    protected $casts = ['completed' => 'boolean'];

    public function complete()
    {
        $this->update(['completed' => true]);
        $this->recordActivity('completed_task');

    }

    public function incomplete()
    {
        $this->update(['completed' => false]);
        $this->recordActivity('incomplete_task');
    }

    public function project()
    {
        return $this->belongsTo(Projects::class, 'projects_id');
    }

    public function path()
    {
        return "/projects/{$this->project->id}/tasks/{$this->id}";
    }


    public function recordActivity($description)
    {
        $this->activity()->create([
            'project_id' => $this->projects_id,
            'description' => $description,
        ]);
    }

    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject')->latest();
    }

}
