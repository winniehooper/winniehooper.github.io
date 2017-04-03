<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebSite extends Model
{
    public $timestamps = false;
    protected $fillable = [
      'website_url',
    ];
}
