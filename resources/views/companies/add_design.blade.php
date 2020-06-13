@extends('layouts.app')

@section('content')

	<section class="checkout-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 order-2 order-lg-1 design">
					<form class="checkout-form " enctype="multipart/form-data" method="POST" action="{{route('company_design.store')}}" >
					<div class="cf-title">Add New {{$company->name}} Design</div>
						<div class="row address-inputs">
							<div class="col-md-12">
								@csrf


								<div class="mt-2">
									<label for="title" class="text-info">Title</label>
									<input id="title" placeholder="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" >
									@error('title')
									<small class="text-danger">{{ $message }}</small>
									@enderror
								</div>
								
								<div class="mt-2">
									<label for="price" class="text-info">Price</label>
									<input id="price" placeholder="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" >
									@error('price')
									<small class="text-danger">{{ $message }}</small>
									@enderror
								</div>
								



								<div class="mt-2">
                                    <label for="design" class="text-info">Purchased Designs</label>
									<select id="design" name="design" class="js-example-basic-single form-control @error('design') is-invalid @enderror">
										{{-- <option disabled selected >Purchased Designs</option> --}}
										@forelse ($company->purchased_designs as $design) 
									  		<option value={{$design->id}} >{{ $design->title}}</option>
                                        @empty
									  		{{-- <option selected>No purchased designs yet</option> --}}
									  	@endforelse
									</select>
									@error('design')
										<small class="text-danger">{{ $message }}</small>
									@enderror
								</div>



								<div class="mt-2">
									
									<div class="form-group">
										<label for="link" class="text-info">Link</label>
										<input id="link" placeholder="link" type="text" class="form-control @error('link') is-invalid @enderror" name="link" value="{{ old('link') }}" >
										@error('link')
											<small class="text-danger">{{ $message }}</small>
										@enderror
									</div>
								</div>

								
								<div class="form-group">
									<label for="image">Design Image</label>
									<input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}"  autocomplete="image"> 
									@error('image')
										<small class="text-danger">{{ $message }}</small>
									@enderror
								</div>
								

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
