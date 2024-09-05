<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubTask extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'task_id',
        'title',
        'offset',
        'note',
        'date',
        'status',
        'deleted_at'
    ];

    public function task()
    {
        return $this->hasOne(Task::class, 'id', 'task_id');
    }

    
}
