@extends('layouts.app')

@section('content')
@if(Session::has('success_destroy'))
        <div class="col-md-12 alert danger text-center">
            {{Session::get('success_destroy')}}
        </div>
    @endif
<div class="col-md-8 card-panel col-md-offset-2 panel">
    <div class="panel-heading">Users Profile</div>
    <div style="height: id='screenH'" >
        <div style="height:80%">
            <form style="padding-left:30px" class="form-horizontal" method="POST" action="/pages/{{ $user->id }}" enctype="multipart/form-data">
            {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <h3>User ID : {{ $user->id }}</h3>
                <div class="col-md-12">
                    <div class="form-group col-md-12 text-center">
                        <img id='img-upload' class="profile-photo" style="width:150px;height:150px" src="{{asset('photos/'.$user->image)}}">
                    </div>
                    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                        <div class="form-group col-md-4">
                        <label>Change Image</label>
                            <div class="input-group">
                            <input type="text" class="form-control" readonly>
                                <span class="input-group-btn">
                                    <span class="btn btn-default btn-file">
                                        Choose Image <input type="file" id="imgNp" name="image">
                                    </span>
                                    @if ($errors->has('image'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-md-4">
                    <label>Email</label>
                        <input type="text" name="email" class="form-control" value="{{ $user->email }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">
                    <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                    <label>User's role</label>
                        <select class="btn" name="level">
                            <option value="{{ $user->level }}">@if( $user->level===1 )
                                     Organizer
                                    
                                    @elseif( $user->level===2 )
                                     Admin
                                    
                                    @else
                                     Member
                                    
                                    @endif</option>
                            <option value="0">Member</option>
                            <option value="1">Organizer</option>
                            <option value="2">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                    <button class="btn" type="submit">save changes</button>
                    </div>
                </div>
            </form>
            <div class="profile-footer twelve columns">
                <h3>Users events</h3>
                @if($user->cards->count())
                    @foreach ( $user->cards as $card)
                    <a href="/cards/{{ $card->id }}">
                    <div class="panel col-md-12 card-container">
                        <div class="col-md-3 img-box">
                            <img style="width:150px;height:130px" src="{{asset('photos/'.$card->image)}}">
                        </div>
                        <div class="col-md-5">
                            <p>{{ $card->title }} </p>
                            <p>{{ date('M jS, Y', strtotime($card->date_start)) }}</p>
                        </div>
                        <div class="col-md-4">
                            <a class="btn" href="{{ route('EditCard',['id'=>$card->id])}}">edit</a>
                            <form class="delete" action="{{ route('DeleteCard', $card->id) }}" method="GET">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <input class="btn" type="submit" value="Delete">
                            </form>
                            @if($card->live == 1)
                                <div>This card has been blocked <i style="color:orange" class="fa fa-warning fa-2x"></i></div>
                                @else
                                @endif
                        </div>
                    </div>
                    </a>
                    @endforeach 
                    {{-- <div class="col-md-12 text-center">{{ $cards->links() }}</div> --}}
                @else
                <div class="text-center jumbotron"><p>This user have not created any events</p></div>
                @endif
            </div> 
        </div>
    </div>
</div>
@endsection

@section('pagescripts')
    <script src="{{ asset('js/external/jquery/jquery.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/form.js') }}"></script>
    <script src="{{ asset('js/tabsNConfirm.js') }}"></script>
@stop