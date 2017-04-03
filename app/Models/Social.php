<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected $table = 'user_auth';
    protected $fillable = ['user_id', 'provider', 'provider_id'];
    static protected $mapping = [
      'vkontakte' => ['icon'=>'vk', 'title' => 'ВКонтакте'],
      'odnoklassniki' => ['icon'=>'ok', 'title' => 'Одноклассники'],
      'facebook' => ['icon'=>'fb', 'title' => 'Facebook'],
      'google' =>['icon'=>'gp', 'title' => 'Google+'],
    ];


    protected function getIconAttribute() {
        return 'profile.icons.'.self::$mapping[$this->provider]['icon'];
    }

    protected function getTitleAttribute() {
        return self::$mapping[$this->provider]['title'];
    }

    public static function plugins()
    {
        return [
            'vk',
            'ok',
            'fb',
            'gp',
        ];
    }
}
