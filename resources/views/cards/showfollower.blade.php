@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Cards Followers</div>
                <div style="height: id='screenH'" >
                    <div style="height:80%" class="panel-body show-follower table-responsive">
                    <table>
                        <tr>
                            <th><h4>No.</h4></th>
                            <th><h4>Profile</h4></th>
                            <th><h4>Name</h4></th>
                            <th><h4>Email</h4></th>
                            <th><h4>Phone number</h4></th>
                        </tr>
                        <?php $i=1 ?>
                        @foreach( $users as $user)
                        <tr>
                          <td>{{$i++}}</td>
                          <td><a href="{{ route('Profile',['id'=> $user->user_id ])}}">View profile</a></td>
                          <td>{{ $user->name }}</td>
                          <td>{{ $user->email }}</td>
                          <td>{{ $user->phoneno }}</td>
                        </tr>
                        @endforeach
                        @foreach( $nonusers as $nonuser )
                        <tr>
                          <td>{{ $i++ }}</td>
                          <td>Unregistered</td>
                          <td>{{ $nonuser->name }}</td>
                          <td>{{ $nonuser->email }}</td>
                          <td>{{ $nonuser->phoneno }}</td>
                        </tr>
                        @endforeach
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop