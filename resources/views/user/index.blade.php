@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>

            </div>
            <a href="{{URL('/user/create')}}" class="btn btn-primary">Add new user</a>
            <br>
            <table class="table table-bordered">
            @if(count($users) > 0)
            	<thead>
	            	<tr>
	            		<th>
	            			Name
	            		</th>
	            		<th>
	            			Email
	            		</th>
                        <th>
                            Role
                        </th>
                        
	            		<td>Actions</td>
	            	</tr>
            		
            	</thead>
            	<tbody>
            		@foreach($users as $user)
            		<tr>
            			<td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
            			<td>{{$user->role}}</td>
            			<td>
            				<a href="user/{{$user->id}}">Show</a>
            				<a href="user/{{$user->id}}/edit">Edit</a>
                            {!! Form::open([
                                'method' => 'DELETE',
                                'route' => ['user.destroy', $user->id]
                            ]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                            
            			</td>

            			
            		</tr>
            		@endforeach
            	</tbody>
            @else
            	<p>No user</p>
            @endif

            </table>
            

        </div>

    </div>
</div>
@endsection
