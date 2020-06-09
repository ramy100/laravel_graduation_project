@extends('layouts.app')

@section('content')
	
	
	@if (session('success'))
        <div class="alert alert-success" style="margin:0 auto;">
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
					<form class="checkout-form " enctype="multipart/form-data" method="POST" action="{{route('design.store')}}" >
						<div class="cf-title">Add New Design</div>
						<div class="row address-inputs">
							<div class="col-md-12">
								{{ csrf_field() }}

								<!-- title -->
								<input type="text" placeholder="Title" name="title" value="{{ old('title') ?? $design->title}}" class="form-control  {{ $errors->first('title') ? 'is-invalid':''}}" autofocus>
								@if($errors->first('title'))
								<span class="invalid-feedback  d-block" role="alert">{{$errors->first('title') }}</span>
								@endif

								<!-- price -->
								<input type="text" placeholder="Price" name="price" autofocus value="{{ old('price') ? old('price'):''}}" class="form-control {{ $errors->first('price') ? 'is-invalid':''}}">
								@if($errors->first('price'))
								<span class="invalid-feedback  d-block" role="alert">{{$errors->first('price') }}</span>
								@endif

								<!-- <input type="text" data-role="tagsinput" class="form-control" name="tags" placeholder="Tags" value="{{ old('tags') ?? $design->tags}}" > -->
								
								<!-- description -->
								<textarea  name="description" placeholder="Description" class="form-control mb-2 mt-2 {{ $errors->first('description') ? 'is-invalid':''}}" rows="4" cols="50" autofocus>{{ old('description') ?? $design->description}}</textarea>
								@if($errors->first('description'))
								<span class="invalid-feedback  d-block " role="alert">{{$errors->first('description') }}</span>@endif	

								<!-- tags -->
								<div  >
									<select id="tags" name="tag_id" class="form-control mb-2 js-example-basic-single {{ $errors->first('tag_id') ? 'is-invalid':''}}" autofocus>
									  <option value="" disabled selected>Tags</option>
									  @foreach ($tags as $tag) 
									  	<option value="{{ $tag ->id}}" {{  old('tag_id') && $tag->id ==old('tag_id') ? 'selected':'' }} >{{ $tag ->name}}</option>
									  @endforeach
									</select>
								</div>
								@if($errors->first('tag_id'))
								<span class="invalid-feedback  d-block " role="alert">{{$errors->first('tag_id') }}</span>
								@endif

								<!-- material -->
								<div class="mt-2">
									<select id="Material" name="Material[]" class=" form-control js-example-placeholder-multiple" multiple="multiple" autofocus>
									  
									  @foreach ($designMaterial as $material) 
									  	@if (old('Material'))
										  	@foreach( old('Material') as $oldMaterial )
										  	<option value="{{ $material ->id}}" {{ $oldMaterial == $material ->id ? 'selected':''}}>{{ $material ->name}}</option>
										  	@endforeach
									  	@else
									  		<option value="{{ $material ->id}}" >{{ $material ->name}}</option>
									  	@endif
									  @endforeach
									</select>
								</div>
								@if($errors->first('Material'))
								<span class="invalid-feedback  d-block" role="alert">{{$errors->first('Material') }}</span>
								@endif

								
								<!-- category -->
								<div style="margin: 10px 0;">
									<select id="cars" name="category" class="form-control js-example-basic-single" autofocus>
									  <option value="" disabled selected >Category</option>
									  <option value="men" {{ (old('category') &&  old('category')=="men") ? 'selected':'' }} >Men</option>
									  <option value="women" {{  (old('category') &&  old('category')=="women") ? 'selected':'' }} >Women</option>
									  <option value="kids" {{  (old('category') &&  old('category')=="kids") ? 'selected':'' }}>Kids</option>
									  <option value="teenagers" {{  (old('category') &&  old('category')=="teenagers") ? 'selected':'' }} >Teenagers</option>
									</select>
								</div>
								@if($errors->first('category'))
								<span class="invalid-feedback  d-block" role="alert">{{$errors->first('category') }}</span>
								@endif

								<!-- source file pattron -->
								<div class="form-group">
									<label for="Pattern">Source Design Pattron</label>
									<input type="file" name="sourceFile" id="Pattern" class="form-control"  autofocus {{ $errors->first('sourceFile') ? 'is-invalid':''}}>
								</div>
								@if($errors->first('sourceFile'))
								<span class="invalid-feedback  d-block" role="alert">{{$errors->first('sourceFile') }}</span>
								@endif

								<!-- images -->
								<div class="form-group">
									<label for="imgeFile">Design Images  (can attach more than one) </label>
									<input type="file" id="imgeFile" name="images[]" class="form-control" multiple autofocus {{ $errors->first('images') ? 'is-invalid':''}}>
								</div>
								@if($errors->first('images'))
								<span class="invalid-feedback  d-block" role="alert">{{$errors->first('images') }}</span>
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