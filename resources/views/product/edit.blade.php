@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Product</div>

            </div>
            {!! Form::open([
                'method' => 'PATCH',
                'route' => ['product.update', $product->id]
            ]) !!}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Name</label>

                    <div class="col-md-6">
                        <input type="name" class="form-control" name="name" value="{{ $product->name }}">

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Description</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="description" value="{{ $product->description }}">

                        @if ($errors->has('description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('categories') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Categories</label>

                    <div class="col-md-6">
                        <select name="categories[]" multiple="multiple" id="categories" class="form-control">
                        	@foreach($categories as $cat)
                                <!-- <option value="{{$cat->id}}" selected="selected">{{$cat->name}}</option>
                                 -->
                                <option value="{{$cat->id}}">{{$cat->name}}</option>    
                        	@endforeach
                        </select>

                        @if ($errors->has('categories'))
                            <span class="help-block">
                                <strong>{{ $errors->first('categories') }}</strong>
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
