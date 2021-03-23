<?php

namespace C1x1\Helpdesk\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class C1x1Users extends Model
{
    use HasFactory;

    protected $table = 'c1x1users';

    protected $fillable = [
        'is_admin',
        'firstname',
        'lastname',
        'email',
        'session'
    ];

    protected $guarded = [
        'is_admin'
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    public function chatroom() {
        return $this->hasMany(C1x1Chatroom::class);
    }
}
