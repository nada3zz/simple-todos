<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User\User;
use App\Models\Category\Category;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 
        'description', 
        'status', 
        'due_date', 
        'user_id', 
        'category_id'
    ];

    protected $casts = [
        'due_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
