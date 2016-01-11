@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Products</div>

            </div>
            @if(Auth::user()->role == 'Admin')
            <a href="{{URL('/product/create')}}" class="btn btn-primary">Add a product</a>
            @endif
            <table id="products" class="table table-bordered">
            @if(count($products) > 0)
            	<thead>
	            	<tr>
	            		<th>
	            			Name
	            		</th>
	            		<th>
	            			Description
	            		</th>
                        <th>
                            Categories
                        </th>
                        @if(Auth::user()->role == 'Admin')
	            		<td>Actions</td>
                        @endif
	            	</tr>
            		
            	</thead>
            	<tbody>
            		@foreach($products as $product)
            		<tr>
            			<td>{{$product->name}}</td>
            			<td>{{$product->description}}</td>
                        <td>
                            @foreach($product->categories as $category)
                            {{$category->name}},
                            @endforeach
                        </td>
                        @if(Auth::user()->role == 'Admin')
            
            			<td>
            				<a href="product/{{$product->id}}">Show</a>
            				<a href="product/{{$product->id}}/edit">Edit</a>
                            {!! Form::open([
                                'method' => 'DELETE',
                                'route' => ['product.destroy', $product->id]
                            ]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                            
            			</td>
                        @endif
            			
            		</tr>
            		@endforeach
            	</tbody>
            @else
            	<p>No products</p>
            @endif

            </table>
            

        </div>

    </div>
</div>
@endsection
