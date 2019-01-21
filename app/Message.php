<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Message extends Model
{
    /**
 	* Fields that are mass assignable
	*
	* @var array
	*/
	protected $fillable = ['message', 'room_id', 'user_id'];

	public function user()
	{
	  return $this->belongsTo(User::class);
	}
}
