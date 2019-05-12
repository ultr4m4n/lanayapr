@extends('layouts.app')

@section('content')
<div style="height: id='screenH'">
    <div class="col-md-8 col-md-offset-2">
        <div style="height:80%" class="panel panel-default">
        
            <div class="panel-body text-center">
               <h3 style="padding-bottom:30px;"> You are logged in! </h3>
            @if(Auth::user()->level>0)
               <a href="/create" class="btn">Create event</a>
            @else
                <a href="/" class="btn">View events</a>
            @endif
            </div>

            <div class="text-center" style="padding-bottom: 50px">
                <span class="glyphicon glyphicon-pencil"></span>
                <h3 style="color:brown;">Simplify your planning</h3>
                <p>Create a 100% mobile-optimized event page and start spreading event in minutes.</p>
            </div>

            <div class="text-center">
                <span class="glyphicon glyphicon-tree-deciduous"></span>
                <h3 style="color:green;">Grow your event</h3>
                <p>Grow faster with Lanaya's social sharing tools.</p>
            </div>          

        </div>
    </div>
</div>
@endsection
