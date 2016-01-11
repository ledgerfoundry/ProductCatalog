@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Category Details</div>

            </div>
            <table class="table table-bordered">
            	<thead>
	            	<tr>
	            		<th>
	            			Name
	            		</th>
	            		<td>
	            			{{$category->name}}
	            		</td>

	            		
	            	</tr>
                    <tr>
                        <th>
                            Parent
                        </th>
                        <td>
                            @if($category->parent->name==$category->name)
                                Root
                            @else
                                {{$category->parent->name}}
                            @endif
                        </td>

                        
                    </tr>


                    

            		
            	</thead>
            	
            
            </table>
            

        </div>

    </div>
</div>
@endsection
