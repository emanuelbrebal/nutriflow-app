<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;

    protected $fillable = [
        'planner_id',
        'description',
        'finished',
        'due_date',
    ];

    protected $casts = [
        'finished' => 'boolean', 
        'due_date' => 'date',    
    ];

    public function planner()
    {
        return $this->belongsTo(Planner::class);
    }
}