@extends('layouts.app')

@section('content')

<div class="banner-top col-md-12">
	<div class="banner-search">
		<form method="get">
				<div class="search-bar">
					<label  class="label-text text-center">
		      			<input type="search" name="mode" placeholder="Search" id="mode"/><button type="submit"><span class="glyphicon glyphicon-search"></span></button>
		    		</label>
				</div>
		</form>
	</div>
</div>
<div style="height: id='screenH'">
<div style="height:60%">
<div class="col-md-10 col-md-offset-1 event-content">
<?php if (isset($_GET['mode'])) { $mode = htmlspecialchars($_GET["mode"]);}?>
		@if(isset($mode))
		<h1 class="text-center">Search result for {{ $mode }} </h1>
		@else
		<h1 class="text-center">Browse Event</h1>
		@endif
	@if($cards->count())
		<div class="row">
			@foreach ($cards as $card)
				<div class="event-card col-md-4">
					<a href="/cards/{{ $card->id }}">
					<div class="b-event-card index three columns" style="background-image:url({{asset('photos/'.$card->image)}});width:100%;background-size: cover;background-repeat:no-repeat;">
					<div class="b-event-cont profile" style="border-radius:0px">
						<div class="b-event-title">
							<h3 style="color:white">{{ $card->title }}</h3>
						</div>
					</div>
					</div>
					<div class="panel-footer">
						<p><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>{{ date('D, M jS, Y', strtotime ($card->date_start)) }}</p>
						<p style="overflow:hidden;height:24px"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>{{ $card->location }}</p>
						<p># {{ $card->category }}</p>
					</div>
					</a>
				</div>
			@endforeach
		</div>
	@else
	<div class="empty col-md-12 text-center"><h1>Event unavailable</h1></div>
	@endif
</div>
	<div class="col-md-12 text-center">{{ $cards->links() }}</div>
</div>
<div class="event-banner twelve columns">
	<div class="ten columns offset-by-one columns event-cat">
	<h1 class="text-center">Browse by Categories</h1>
		<div class="three columns first-cat">
			<a href="/?mode=security">
			<div class="overlay">
				<div class="b-event-title">
					<i class="fa fa-linux fa-4x"></i>
					<h3 style="color:white">Security</h3>
				</div>
			</div>
				<img  class="img-cat" src="{{asset('images/hack.jpg')}}">
			</a>
		</div>
		<div class="three columns">
			<a href="/?mode=software">
			<div class="overlay">
				<div class="b-event-title">
					<i class="fa fa-desktop fa-4x"></i>
					<h3 style="color:white">Software</h3>
				</div>
			</div>
				<img  class="img-cat" src="{{asset('images/programming.jpg')}}">
			</a>						
		</div>
		<div class="three columns">
			<a href="/?mode=web">
			<div class="overlay">
				<div class="b-event-title">
					<i class="fa fa-globe fa-4x"></i>
					<h3 style="color:white">Web Dev</h3>
				</div>
			</div>
				<img  class="img-cat" src="{{asset('images/web.jpg')}}">
			</a>			
		</div>
		<div class="three columns">
			<a href="/?mode=talk">
			<div class="overlay">
				<div class="b-event-title">
                    <i class="fa fa-users fa-4x"></i>
					<h3 style="color:white">Talk</h3>
				</div>
			</div>
				<img  class="img-cat" src="{{asset('images/bg.jpg')}}">
			</a>			
		</div>
	</div>
</div>
</div>
@stop