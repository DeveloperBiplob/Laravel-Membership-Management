<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'created_by',
        'updated_by',
        'custom_id',
        'nid',
        'reference_member_id',
        'status',
        'deleted_by',
    ];
}
