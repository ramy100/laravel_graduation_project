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
					<form class="checkout-form " enctype="multipart/form-data" method="POST" action="{{route('user.store')}}" >
						<div class="row address-inputs">
							<div class="col-md-12">
								{{ csrf_field() }}																
								<!-- about -->
								<textarea  name="about" placeholder="about" class="form-control mb-2 mt-2 {{ $errors->first('about') ? 'is-invalid':''}}" rows="4" cols="50" autofocus>{{ old('about') ?? $profile->about}}</textarea>
								@if($errors->first('about'))
								<span class="invalid-feedback  d-block " role="alert">{{$errors->first('about') }}</span>@endif					

							</div>
							
						</div>
						<button class="site-btn submit-order-btn">Add a Piography</button>
					</form>
				</div>
			</div>
		</div>
	</section>
	
@endsection
