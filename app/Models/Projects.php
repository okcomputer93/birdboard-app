<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'owner_id'];

    public function path()
    {
        return route('projects.show', $this);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
