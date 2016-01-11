@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Showing Product Details</div>

            </div>
            <table class="table table-bordered">
            	<thead>
	            	<tr>
	            		<th>
	            			Name
	            		</th>
	            		<td>
	            			{{$product->name}}
	            		</td>

	            		
	            	</tr>
                    <tr>
                        <th>
                            Description
                        </th>
                        <td>
                            {{$product->description}}
                        </td>

                        
                    </tr>
                    
                    <tr>
                        <th>
                            Categories
                        </th>
                        <td>
                            @foreach($product->categories as $category)
                            {{$category->name}},
                            @endforeach
                        </td>

                        
                    </tr>


            		
            	</thead>
            	
            
            </table>
            

        </div>

    </div>
</div>
@endsection
