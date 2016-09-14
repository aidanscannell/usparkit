@extends('layouts.master')

@section('content')
<div class="container">
<h1>Resize Image Uploading Demo</h1>
@if (count($errors) > 0)
	<div class="alert alert-danger">
		<strong>Whoops!</strong> There were some problems with your input.<br><br>
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif

@include('includes.message-block')

<form action="/resizeImagePost" method="POST" enctype ="multipart/form-data">
	<div class="row">
		<div class="col-md-4">
			<br/>

			<input class="form-control" name="title" placeholder="Description" required/>
		</div>
		<div class="col-md-12">
			<br/>
			<input type="file" class="form-control" name="image" accept="image/*" required>
		</div>
		<div class="col-md-12">
			<br/>
			<button type="submit" class="btn btn-success">Upload Image</button>
		</div>
		{{ csrf_field() }}
	</div>
</form>
</div>
@endsection
