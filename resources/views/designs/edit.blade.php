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
					<form class="checkout-form" enctype="multipart/form-data" method="POST" action="{{ route('design.update', ['design'=> $design]) }}">
						<div class="cf-title">Edit Design</div>
						<div class="row address-inputs">
							<div class="col-md-12">
								@method('PATCH')
								 {{csrf_field()}}
								<!-- Title -->
								<input type="text" placeholder="Title" name="title" value="{{ $design->title}}" autofocus>
								@if($errors->first('title'))
								<span class="invalid-feedback  d-block" role="alert">{{$errors->first('title') }}</span>
								@endif

								<!-- Price -->
								<input type="text" placeholder="Price" name="price" value="{{ $design->price}}" autofocus>
								@if($errors->first('price'))
								<span class="invalid-feedback  d-block" role="alert">{{$errors->first('price') }}</span>
								@endif

								<!-- Description -->
								<textarea  name="description" placeholder="Description" class="form-control mb-2 mt-2" rows="4" cols="50" autofocus>{{ $design->description}}</textarea>
								@if($errors->first('description'))
								<span class="invalid-feedback  d-block " role="alert">{{$errors->first('description') }}</span>@endif	

								<!-- Tags -->
								<div>
									<select id="tags" name="tag_id" class="form-control mb-2 js-example-basic-single" autofocus>
									  <option value="" disabled >Tags</option>
									  @foreach ($tags as $tag) 
									  	<option value="{{ $tag ->id}}" {{ ($design->tag->id == $tag->id) ? 'selected' : '' }}>{{ $tag ->name}}</option>
									  @endforeach
									</select>
								</div>
								@if($errors->first('tag_id'))
								<span class="invalid-feedback  d-block " role="alert">{{$errors->first('tag_id') }}</span>
								@endif

								<!-- Material -->
								<div class="mt-2">
									<select id="Material" name="Material[]" class=" form-control js-example-placeholder-multiple" multiple="multiple" autofocus>
									  
									  @foreach ($designMaterial as $material) 
									  	@foreach($design->materials as $selectMaterial) 
									  		<option value="{{ $material ->id}}" 
									  		{{ ($selectMaterial->id == $material->id)? 'selected':''  }} >
									  			{{ $material ->name}}</option>
									  	@endforeach
									  	
									  @endforeach
									</select>
								</div>
								@if($errors->first('Material'))
								<span class="invalid-feedback  d-block" role="alert">{{$errors->first('Material') }}</span>
								@endif

								<!-- category -->
								<div style="margin: 10px 0;">
									<select id="cars" name="category" class="form-control js-example-basic-single" autofocus>
									  <option value="" disabled >Category</option>
									  <option value="men" {{ $design->category === "men" ? 'selected':'' }}>Men</option>
									  <option value="women" {{ $design->category ==="women" ? 'selected':'' }}>Women</option>
									  <option value="kids" {{ $design->category =="kids" ? 'selected' :'' }}>Kids</option>
									  <option value="teenagers" {{ $design->category =="teenagers" ? 'selected':'' }}>Teenagers</option>
									</select>
								</div>
								@if($errors->first('category'))
								<span class="invalid-feedback  d-block" role="alert">{{$errors->first('category') }}</span>
								@endif

								<!-- source file -->
								<div class="form-group">
								    <label for="link">Upload another source pattron file</label>
								    <input type="file" name="link" class="form-control" autofocus >
								</div>
								@if($errors->first('sourceFile'))
								<span class="invalid-feedback  d-block" role="alert">{{$errors->first('sourceFile') }}</span>
								@endif

								<!-- Images -->
								<div class="form-group">
										<label for="imgeFile">Add other Design Images  (can attach more than one) </label>
										<input type="file" id="imgeFile" name="images[]" class="form-control" multiple autofocus>
								</div>
								@if($errors->first('images'))
								<span class="invalid-feedback  d-block" role="alert">{{$errors->first('images') }}</span>
								@endif
								<!-- <div class="row">
									@foreach($designImages as $Image)
										<input id="image-upload"  style="display: none;" name="image" type="file" onchange="displayImage(this,{{ $Image->id }});">
										<input type="hidden" name="ImageId" value="{{ $Image->id }}">
										<a href=""><img src="{{asset ('storage/'. $Image->image) }}" id="{{ $Image->id }}" class="DesignImage" height="200" width="200" class="ml-2 col-5 mb-2"></a>
									@endforeach
								</div> -->

							</div>
							
						</div>
						<button class="site-btn submit-order-btn">Edit Design</button>
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
		 $('.DesignImage').on('click', function(event) {
		 	event.preventDefault();
		    $('#image-upload').click();
		});
		 function displayImage(input,ImageId)
		 {
		 	console.log(ImageId);
		 	var image= $('#'+ImageId);
		 	if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                image
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
		 }
	</script>
@endpush