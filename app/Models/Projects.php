<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'owner_id', 'notes'];

    public $old = [];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function path()
    {
        return route('projects.show', $this);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function addTask($body)
    {

        return $this->tasks()->create(compact('body'));
    }

    public function recordActivity($description)
    {
        $this->activity()->create([
            'description' => $description,
            'changes' => [
                'before' => array_diff($this->old, $this->getAttributes()),
                'after' => array_diff($this->getAttributes(), $this->old)
            ]
        ]);
    }

    public function activity()
    {
        return $this->hasMany(Activity::class, 'project_id')->latest();
    }
}
