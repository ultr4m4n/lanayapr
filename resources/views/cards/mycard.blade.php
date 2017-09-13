@extends('layouts.app')

@section('pagestyle')
<link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
@stop

@section('content')
{{ csrf_field() }}
@if(Session::has('success_destroy'))
        <div class="col-md-12 alert danger text-center">
            {{Session::get('success_destroy')}}
        </div>
    @endif
<div style="height: id='screenH'">
@if(Session::has('success_create'))
		<div class="col-md-12 alert success text-center">
			{{Session::get('success_create')}}
		</div>
	@elseif(Session::has('success_change'))
		<div class="col-md-12 alert success text-center">
			{{Session::get('success_change')}}
		</div>
	@else
	@endif
	<div class="profile-footer col-md-12">
		<div class="col-md-8 col-md-offset-2">
		<div class="panel-heading text-center"><h1>My Events</h1></div>
			<div style="height:100%"  class="tabs" id="tabs">
			<ul>
				<li><a href="#tabs-1"><h4>Live Event</h4></a></li>
				<li><a href="#tabs-2"><h4>Past Event</h4></a></li>
				<li><a href="#tabs-3"><h4>My Draft</h4></a></li>
			</ul>
				<div id="tabs-1">
				@if($user->cards->count())
					@foreach ( $user->cards as $card)
					@if($card->date_start > Carbon\Carbon::now() && $card->live == 2)
						<a href="/cards/{{ $card->id }}">
							<div class="panel col-md-12 card-container panel-default">
							<div class="col-md-3 img-box">
								<img style="width:150px;height:130px" src="{{asset('photos/'.$card->image)}}">
							</div>
				                <div class="col-md-5">
			                    	<p>{{ $card->title }} </p>
									<p>{{ date('M jS, Y', strtotime($card->date_start)) }}</p>
								</div>
								<div class="col-md-4">
									<a class="btn pull-left" href="{{ route('EditCard',['id'=>$card->id])}}">Edit</a>
									<form class="delete" action="{{ route('DeleteCard', $card->id) }}" method="GET">
								        <input type="hidden" name="_method" value="DELETE">
								        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
								        <input class="btn" type="submit" value="Delete">
								    </form>
								    <a class="btn" href="{{ route('Follower',['id'=>$card->id])}}">View Followers</a>
				                 </div>   
			                </div>
						</a>	
						@else
				@endif
					@endforeach
				@else
				<div class="text-center jumbotron"><p>No events</p></div>
				@endif
				</div>
				<div id="tabs-2">
				@if($user->cards->count())
					@foreach ( $user->cards as $card)
					@if($card->date_start < Carbon\Carbon::now() && $card->live == 2)
						<a href="/cards/{{ $card->id }}">
							<div class="panel col-md-12 card-container panel-default">
							<div class="col-md-3 img-box">
								<img style="width:150px;height:130px" src="{{asset('photos/'.$card->image)}}">
							</div>
				                <div class="col-md-5">
			                    	<p>{{ $card->title }} </p>
									<p>{{ date('M jS, Y', strtotime($card->date_start)) }}</p>
								</div>
								<div class="col-md-4">
									<a class="btn pull-left" href="{{ route('EditCard',['id'=>$card->id])}}">Edit</a>
									<form class="delete" action="{{ route('DeleteCard', $card->id) }}" method="GET">
								        <input type="hidden" name="_method" value="DELETE">
								        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
								        <input class="btn" type="submit" value="Delete">
								    </form>
								    <a class="btn" href="{{ route('Follower',['id'=>$card->id])}}">View Followers</a>
				                 </div>   
			                </div>
						</a>	
						@else
				@endif
					@endforeach
				@else
				<div class="text-center jumbotron"><p>No events</p></div>
				@endif
				</div>
				<div id="tabs-3">
				@if($user->cards->count())
					@foreach ( $user->cards as $card)
					@if($card->live == 0 || $card->live == 1)
						<a href="/cards/{{ $card->id }}">
							<div class="panel col-md-12 card-container panel-default">
							<div class="col-md-3 img-box">
								<img style="width:150px;height:130px" src="{{asset('photos/'.$card->image)}}">
							</div>
				                <div class="col-md-5">
			                    	<p>{{ $card->title }} </p>
									<p>{{ date('M jS, Y', strtotime($card->date_start)) }}</p>
								</div>
								<div class="col-md-4">
									<a class="btn pull-left" href="{{ route('EditCard',['id'=>$card->id])}}">Edit</a>
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
						@else
				@endif
					@endforeach
				@else
				<div class="text-center jumbotron"><p>No events</p></div>
				@endif
				</div>
			</div>		
		</div>
	</div>
</div>
@stop

@section('pagescripts')
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
	<script src="{{ asset('js/tabsNConfirm.js') }}"></script>
@stop