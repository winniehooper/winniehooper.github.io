<?php

namespace App;

use App\Models\Comment;
use App\Models\Project;
use App\Models\Social;
use App\Models\Sponsor;
use App\Models\WebSite;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Backpack\CRUD\CrudTrait;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use CrudTrait;
    use HasRoles;

    protected $attributes = array(
      'avatar' => 'avatar.jpg',
      'settings' => '{"notifications":{"send_comments_flag":1,"send_other_comments_flag":1,"send_news_flag":1}}',
    );

    protected $casts = [
      'settings' => 'array',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'confirmation_code', 'confirmed', 'residency', 'information', 'settings',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'confirmation_code',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function sponsored()
    {
        return $this->belongsToMany(Project::class, 'sponsors');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function webSites()
    {
        return $this->hasMany(WebSite::class);
    }

    public function draftProjects()
    {
        return $this->projects()
                    ->whereStatus(Project::STATUS_DRAFT);
    }

    public function social()
    {
        return $this->hasMany(Social::class);
    }


    public function getHistoryAttribute() {
        return Carbon::now()->diffForHumans($this->created_at, true, true);
    }

    public function getEmailObfuscatedAttribute() {
        return preg_replace('|(.)(.*)(@.*)|', '${1}...${3}', $this->email);
    }

    public function getAvatar($type) {
        if ($this->avatar) {
            return url('images/avatars/avatar_'.$type.'/'.$this->avatar);
        } else {
            return '';
        }
    }


}
