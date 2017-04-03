<?php

namespace App\Models;

use App\Notifications\ProjectSponsorNotification;
use App\Notifications\SponsorNotification;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Order extends Model
{

    const STATUS_PENDING = 'pending';
    const STATUS_COMPLETED = 'completed';
    const STATUS_DECLINED = 'declined';
    const STATUS_AUTHORIZED = 'authorized';
    const STATUS_REFUNDED = 'refunded';
    const STATUS_SYSTEM = 'system';
    const STATUS_VOIDED = 'voided';
    const STATUS_FAILED = 'failed';

    use CrudTrait;

     /*
	|--------------------------------------------------------------------------
	| GLOBAL VARIABLES
	|--------------------------------------------------------------------------
	*/

    //protected $table = 'orders';
    //protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
    protected $casts = ['data'=>'array'];

    /*
	|--------------------------------------------------------------------------
	| FUNCTIONS
	|--------------------------------------------------------------------------
	*/

    public function completeOrder($transaction) {
        $sponsor = Sponsor::create([
          'user_id'        => $this->user_id,
          'project_id'     => $this->project_id,
          'transaction_id' => $transaction->id,
          'sum'            => $this->amount,
          'gift_id'        => $this->gift_id,
          'view_flag'      => $this->data['view_flag'],
        ]);

        $sponsor->user->notify(new SponsorNotification($sponsor));
        $sponsor->project->user->notify(new ProjectSponsorNotification($sponsor));

        $this->status = Order::STATUS_COMPLETED;
        $this->save();
    }

    public function cancelOrder() {

        $this->status = Order::STATUS_DECLINED;
        $this->save();
    }

    /*
	|--------------------------------------------------------------------------
	| RELATIONS
	|--------------------------------------------------------------------------
	*/

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
    /*
	|--------------------------------------------------------------------------
	| SCOPES
	|--------------------------------------------------------------------------
	*/

    /*
	|--------------------------------------------------------------------------
	| ACCESORS
	|--------------------------------------------------------------------------
	*/

    /*
	|--------------------------------------------------------------------------
	| MUTATORS
	|--------------------------------------------------------------------------
	*/
}
