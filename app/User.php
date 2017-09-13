<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable 
{
    use Notifiable;
    // use Model;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'level', 'password', 'bio', 'image','ig','fb','twitter','phoneno'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'level', 'password', 'remember_token',
    ];

    public function cards(){

        return $this->hasMany(Card::class);

    }

    public function addCard(Card $card)
    {

        return $this->cards()->save($card);

    }

    public function scopeSearch($query, $search){

        if($search === "user" || $search === "users"){
            return $query->where('level', '=', 0);
        }
        elseif($search === "organizer" || $search === "organizers"){
            return $query->where('level', '=', 1);
        }
        elseif($search === "admin" || $search === "admins"){
            return $query->where('level', '=', 2);
        }
        else{
            return $query->where('name', 'LIKE', "%$search%")
                     ->orwhere('id', 'LIKE', "%$search%")
                     ->orwhere('email', 'LIKE', "%$search%");
        }
    }

    public function follows() {
        return $this->hasMany(Notifyme::class);
    }

    public function isFollowing($card_id)
    {
        return (bool)$this->follows()->where('user_id','=',\Auth::user()->id)->where('card_id','=',$card_id)->first(['id']);
    }

}
