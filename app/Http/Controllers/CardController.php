<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Card;
use \Auth;
use Image;
use Storage;

class CardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show','map']]);
        $this->middleware('organizer', ['only' => ['create','edit',]]);
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        $query=$request->get('mode');
        if($query){
            $cards=$query ? Card::search($query)->orderBy('date_start')->paginate(6):Card::all();
        return view('cards.index', compact('cards'));
        }
        else{
            $cards = Card::where('live', '=', 2)->where('date_start','>=',date('y-m-d'))->orderBy('date_start')->paginate(6);
        return view('cards.index', compact('cards'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cards.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $this->authorize('create',  $request);
        $this->validate($request, [

        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4098',

        ]);
        $card = Card::create($request->all()
            );
        if($request->hasFile('image')){
            $image=$request->file('image');
            $imageName=time().'.'.$image->getClientOriginalName();
            $location='photos/'.$imageName;
            Image::make($image)->save($location);
            $card->image=$imageName;
            $card->save();
        }
        $card->save();
        return redirect()->route('MyCards', ['id' => Auth::id()])
        ->with('success_create','Event successfully created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card)
    {   
        return view('cards.show', compact('card'));
    }

    public function showMyCard()
    {   
        $user = Auth::user();
        $user->load('cards');   
        return view('cards.mycard')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   

        $card = Card::find($id);
        $user_id = $card->user_id;
        $authid = Auth::id();
        if($user_id == $authid || Auth::user()->level == 2){
        return view('cards.editcard', compact('card'));
        }
        else
            abort(404, 'Page not found');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Card $card)
    {   
        $this->validate($request, [

        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        $user_id = $card->user_id;
        $authid = Auth::id();
        if($user_id == $authid || Auth::user()->level == 2){
        $card->update($request->only('title','location','lat','lng','date_start','date_end','sunrise','sunset','category','description','live'));
        if($request->hasFile('image')){
            $image=$request->file('image');
            $imageName=time().'.'.$image->getClientOriginalName();
            $location='photos/'.$imageName;
            Image::make($image)->save($location);
            $oldPhoto=$card->image;
            $card->image=$imageName;
            if($oldPhoto != 'default.jpg'){
                Storage::delete($oldPhoto);
                $card->save();
            }
            else{
                $card->save();
            }
        }
        return redirect()->route('MyCards', ['id' => Auth::id()])
        ->with('success_change','Event successfully changed!');
    }
    else{
            abort(404, 'Page not found');
    }
    }
    public function blockCard()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $card = Card::find($id);
        $oldPhoto=$card->image;
            if($oldPhoto != 'default.jpg'){
                Storage::delete('photos/'.$oldPhoto);
                Card::destroy($id);
            }
            else{
                echo 'fail to delete';
                return back()->with('fail_destroy','Event image fail to delete!');
            }
        return back()->with('success_destroy','Event successfully deleted!');
    }
}