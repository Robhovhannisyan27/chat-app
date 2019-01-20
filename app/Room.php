<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Room extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'image', 'accessibility',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
