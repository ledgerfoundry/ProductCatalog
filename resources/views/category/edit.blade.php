@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Category</div>

            </div>
            {!! Form::open([
                'method' => 'PATCH',
                'route' => ['category.update', $category->id]
            ]) !!}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Name</label>

                    <div class="col-md-6">
                        <input type="name" class="form-control" name="name" value="{{ $category->name }}">

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('parent_id') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Parent Category</label>

                    <div class="col-md-6">
                        <select name="parent_id" id="parent_id" class="form-control">
                        	<option value="0">Root</option>
                        	@foreach($categories as $cat)
                                @if($cat->id != $category->id)
                                    @if($cat->id == $category->parent_id)
                                        <option value="{{$cat->id}}" selected="selected">{{$cat->name}}</option>
                                    @else
                                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                                    @endif
                                @endif
                        	@endforeach
                        </select>

                        @if ($errors->has('parent_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('parent_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Edit
                        </button>

                    </div>
                </div>
            {!! Form::close() !!}

        </div>

    </div>
</div>
@endsection
