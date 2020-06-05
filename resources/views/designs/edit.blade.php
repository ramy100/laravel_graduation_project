@extends('layouts.app')

@section('content')
	
	<link href="{{ asset('css/tagsinput.css') }}" rel="stylesheet" type="text/css">
<!-- JavaScript -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"> </script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
	<script src="{{ asset('js/tagsinput.js') }}"></script>

	@if (session('success'))
        <div class="alert alert-success" style="width:600px;margin:0 auto;">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif  
	<section class="checkout-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 order-2 order-lg-1 design">
					<form class="checkout-form" enctype="multipart/form-data" method="POST" action="{{route('design.store')}}">
						<div class="cf-title">Add New Design</div>
						<div class="row address-inputs">
							<div class="col-md-12">
								{{ csrf_field() }}
								<input type="text" placeholder="Title" name="title" value="{{ $design->title}}" >
								@if($errors->first('title'))
								<div class="alert alert-danger">{{$errors->first('title') }}</div>
								@endif

								<input type="text" placeholder="Price" name="price" value="{{ $design->price}}">
								@if($errors->first('price'))
								<div class="alert alert-danger">{{$errors->first('price') }}</div>
								@endif

								<input type="text" data-role="tagsinput" class="form-control" name="tags" placeholder="Tags" value="{{ $design->tags}}">
								@if($errors->first('tags'))
								<div class="alert alert-danger">{{$errors->first('tags') }}</div>
								@endif

								<textarea  name="description" placeholder="Description" class="form-control mb-2 mt-2" rows="4" cols="50" value="{{ $design->description}}"></textarea>
								@if($errors->first('description'))
								<div class="alert alert-danger">{{$errors->first('description') }}</div>@endif	

								<div>
									<select id="Material" name="Material" class=" form-control">
									  <option value="" disabled selected>Material</option>
									  @foreach ($designMaterial as $material) 
									  	<option value="{{ $design->materials()->first()->id}}" >{{ $design->$materials()->first()->name}}</option>
									  @endforeach
									</select>
								</div>
								@if($errors->first('Material'))
								<div class="alert alert-danger">{{$errors->first('Material') }}</div>
								@endif

								<div style="margin: 10px 0;">
									<select id="cars" name="category" class=" form-control">
									  <option value="" disabled selected>Category</option>
									  <option value="men" {{ $design->category =="men" ?? selected }}>Men</option>
									  <option value="women" {{ $design->category =="women" ?? selected }}>Women</option>
									  <option value="kids" {{ $design->category =="kids" ?? selected }}>Kids</option>
									  <option value="teenagers" {{ $design->category =="teenagers" ?? selected }}>Teenagers</option>
									</select>
								</div>
								@if($errors->first('category'))
								<div class="alert alert-danger">{{$errors->first('category') }}</div>
								@endif

								

							</div>
							
						</div>
						<button class="site-btn submit-order-btn">Add Design</button>
					</form>
				</div>
			</div>
		</div>
	</section>
	
@endsection