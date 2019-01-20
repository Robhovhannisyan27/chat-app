@extends('layouts.app')

@section('content')
<div class="container col-sm-4">
	@if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    @if ( isset($errors) && count($errors) > 0)
    <div class="col-sm-12">
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
	<form enctype="multipart/form-data" method="post" action="/rooms">
		{{ csrf_field() }}
	  	<div class="form-group">
	    	<label for="name">Name</label>
	    	<input type="text" class="form-control" name='name' id="name" placeholder="Enter room name">
	  	</div>
	  	<div class="form-group">
        	<label for="image">Select image</label>
            <input name='image' type="file" id='image'class="form-control">
        </div>
        <div>
        	<label>Can join ?</label>
			<div class="form-check form-check-inline">
			  	<input class="form-check-input" type="radio" name="accessibility" id="all_users" value="1" checked>
			  	<label class="form-check-label" for="accessibility">
			    	All users
			  	</label>
			</div>
			<div class="form-check form-check-inline">
			  	<input class="form-check-input" type="radio" name="accessibility" id="logged_in" value="2">
			  	<label class="form-check-label" for="accessibility">
			    	Only logged in users
			  	</label>
			</div>
		</div>
	  	<button type="submit" class="btn btn-primary">Create</button>
	</form>
</div>
@endsection