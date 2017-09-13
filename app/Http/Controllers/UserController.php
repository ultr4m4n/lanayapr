<?php

namespace App\Http\Controllers;

use App\NotifyMe;
use App\Card;
use App\User;
use \Auth;
use Illuminate\Http\Request;
use Image;
use Storage;


class UserController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   
        $this->middleware('auth', ['except' => ['showUserProf']]);
        $this->middleware('admin', ['except' => ['showUserProf','edit','updateMyProfile','addNoti','unfollow']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query=$request->get('mode');
        if($query){
            $users=$query ? User::search($query)->orderBy('id')->paginate(6):User::all();
            
        return view('pages.index', compact('users'));
        }
        else{
            $users = User::paginate(6);
        return view('pages.index',compact('users'));
        }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $cards = $user->load('cards')->paginate(6);
        // return $user;
        return view('pages.show')->with('user', $user)->with('cards', $cards);
    }

    public function showUserProf($id)
    {   

        $user = User::find($id);
        $user->load('cards')->paginate(6);
        return view('pages.profile')->with('user', $user);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {   
        // $this->authorize('update', $id);
        // $user = User::find($id);
        $user = Auth::user();
        return view('pages.editprofile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {   
        $this->validate($request, [

        'image' => 'dimensions:min_width=100,min_height=100,image|mimes:jpeg,png,jpg,gif,svg|max:4098',

        ]);
        $user->update($request->all());
        if($request->hasFile('image')){
            $image=$request->file('image');
            $imageName=time().'.'.$image->getClientOriginalName();
            $location='photos/'.$imageName;
            Image::make($image)->save($location);
            $oldPhoto=$user->image;
            $user->image=$imageName;
            if($oldPhoto != 'default.jpg'){
                Storage::delete($oldPhoto);
                $user->save();
                return redirect()->route('EProfile', ['id' => $user->id])
                ->with('success_change','profile successfully changed!');
            }
            else{
                $user->save();
                return redirect()->route('EProfile', ['id' => $user->id])
                ->with('success_change','profile unsuccessfully changed!');
            }            
        }        
                $user->save();
                return redirect()->route('EProfile', ['id' => $user->id])
                ->with('success_change','profile successfully changed!');  
    }

    public function updateMyProfile(Request $request, User $user)
    {   
        
        $this->validate($request, [

        'image' => 'dimensions:min_width=100,min_height=200,image|mimes:jpeg,png,jpg,gif,svg|max:4098',

        ]);
        if($user->id == Auth::id() || Auth::user()->level == 2){
        $user->update($request->only('name','bio','fb','twitter','ig','phoneno'));
        if($request->hasFile('image')){
            $image=$request->file('image');
            $imageName=time().'.'.$image->getClientOriginalName();
            $location='photos/'.$imageName;
            Image::make($image)->save($location);
            $oldPhoto=$user->image;
            $user->image=$imageName;
            if($oldPhoto != 'default.jpg'){
                Storage::delete($oldPhoto);
                $user->save();
                return redirect()->route('EditMyProfile', ['id' => Auth::id()])
                ->with('success_change','profile successfully changed!');
            }
            else{
                $user->save();
                return redirect()->route('EditMyProfile', ['id' => Auth::id()])
                ->with('success_change','profile unsuccessfully changed!');
            }            
        }        
                $user->save();
                return redirect()->route('EditMyProfile', ['id' => Auth::id()])
                ->with('success_change','profile successfully changed!');   
    }
    else{
        abort(404, 'Page not found');
    }

}

    public function addNoti($id){
        $card = Card::find($id);
        // $noti = NotifyMe::create($request->all());
        if (!Auth::user()->isFollowing($card->id)) {
            // Create a new follow instance for the authenticated user
            Auth::user()->follows()->create([
                'user_id' =>Auth::id(),
                'card_id' => $card->id,
            ]);
            return back()->with('success_follow','You are following this event');

        } else {
            return back()->with('error', 'You are already following this event');
        }

    }
    public function unfollow($card_id)
    {
        if (Auth::User()->isFollowing($card_id)) {
            $follow = Auth::user()->follows()->where('user_id','=',\Auth::user()->id)->where('card_id','=',$card_id)->first();
            $follow->delete();

            return back()->with('success_destroy', 'You are no longer following this event');
        } else {
            return back()->with('error', 'You are not following this event');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return back();
    }
}
