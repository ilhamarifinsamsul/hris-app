<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $fillable = [
        'title',
        'description',
        'assigned_to',
        'due_date',
        'status',
    ];

    public function employee(){
        return $this->belongsTo(Employee::class, 'assigned_to', 'id');
    }

}
