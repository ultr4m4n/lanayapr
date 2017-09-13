@extends('layouts.app')

@section('pagestyle')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBrYX2ndcMZonN7HlUCuV6l-ck4dK5vbdg&sensor=false&libraries=places"></script>
<script type="text/javascript" src="{{ asset('js/external/jquery/jquery.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.leanModal.min.js') }}"></script>
@stop

@section('content')
@if(Session::has('success_destroy'))
        <div class="col-md-12 alert danger text-center">
            {{Session::get('success_destroy')}}
        </div>
@elseif(Session::has('success_follow'))
        <div class="col-md-12 alert success text-center">
            {{Session::get('success_follow')}}
        </div>
    @endif
<div class="show-card">
	<div class="eight columns offset-by-two banner-card-top text-center" style="background-image:url({{asset('photos/'.$card->image)}});background-size:cover;background-repeat:no-repeat;">
		<div class="b-event-cont show" style="border-radius: 0px">
			<div class="b-event-title show">
				<h1 class="show-title">{{ $card->title }}</h1>
			</div>
		</div>	
	</div>
<div class="eight columns offset-by-two columns card-footer show">
	<div class="twelve columns show-card-belt pdl-40">
		<div class="eight columns"><h3>Event Information</h3></div>
		@if (Auth::guest())
		<div class="four columns"><a id="modal_trigger" href="#modal" class="btn follow">Register for this event</a></div>
			<div id="modal" class="popupContainer" style="display:none;">
				<header class="popupHeader">
					<span class="header_title">Register For This Event</span>
					<span class="modal_close"><i class="fa fa-times"></i></span>
				</header>
				<section class="popupBody">
				<div class="social_login">
					<form action="{{ route('CreateFollower') }}">
						<label>Full Name</label>
						<input class="form-control" type="text" name="name" required/>
						<br />
						<input type="hidden" value="{{ $card->id }}" name="card_id"/>
						<label>Email Address</label>
						<input class="form-control" type="email" name="email" required/>
						<br />
						<label>Phone No.</label>
						<input class="form-control" type="text" name="phoneno" required/>
						<br />
						<div class="action_btns">
							<div class="pull-left"><input type="submit" class="btn" value="Register"></div>
							<a href="/register" style="padding-left:10px"> or join us now!</a>
						</div>
					</form>
				</div>
				</section>
			</div>
		@elseif(Auth::check())
			@if(!Auth::User()->isFollowing($card->id) && Auth::User()->id != $card->user_id)
		<div class="four columns">
			<form method="POST" action="{{ route('Noti',['id'=> $card->id ]) }}">
			{{ csrf_field() }}
				<input type="submit" value="Register" class="btn follow">
			</form>
		</div>
			@elseif(Auth::User()->id == $card->user_id)
		<div class="four columns">
			<a class="btn follow" href="{{ route('Follower',['id'=>$card->id])}}">View Followers</a>
		</div>
			@elseif(Auth::User()->isFollowing($card->id))
			<div class="four columns">
			<form>
				<a class="btn follow" href="{{ route('Unfollow',['id'=> $card->id ])}}">Unregister</a>
			</form>
		</div>
			@endif
		@else
		
		@endif
	</div>
	<div class="desc-card desc eight columns pdl-40 pdr-40">
		<h3>DESCRIPTION</h3>
		<p class="text-justify">{{ $card->description }}</p>
	</div>
	<div class="loc-card four columns">
		<h3 class="text-center">DATE & TIME</h3>
		<h5 class="pdl-40 pdr-40">{{ date('D, M jS, Y', strtotime($card->date_start))}}</h5>
		<h5 class="pdl-40 pdr-40">{{ date('H:i A', strtotime($card->sunrise))}} - {{ date('H:i A', strtotime($card->sunset))}}</h5>
		<h3 class="text-center">LOCATION</h3>
		<h5 class="pdl-40 pdr-40" style="padding-bottom:15px">{{ $card->location}}</h5>
	</div>
	<hr>
	<div class="auth-card four columns offset-by-eight">
		<h3 class="text-center">AUTHOR</h3>
		<a class="btn show" href="{{ route('Profile',['id'=> $card->user_id ])}}">View profile</a>
		<div class="text-center">
		{{-- @if($us->fb === "")

		@else
		<a href="http:\\{{ $us->fb }}">
			<i class="fa fa-facebook fa-2x"></i>
		</a>
		@endif
		@if($us->twitter === "")

		@else
			<a href="http:\\{{ $us->twitter }}">
				<i class="fa fa-twitter fa-2x"></i>
			</a>
		@endif
		@if($us->ig === "")
			
		@else
			<a href="http:\\{{ $us->ig }}">
				<i class="fa fa-instagram fa-2x"></i>
			</a>
		@endif --}}
		</div>
		{{-- <a class="btn show" href="{{ route('Profile',['id'=> $card->user_id ])}}">Contact</a> --}}
	</div>
	<div class="desc-card desc eight columns">
		<h5 class="pdl-50">CATEGORY</h5>
		<p class="pdl-50">{{ $card->category }}</p>
	</div>
	<div class="twelve columns">
		<div id="map-sh"></div>
		<h3 class="text-center map-footer">{{ $card->location}}</h3>
	</div>
</div>
</div>	
<script>
	$("#modal_trigger").leanModal({top : 200, overlay : 0.6, closeButton: ".modal_close" });
	$(function(){
		// Calling Register Form
		$("#login_form").click(function(){
			$(".social_login").hide();
			return false;
		});})
	var lat  = {{ $card->lat }};
	var lng  = {{ $card->lng }};
var map = new google.maps.Map(document.getElementById('map-sh'),{
	center:{
		lat: lat,
		lng: lng	},
	zoom: 14,
	scrollwheel: false});
var marker = new google.maps.Marker({
	position:{
		lat:lat,
		lng:lng	},
	map:map});
</script>
@section('pagescripts')
@stop
@stop