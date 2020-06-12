@extends('layouts.app')

@section('content')
	<!-- product section -->
	<section class="product-section">
		<div class="container">
			<div class="back-link">
				<a href="{{ route('website.index') }}"> &lt;&lt; Back to Home</a>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="product-pic-zoom">
						@if (is_null($user->provider))
							<img class="product-big-img" src="{{asset ('storage/'.$user->image)}}" alt="">
						@else 
							<img class="product-big-img" src="{{asset ($user->image)}}" alt="">
						@endif
					</div>
				</div>
				<div class="col-lg-6 product-details">
					<h2 class="p-title ">{{$user->name}}</h2>
					<a name="" id="" class="btn btn-primary" href="{{ route('user.edit',$user) }}" role="button">Edit Profile</a>

					<div id="accordion" class="accordion-area">
						<div class="panel">
							<div class="panel-header" id="headingOne">
								<button class="panel-link active" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">Email</button>
							</div>
							<div id="collapse1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="panel-body">
									<p>{{$user->email}}</p>
								</div>
							</div>
						</div>					
						<div class="panel">
							<div class="panel-header" id="headingOne">
								<button class="panel-link active" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">Address</button>
							</div>
							<div id="collapse1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="panel-body">
									<p>{{$user->address}}</p>
								</div>
							</div>
						</div>					
						<div class="panel">
							<div class="panel-header" id="headingOne">
								<button class="panel-link active" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">Phone</button>
							</div>
							<div id="collapse1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="panel-body">
									<p>{{$user->phone}}</p>
								</div>
							</div>
						</div>					
					</div>
				</div>
			</div>
			<!-- liked design section -->
			<section class="top-letest-product-section">
				<div class="container">
					<div class="section-title">
						<h2>Your liked Designs</h2>
					</div>
					<div class="product-slider owl-carousel">
					@forelse($user->my_votes as $vote)
						<div class="product-item">
							<div class="pi-pic">
								<a href="{{route('design.show', ['design' => $vote->design->id])}}"> 
									<img src="{{ asset('storage/'.$vote->design->images()->first()->image) }}" alt="">
								</a>
								<div class="pi-links">
									<a href="javascript:void(0)" class="wishlist-btn"><i class="flaticon-heart"></i></a>
								</div>
							</div>
							<div class="pi-text">
								<h6>${{$vote->design->price}}</h6>
								<p>{{ $vote->design->description}}</p>
							</div>
						</div>
					@empty
						<div class="alert alert-danger">No Designs Yet!</div>
					@endforelse
				</div>
			</section>
			<!-- liked design section end -->
		</div>
	</section>
	<!-- product section end -->
	
@endsection