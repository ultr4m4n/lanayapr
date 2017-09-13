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
            <div class="panel-heading">Create Event</div>

            <div class="panel-body form-card">
				<form method="POST" action="/create" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="col-md-12">
						<div class="form-group col-md-6">
					<label><p>Title</p></label>
						<input  maxlength="25" class="form-control" type="text" name="title" placeholder="title" required>
					</div>
					</div>
					<div class="col-md-12">
					<div class="form-group col-md-6">
					<label><p>Location</p></label>
						<input id="maploc" class="form-control" type="text" name="location" required>
						<div id="map-canvas"></div>
						<input type="hidden" name="lat" id="lat">
						<input type="hidden" name="lng" id="lng">
					</div>
					</div>
						<input type="hidden" name="user_id" value="{{Auth::id()}}">
					<div class="col-md-12">
						<div class="form-group col-md-6 {{ $errors->has('image') ? ' has-error' : '' }}">
    						<div class="form-group">
        					<label><p>Upload Image</p></label>
        						<div class="input-group">
            					<input type="text" class="form-control" readonly>
						            <span class="input-group-btn">
						                <span class="browse btn btn-default btn-file">
						                    Choose Image <input type="file" id="imgNp" name="image" required="">
						                </span>
						                @if ($errors->has('image'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('image') }}</strong>
		                                    </span>
						                @endif
						            </span>
        						</div>
        			<img id='img-upload'/>
        			<p>We recommend using at least a 2160x1080px (2:1 ratio) image that's no larger than 5MB.</p>
    				</div>
						</div>
					</div>
					<div class="form-group col-md-12">
						<div class="col-md-2">
						<label><p>Date start</p></label>
							<input class="form-control date" type="text" id="datepicker" name="date_start" placeholder="{{ date("d/m/Y") }}" required>
						</div>
						<div class="col-md-2">
						<label><p>Time start</p></label>
							<input class="form-control" id="basicExample" type="text" name="sunrise" placeholder="00 : 00 PM" required>
						</div>
					</div>
					<div class="form-group col-md-12 date">
						<div class="col-md-2">
						<label><p>Date end</p></label>
							<input class="form-control" type="text" id="datepicker1" name="date_end" placeholder="{{ date("d/m/Y") }}" required>
						</div>
						<div class="col-md-2">
						<label><p>Time end</p></label>
							<input class="form-control" id="basicExample1" type="text" name="sunset" placeholder="00 : 00 PM" required>
						</div>
					</div>
					<div class="col-md-12">
						<div class="col-md-4">
						<label><p>Category</p></label>
							<select name="category" class="form-control">
							    <option value="Others">Other</option>
							    <option value="Cyber security">Cyber security</option>
							    <option value="Software development">Software development</option>
							    <option value="Web development">Web development</option>
							    <option value="Talk or seminar">Talk or seminar</option>
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<div class="col-md-10">
						<label><p>Description</p></label>
							<textarea maxlength="300" class="form-control" name="description"></textarea>
						</div>
						<div class="col-md-8 btn-form">
							<button class="btn" type="submit">save changes</button>
			            <button class="btn" name="live" value="2" type="submit">make live</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@stop

@section('pagescripts')
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('js/map.js') }}"></script>
	<script src="{{ asset('js/form.js') }}"></script>
@stop