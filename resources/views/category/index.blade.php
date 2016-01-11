@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Categories</div>

            </div>
            <a href="{{URL('/category/create')}}" class="btn btn-primary">Add new category</a>
            <br>
            <table class="table table-bordered">
            @if(count($categories) > 0)
            	<thead>
	            	<tr>
	            		<th>
	            			Name
	            		</th>
	            		<th>
	            			Parent
	            		</th>
	            		<td>Actions</td>
	            	</tr>
            		
            	</thead>
            	<tbody>
            		@foreach($categories as $category)
            		<tr>
            			<td>{{$category->name}}</td>
            			<td>{{$category->parent_id}}</td>
            			<td>
            				<a href="category/{{$category->id}}">Show</a>
            				<a href="category/{{$category->id}}/edit">Edit</a>
                            {!! Form::open([
                                'method' => 'DELETE',
                                'route' => ['category.destroy', $category->id]
                            ]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                            
            			</td>

            			
            		</tr>
            		@endforeach
            	</tbody>
            @else
            	<p>No categories</p>
            @endif

            </table>
            

        </div>

    </div>
</div>
@endsection
