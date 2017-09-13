@extends('layouts.app')

@section('content')
<div style="height: id='screenH'">
    <div class="col-md-8 col-md-offset-2">
        <div style="height:80%" class="panel panel-default">
        
            <div class="panel-body text-center">
               <h3> You are logged in! </h3>
            @if(Auth::user()->level>0)
               <a href="/create" class="btn">Create event</a>
               <a href="{{ route('MyCards',['id'=>Auth::user()->id])}}" class="btn">My events</a>
               <p>Host your event and view your attendees!</p>
            @else
                <a href="/" class="btn">Browse events</a>
                <p>Browse events and register as attendees to be notified!</p>
            @endif
            </div>

        </div>
    </div>
</div>
@endsection
