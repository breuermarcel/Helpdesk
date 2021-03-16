<?php

namespace C1x1\Helpdesk\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class C1x1Chatroom extends Model
{
    use HasFactory;

    protected $table = 'c1x1chatroom';

    protected $fillable = [
        'owner_id',
        'member_id'
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    public function messages() {
        $this->hasMany(C1x1Messages::class);
    }

    public function owner() {
        $this->belongsTo(C1x1Users::class, 'owner_id');
    }

    public function member() {
        $this->belongsTo(C1x1Users::class, 'member_id');
    }
}
