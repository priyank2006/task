<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "tasks";

    protected $fillable = [
        'taskName',
    ];

    public function subTasks()
    {
        return $this->hasMany(SubTask::class, 'task_id', 'id');
    }
}
