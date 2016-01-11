@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Showing User Details</div>

            </div>
            <table class="table table-bordered">
            	<thead>
	            	<tr>
	            		<th>
	            			Name
	            		</th>
	            		<td>
	            			{{$user->name}}
	            		</td>

	            		
	            	</tr>
                    <tr>
                        <th>
                            Email
                        </th>
                        <td>
                            {{$user->email}}
                        </td>

                        
                    </tr>

                    <tr>
                        <th>
                            Role
                        </th>
                        <td>
                            {{$user->role}}
                        </td>

                        
                    </tr>

                    

            		
            	</thead>
            	
            
            </table>
            

        </div>

    </div>
</div>
@endsection
