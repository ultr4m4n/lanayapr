@extends('layouts.app')

@section('pagestyle')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBrYX2ndcMZonN7HlUCuV6l-ck4dK5vbdg&sensor=false&libraries=places"></script>
<link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
<link href="{{ asset('css/jquery.timepicker.css') }}" rel="stylesheet">
<script type="text/javascript" src="{{ asset('js/jquery.timepicker.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/site.js')}}"></script>
@stop

@section('content')
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">
            <div class="panel-heading">Edit Event</div>

            <div class="panel-body form-card">
				<form method="POST" action="{{ route('EditCard',['id'=>$card->id])}}" enctype="multipart/form-data">
					{{ method_field('PATCH') }}
					{{ csrf_field() }}
					<div class="col-md-12">
						<div class="form-group col-md-6">
						<label>Title</label>
							<input class="form-control" type="text" name="title" value="{{ $card->title }}" required>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group col-md-6">
						<label>Location</label>
							<input id="maploc" class="form-control" type="text" name="location" value="{{ $card->location }}" required>
							<div id="map-sh"></div>
							<input class="form-control" type="hidden" value="{{ $card->lat }}" name="lat" id="lat">
							<input class="form-control" type="hidden" value="{{ $card->lng }}" name="lng" id="lng">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group col-md-6 {{ $errors->has('image') ? ' has-error' : '' }}">
    						<div class="form-group">
        					<label>Upload Image</label>
        						<div class="input-group">
            					<input type="text" class="form-control" value="{{ $card->image }}" readonly>
						            <span class="input-group-btn">
						                <span class="browse btn btn-default btn-file">
						                    Choose Image <input type="file" id="imgNp" name="image">
						                </span>
						                @if ($errors->has('image'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('image') }}</strong>
		                                    </span>
						                @endif
						            </span>
        						</div>
        						<img id='img-upload'/>
        						<p>We recommend using at least a 2160x1080px (2:1 ratio) image that's no larger than 10MB.</p>
    						</div>
						</div>
					</div>
					<div class="form-group col-md-12">
						<div class="col-md-2">
						<label>Date start</label>
							<input class="form-control" type="text" id="datepicker" value="{{ $card->date_start }}" name="date_start">
						</div>
						<div class="col-md-2">
						<label>Time start</label>
							<input class="form-control time" id="basicExample" value="{{ $card->sunrise }}" type="text" name="sunrise" placeholder="00 : 00 PM">
						</div>
					</div>
					<div class="form-group col-md-12">
						<div class="col-md-2">
						<label>Date end</label>
							<input class="form-control" type="text" id="datepicker1" value="{{ $card->date_end }}" name="date_end" >
						</div>
						<div class="col-md-2">
						<label>Time end</label>
							<input class="form-control" id="basicExample1" value="{{ $card->sunset }}" type="text" name="sunset" placeholder="00 : 00 PM">
						</div>
					</div>
					<div class="col-md-12">
						<div class="col-md-4">
						<label>Category</label>
							<select name="category" class="form-control">
							<option value="{{ $card->category}}">{{ $card->category }}</option>
							    <option value="Cyber security">Cyber security</option>
							    <option value="Software development">Software development</option>
							    <option value="Web development">Web development</option>
							    <option value="Talk or seminar">Talk or seminar</option>
							    <option value="Other">Other</option>
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<div class="col-md-10">
						<label>Description</label>
							<textarea class="form-control" name="description">{{ $card->description }}</textarea>
						</div>
						<div class="col-md-8 btn-form">
					            <button class="btn" name="live" value="2" type="submit">save changes</button>
					        @if(Auth::user()->level===2)
					        	@if($card->live==1)
					        	<button class="btn" name="live" value="0" type="submit">unblock</button>
					        	@else
					        	<button class="btn" name="live" value="1" type="submit">block</button>
					        	@endif
					       	@endif
					       	@if($card->live==0)
					            <button class="btn" name="live" value="2" type="submit">make live</button>
					        @elseif($card->live==2)
					            <button class="btn" name="live" value="0" type="submit">make unlive</button>
					        @else
					        	<p>Your card has been blocked</p>
					        @endif
				        </div>
					</div>
				</form>
			</div>
		</div>
	</div>
<script>
	var lat  = {{ $card->lat}};var lng  = {{ $card->lng}};
var map = new google.maps.Map(document.getElementById('map-sh'),{
	center:{		lat: lat,		lng: lng	},
	zoom:14,
	scrollwheel:false});
var marker = new google.maps.Marker({
	position:{		lat:lat,		lng:lng	},
	map:map});
var searchBox = new google.maps.places.SearchBox(document.getElementById('maploc'));
	google.maps.event.addListener(searchBox,'places_changed',function(){
		var places = searchBox.getPlaces();
		var bounds = new google.maps.LatLngBounds();
		var i, place;
		for(i=0; place=places[i];i++){
			bounds.extend(place.geometry.location);
			marker.setPosition(place.geometry.location); //set marker postion new
		}
		map.fitBounds(bounds);
		map.setZoom(14);
	});
	google.maps.event.addListener(marker, 'position_changed',function(){
		var lat = marker.getPosition().lat();
		var lng = marker.getPosition().lng();
		$('#lat').val(lat);$('#lng').val(lng);});
</script>	
@stop

@section('pagescripts')
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('js/form.js') }}"></script>
@stop