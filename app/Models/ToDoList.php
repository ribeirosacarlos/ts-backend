<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDoList extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id'];

    // Relacionamento com Task
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // Relacionamento com User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
