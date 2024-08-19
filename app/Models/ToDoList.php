<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDoList extends Model
{
    use HasFactory;

    protected $table = "task_list";

    protected $fillable = [
        'task',
        'description',
        'status',
        'due_date',
        'user_id',
    ];
}
