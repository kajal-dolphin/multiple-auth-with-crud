<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskList extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'task_lists';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'subject', 'description','start_date','end_date','status','priority','is_active','created_at','updated_at','deleted_at'];

    public function scopeFindTask($query, $id)
    {
        return $query->where('id',$id);
    }

    protected function startDate(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  Carbon::parse($value)->format('d-m-Y'),
            // set: fn ($value) =>  Carbon::parse($value)->format('Y-d-m'),
        );
    }

    protected function endDate(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  Carbon::parse($value)->format('d-m-Y'),
            // set: fn ($value) =>  Carbon::parse($value)->format('Y-d-m'),
        );
    }
}
