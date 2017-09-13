@extends('layouts.app')

@section('content')
@if(Session::has('success_change'))
		<div class="col-md-12 alert success text-center">
			{{Session::get('success_change')}}
		</div>
	@endif
<div style="height: id='screenH'">
<div style="height:80%">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">
            <div class="panel-heading">Create Event</div>

            <div class="panel-body form-card">
				<form method="POST" action="/MyProfile/{{$user->id}}" enctype="multipart/form-data">
						{{ method_field('PATCH') }}
						{{ csrf_field() }}
						<div class="col-md-4">
						<label><p>Change Image</p></label>
							<img id='img-upload' class="pull-left profile-photo" style="width:200px;height:200px" src="{{asset('photos/'.$user->image)}}">
								<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
    						<div class="form-group">
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
	        			<p class="text-center">We recommend using at least a 400x400px (1:1 ratio) image that's no larger than 5MB.</p>
		    				</div>
								</div>
						</div>
					<div class="col-md-6 col-md-offset-1">
							<div class="form-group">
						<label><p>Name</p></label>
							<input class="form-control" type="text" name="name" value="{{ $user->name }}" required>
						</div>
						<div class="form-group">
						<label><p>About The User</p></label>
							<textarea class="form-control" name="bio">{{ $user->bio }}</textarea>
						</div>
						<label style="border-bottom:solid 2px rgba(223,190,106,0.8);width:12%"><p>Optional</p></label>
						<div class="form-group">
						<label><p>Facebook page</p></label>
							<input class="form-control" type="text" name="fb" value="{{ $user->fb }}">
						example: www.facebook.com/example
						</div>
						<div class="form-group">
						<label><p>Twitter page</p></label>
							<input class="form-control" type="text" name="twitter" value="{{ $user->twitter }}">
						example: www.twitter.com/example
						</div>
						<label><p>Instagram page</p></label>
						<div class="form-group">
							<input class="form-control" type="text" name="ig" value="{{ $user->ig }}">
						example: www.instagram.com/example
						</div>
						<div class="form-group">
							<input class="form-control" type="text" name="phoneno" value="{{ $user->phoneno }}">
						example: 012-3456789
						</div>
							<div class="form-group">
				            <button class="btn pull-right" type="submit">save changes</button>
				        </div>
					</div>
						{{-- optional colorpicker--}}
						{{-- <div class="form-group">
							<input class="form-control" type="color" name="title" value="{{ $user->bg_color }}" required>
						</div>
						<div class="form-group">
							<input class="form-control" type="color" name="title" value="{{ $user->text_color }}" required>
						</div> --}}
						
				        {{-- <div class="form-group">
				            <button class="btn" type="submit">Preview</button>
				        </div> --}}
		        </form>
			</div>
	</div>
</div>
</div>
</div>
@stop

@section('pagescripts')
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
	<script src="{{ asset('js/form.js') }}"></script>
@stop