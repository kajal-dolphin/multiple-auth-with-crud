<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'addresses';

    protected $primarykey = 'id';

    protected $fillable = ['id','user_id','address','make_as_default','created_at','updated_at','deleted_at'];
}
