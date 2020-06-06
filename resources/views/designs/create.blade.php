@extends('layouts.app')

@section('content')
	
	
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

								<!-- title -->
								<input type="text" placeholder="Title" name="title" value="{{ old('title') ?? $design->title}}" >
								@if($errors->first('title'))
								<div class="alert alert-danger">{{$errors->first('title') }}</div>
								@endif

								<!-- price -->
								<input type="text" placeholder="Price" name="price" value="{{ old('price') ?? $design->price}}">
								@if($errors->first('price'))
								<div class="alert alert-danger">{{$errors->first('price') }}</div>
								@endif

								<!-- <input type="text" data-role="tagsinput" class="form-control" name="tags" placeholder="Tags" value="{{ old('tags') ?? $design->tags}}" > -->
								
								<!-- description -->
								<textarea  name="description" placeholder="Description" class="form-control mb-2 mt-2" rows="4" cols="50" value="{{ old('description') ?? $design->description}}"></textarea>
								@if($errors->first('description'))
								<div class="alert alert-danger">{{$errors->first('description') }}</div>@endif	

								<!-- tags -->
								<div>
									<select id="tags" name="tag_id" class="form-control mb-2 js-example-basic-single">
									  <option value="" disabled selected>Tags</option>
									  @foreach ($tags as $tag) 
									  	<option value="{{ $tag ->id}}" >{{ $tag ->name}}</option>
									  @endforeach
									</select>
								</div>
								@if($errors->first('tags'))
								<div class="alert alert-danger">{{$errors->first('tags') }}</div>
								@endif

								<!-- material -->
								<div class="mt-2">
									<select id="Material" name="Material[]" class=" form-control js-example-placeholder-multiple" multiple="multiple">
									  
									  @foreach ($designMaterial as $material) 
									  	<option value="{{ $material ->id}}" >{{ $material ->name}}</option>
									  @endforeach
									</select>
								</div>
								@if($errors->first('Material'))
								<div class="alert alert-danger">{{$errors->first('Material') }}</div>
								@endif

								<!-- category -->
								<div style="margin: 10px 0;">
									<select id="cars" name="category" class="form-control js-example-basic-single">
									  <option value="" disabled selected >Category</option>
									  <option value="men">Men</option>
									  <option value="women">Women</option>
									  <option value="kids">Kids</option>
									  <option value="teenagers">Teenagers</option>
									</select>
								</div>
								@if($errors->first('category'))
								<div class="alert alert-danger">{{$errors->first('category') }}</div>
								@endif

								<!-- source file pattron -->
								<div class="form-group">
									<label for="Pattern">Source Design Pattron</label>
									<input type="file" name="sourceFile" id="Pattern" class="form-control"  >
								</div>
								@if($errors->first('sourceFile'))
								<div class="alert alert-danger">{{$errors->first('sourceFile') }}</div>
								@endif

								<!-- images -->
								<div class="form-group">
									<label for="imgeFile">Design Images  (can attach more than one) </label>
									<input type="file" id="imgeFile" name="images[]" class="form-control" multiple >
								</div>
								@if($errors->first('images'))
								<div class="alert alert-danger">{{$errors->first('images') }}</div>
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

@push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
	<script type="text/javascript">
		 $('.js-example-basic-single').select2();
		 $(".js-example-placeholder-multiple").select2({
		    placeholder: "Material"
		});
	</script>
@endpush