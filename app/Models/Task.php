<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use RecordsActivity;

    use HasFactory;

    protected $fillable = ['body', 'completed'];

    protected $touches = ['project'];

    protected $casts = ['completed' => 'boolean'];

    protected static $recordableEvents = ['created', 'deleted'];

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
}
