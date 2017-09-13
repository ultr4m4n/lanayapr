@extends('layouts.app')

@section('pagestyle')
<link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
@stop

@section('content')
<div class="profile-top col-md-8 col-md-offset-2">
<div class="text-center">
	<img class="profile-photo" style="margin-top:10px;width:200px;height:200px" src="{{asset('photos/'.$user->image)}}">
	<h2>{{ $user->name }}</h2>
</div>
	<div class="col-md-8 col-md-offset-2 text-center">
		{{-- <a class="btn" href="{{ route('Profile',['id'=> $user->id ])}}">Contact</a> --}}
		<p>{{ $user->bio }}</p>
	</div>
	<div style="position:absolute;bottom:10;width:100%" class="prof-social text-center">
	@if($user->fb === NULL)
	@else
	<a href="http:\\{{ $user->fb }}">
		<i class="fa fa-facebook fa-2x"></i>
	</a>
	@endif
	@if($user->twitter === NULL)
	@else
		<a href="http:\\{{ $user->twitter }}">
			<i class="fa fa-twitter fa-2x"></i>
		</a>
	@endif
	@if($user->ig === NULL)
	@else
		<a href="http:\\{{ $user->ig }}">
			<i class="fa fa-instagram fa-2x"></i>
		</a>
	@endif
	</div>
</div>
<div style="height: id='screenH'">
	<div style="height:100%" class="profile-footer profile">
		<div class="show-card-belt col-md-8 col-md-offset-2 ">
			<div id="tabs">
				<ul>
					<li><a href="#tabs-1"><h5>UPCOMING EVENTS</h5></a></li>
					<li><a href="#tabs-2"><h5>PAST EVENTS</h5></a></li>
				</ul>
				<div id="tabs-1">
					<div class="empty">
					@if($user->cards->count())
						@foreach ( $user->cards as $card)
						@if($card->date_start > Carbon\Carbon::now() && $card->live == 2)
							<a href="/cards/{{ $card->id }}">
							<div class=" col-md-4 profile">
								<div class="b-event-card" style="background-image:url({{asset('photos/'.$card->image)}});background-size:cover;background-repeat:no-repeat;">
									<div class="b-event-cont profile">
										<div class="b-event-title">
											<h4>{{ $card->title }}</h4>
											<p style="overflow:hidden;height:17px">{{ date('M jS, Y', strtotime($card->date_start)) }}, {{ $card->location }}</p>
										</div>
									</div>
								</div>
							</div>	
							</a>	@else
					@endif
						@endforeach
					@else
					<div class="text-center jumbotron"><p>No events</p></div>
					@endif
					</div>
				</div>
				<div id="tabs-2">
					<div class="empty">
						@if($user->cards->count())
						@foreach ( $user->cards as $card)
						@if($card->date_start < Carbon\Carbon::now() && $card->live == 2)
							<a href="/cards/{{ $card->id }}">
							<div class=" col-md-4 profile">
								<div class="b-event-card" style="background-image:url({{asset('photos/'.$card->image)}});background-size:cover;background-repeat:no-repeat;">
									<div class="b-event-cont profile">
										<div class="b-event-title">
											<h4>{{ $card->title }}</h4>
											<p style="overflow:hidden;height:17px">{{ date('M jS, Y', strtotime($card->date_start)) }}, {{ $card->location }}</p>
										</div>
									</div>
								</div>
							</div>
							</a>	@else
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
</div>

@stop
@section('pagescripts')
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('js/tabsNConfirm.js') }}"></script>
@stop