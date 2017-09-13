@extends('layouts.app')

@section('content')
<div style="height: id='screenH'">
<div style="height:80%">
<div class="banner-top about col-md-12 banner-card-about">
	<div class="b-event-cont about" style="border-radius: 0px">
		<div class="b-event-title top-about">
			<h1 class="show-title text-center">About Us</h1>
		</div>
	</div>	
</div>
<div class="col-md-12 box about">
	<div class="col-md-8 col-md-offset-2 text-justify">
	<p>Lanaya is a start up event management system. We build the technology to allow anyone to create, find and attend events held by SIG Organization. Our objective? To provide information for every upcoming event.</p>
	</div>
</div>
<div class="twelve columns event-banner about">
	<h1 class="text-center">Start now</h1>
	<div  style="padding-left:.05em;padding-right:.05em" class="col-md-4">
		<a href="/">
		<div class="b-event-cont profile about">
			<div class="b-event-title about">
				<h2>Discover</h2>
			</div>
		</div>
			<img  class="img-cat" src="{{asset('images/web.jpg')}}">
		</a>			
	</div>
	<div style="padding-left:.05em;padding-right:.05em" class="col-md-4">
		<a href="/register">
		<div class="b-event-cont profile about">
			<div class="b-event-title about">
				<h2>Join</h2>
			</div>
		</div>
			<img  class="img-cat" src="{{asset('images/bg1.jpg')}}">
		</a>			
	</div>
	<div style="padding-left:.05em;padding-right:.05em" class="col-md-4">
		<a href="/register">
		<div class="b-event-cont profile about">
			<div class="b-event-title about">
				<h2>Follow</h2>
			</div>
		</div>
			<img  class="img-cat" src="{{asset('images/bg.jpg')}}">
		</a>			
	</div>
</div>
</div>
</div>

@stop