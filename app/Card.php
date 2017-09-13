<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = ['title','user_id','location','lat','lng','date_start','date_end','sunrise','sunset','category','description','image','live','phoneno'];

    // protected $guard = ['user_id'];

    protected $table = 'cards';

    public function users(){

        return $this->belongsTo(User::class);
        
    }
    
    public function scopeSearch($query, $search){

		return $query->where('title', 'LIKE', "%$search%")
                     ->where('live', '=', 2)
                     ->whereDate('date_start','>=', date('y-m-d'))
                     ->orwhere('category','LIKE' ,"%$search%")
                     ->where('live', '=', 2)
                     ->whereDate('date_start','>=', date('y-m-d'));
		
	}
}

	
	