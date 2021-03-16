<?php

namespace C1x1\Helpdesk\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class C1x1Users extends Model
{
    use HasFactory;

    protected $table = 'c1x1_users';
    protected $primaryKey = 'id';

    protected $fillable = [
    ];

    protected $hidden = [
    ];

    protected $casts = [
    ];
}
