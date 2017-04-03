<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = ['id'];
    protected $casts = ['data' => 'array', 'payload' => 'array', 'message_variables' => 'array'];
}
