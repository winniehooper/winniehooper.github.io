<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\Lang;

class Project extends Model
{
    use CrudTrait;

    const STATUS_DRAFT = 'draft';
    const STATUS_MODERATION = 'moderation';
    const STATUS_PUBLISHED = 'published';

     /*
	|--------------------------------------------------------------------------
	| GLOBAL VARIABLES
	|--------------------------------------------------------------------------
	*/

    //protected $table = 'projects';
    //protected $primaryKey = 'id';
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    protected $dates = ['started_at', 'created_at', 'updated_at'];

    protected $with = ['comments', 'user'];
    protected $perPage = 16;

    /*
	|--------------------------------------------------------------------------
	| FUNCTIONS
	|--------------------------------------------------------------------------
	*/

    protected function updateTimestamps()
    {
        if (! $this->isDirty('started_at')) {
            $this->started_at = $this->freshTimestamp();
        }

        parent::updateTimestamps();
    }

    public function setNeededSumAttribute($value) {
        $this->attributes['needed_sum']  = doubleval(str_replace(' ', '', $value));
    }

    /*
	|--------------------------------------------------------------------------
	| RELATIONS
	|--------------------------------------------------------------------------
	*/

    public function faqs()
    {
        return $this->hasMany(FAQ::class, 'projectId');
    }

    public function gifts()
    {
        return $this->hasMany(Gift::class, 'projectId');
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    public function sponsors()
    {
        return $this->hasMany(Sponsor::class);
    }

    /*
	|--------------------------------------------------------------------------
	| SCOPES
	|--------------------------------------------------------------------------
	*/

    /**
     * Scope a query to only include popular users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->where('status', '=', Project::STATUS_PUBLISHED);
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFavourite($query)
    {
        return $query;//$query->where('status', '=', Project::STATUS_PUBLISHED);
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStart($query)
    {
        return $query;
    }
    /**
     * Scope a query to only include popular users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSuccessfully($query)
    {
        return $query;
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCompleted($query)
    {
        return $query;
    }

    /*
	|--------------------------------------------------------------------------
	| ACCESORS
	|--------------------------------------------------------------------------
	*/

    public function getViewToken() {
        return md5($this->id . $this->user_id. config('app.key'));
    }

    public function getPercentAttribute() {
        if (!$this->needed_sum) {
            return 0;
        }
        return round(($this->collected_sum/$this->needed_sum)*100);
    }

    public function getDaysLeftAttribute() {
        $n = $this->targetDate->diffInDays(Carbon::now());
        $plural = plural_form($n);
        return Lang::choice('messages.days', $plural, ['days' => $n]);
    }

    public function getTargetDateAttribute() {
        return $this->started_at->addDays($this->days_count);
    }

    public function getUrlAttribute() {
        return route('project', $this->id);
    }

    public function getStatusNameAttribute() {
        return [
          self::STATUS_DRAFT => 'Черновик',
          self::STATUS_MODERATION=> 'На модерации',
          self::STATUS_PUBLISHED=> 'Опубликован',
        ][$this->status];
    }

    public function getVideoPreview($type = '') {
        if ($this->preview_url) {
            return url('images/project_images/'.$this->preview_url);
        } else {
            return '';
        }
    }

    public function getImageUrl($type) {
        if ($this->image) {
            return url('images/project_images/project_'.$type.'/'.$this->image);
        } else {
            return '';
        }
    }


    /*
	|--------------------------------------------------------------------------
	| MUTATORS
	|--------------------------------------------------------------------------
	*/
}
