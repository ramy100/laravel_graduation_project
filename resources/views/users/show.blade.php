@extends('layouts.app')

@section('content')
	<!-- Page info -->
	<div class="page-top-info">
		<div class="container">
			<h4>Your Profile</h4>
			@can('update', $user)
			<a name="" id="" class="btn btn-primary" href="{{ route('user.edit',$user) }}" role="button">Edit Profile</a>
			@endcan
		</div>
	</div>
	<!-- Page info end -->
	<section class="category-section spad">
		<div class="container text-center">
			<div class="row">
				<div class="col-lg-9  order-1 order-lg-2 mb-5 mb-lg-0">
					<div class="row">
						<div class="col-3">
							@if (is_null($user->provider))
								<img class="img-fluid" style="width: 100%; height:100%;" src="{{asset('storage/'.$user->image)}}" alt="">
							@else 
								<img class="img-fluid" style="width: 100%; height:100%;" src="{{$user->image}}" alt="">
							@endif
						</div>
						<div class="col-5">
							<p>Hi!</p>
							<h5 class="mb-5">
								{{$user->name}}
							</h5>
						</div>
						<div class="col-4 border">
							<h4 class="text-center m-5">
								Contact Information 
							</h4>
							
							<h5>
								Email
							</h5>
							<p>{{$user->email}}</p>
							<h5>
								Address
							</h5>
							<p>{{$user->address}}</p>
							<h5>
								Phone
							</h5>
							<p>{{$user->phone}}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- letest design section -->
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
				<!-- <div class="alert alert-danger">No Designs Yet!</div> -->
			@endforelse
		</div>
    </section>
	<!-- letest design section end -->
@endsection