<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskList extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'task_lists';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'subject', 'description','start_date','end_date','status','priority','is_active','created_at','updated_at','deleted_at'];
}
