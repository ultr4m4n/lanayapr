<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Card;
use App\Notifyme;
use App\Follower;
use \Auth;
use Illuminate\Http\Request;

class FollowerController extends Controller
{   
    public function __construct()
    {
        $this->middleware('organizer', ['only' => ['show',]]);
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('testdate');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $follower = Follower::Create( $request->all());
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Follower  $follower
     * @return \Illuminate\Http\Response
     */
    public function show($id, Notifyme $users )
    {   

        $users = DB::table('users')
        ->leftJoin('notifymes','users.id','=','notifymes.user_id')
        ->where('card_id', $id)
        ->get();
        $nonusers = DB::table('followers')
        ->where('card_id', $id)
        ->get();
        return view('cards.showfollower',compact('users','nonusers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Follower  $follower
     * @return \Illuminate\Http\Response
     */
    public function edit(Follower $follower)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Follower  $follower
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Follower $follower)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Follower  $follower
     * @return \Illuminate\Http\Response
     */
    public function destroy(Follower $follower)
    {
        //
    }

    // public function follow(User $user)
    // {
    //     if (!Auth::user()->isFollowing($user->id)) {
    //         // Create a new follow instance for the authenticated user
    //         Auth::user()->follows()->create([
    //             'target_id' => $user->id,
    //         ]);

    //         return back()->with('success', 'You are now friends with '. $user->name);
    //     } else {
    //         return back()->with('error', 'You are already following this person');
    //     }

    // }

}
