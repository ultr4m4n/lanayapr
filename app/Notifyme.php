<?php

namespace App;
use DB;
use App\User;
use App\Card;
use App\Notifyme;
use App\Follower;
use \Auth;
use Illuminate\Database\Eloquent\Model;

class Notifyme extends Model
{
    protected $fillable = [
        'card_id', 'user_id', ];

    public static function CountNoti()
    {
        $notes = DB::table('users')
            ->leftJoin('notifymes','users.id','=','notifymes.user_id')
            ->where('user_id', Auth::user()->id)
            ->where('status',0)
            ->get();
        $CardCount = 0;
        foreach ($notes as $note) {
            $cards = Card::where('id', $note->card_id)->get();
            foreach ($cards as $card) {
                $dateinput = $card->date_start; 
                $datestart = \Carbon\Carbon::createFromFormat( 'Y-m-d' , $dateinput );
                if( $datestart->isTomorrow(\Carbon\Carbon::now()) || $datestart->isToday(\Carbon\Carbon::now()))
                    $CardCount++;
                else{

                }
            }
        }
        return $Count = $CardCount;
    }
}
