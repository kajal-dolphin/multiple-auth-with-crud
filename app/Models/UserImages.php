<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserImages extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $table = 'user_images';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'image'];
}
