@extends('layouts.app')

@section('pagestyle')
<link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
@stop

@section('content')
<div class="panel user">
	<div class="banner-search">
		<form method="get">
			<div class="search-bar user">
				<label  class="label-text">
	      			<input type="search" name="mode" placeholder="Search users" id="mode"/><button type="submit"><span class="glyphicon glyphicon-search"></span></button>
	    		</label>
			</div>
		</form>
		<div class="text-center">
			<a class="btn" href="/pages">All</a>
			<a class="btn" href="/pages/?mode=admin">Admin</a>
			<a class="btn" href="/pages/?mode=organizer">Organizer</a>
			<a class="btn" href="/pages/?mode=user">Member</a>
		</div>
	</div>
</div>
<div style="height: id='screenH'">
<div style="height:100%" >
    <div class="col-md-8 card-panel col-md-offset-2 panel">
      @if($users->count())
		 @foreach ($users as $user)
		<div class="col-md-12 card-container panel">
			  <div class="col-md-3 img-box">
			  <a href="{{ route('Profile',[$user->id])}}">
			  	<img style="width:140px;height:130px;border-radius:5px" src="{{asset('photos/'.$user->image)}}">
			  </a>
			  </div>
              <div class="col-md-5">
            	<p><span style="font-weight:bold">id:</span> {{ $user->id }} </p>
				<p><span style="font-weight:bold">email:</span> {{ $user->email }} </p>
				<p><span style="font-weight:bold">name:</span> {{ $user->name }} </p>
				@if( $user->level===1 )
                    <p><span style="font-weight:bold">role:</span> Organizer</p>
                                    
                @elseif( $user->level===2 )
                    <p><span style="font-weight:bold">role:</span> Admin</p>
                                    
                @else
                    <p><span style="font-weight:bold">role:</span> Member</p>
                @endif
              </div>
            <div class="col-md-4">
				<a class="btn pull-left" href="/pages/{{ $user->id }}">edit</a>
				@if($user->id==Auth::id())
				<form action="" method="">
			        <input class="btn" type="submit" value="This is you">
			    </form>
				@else
				<form class="delete" action="{{ route('DeleteUser', $user->id) }}" method="GET">
			        <input type="hidden" name="_method" value="DELETE">
			        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
			        <input class="btn" type="submit" value="Delete">
			    </form>
				@endif
            </div>
        </div>
         @endforeach
    @else
    <div class="text-center jumbotron"><p>User not found</p></div>
    @endif
    </div>
    <div class="text-center col-md-12">{{ $users->links() }}</div>
   </div>
</div>
	
@stop

@section('pagescripts')
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
	<script src="{{ asset('js/tabsNConfirm.js') }}"></script>
@stop