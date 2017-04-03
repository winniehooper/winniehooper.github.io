<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['to_client_id', 'from_client_id', 'text'];

    public function from()
    {
        return $this->belongsTo(User::class, 'from_client_id', 'id');
    }

    public function to()
    {
        return $this->belongsTo(User::class, 'to_client_id', 'id');
    }

}
