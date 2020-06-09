@extends('layouts.app')

@section('content')
	<!-- Page info -->
	<div class="page-top-info">
		<div class="container">
			<h4>Company Profile</h4>
			@can('update', $company)
			<a name="" id="" class="btn btn-primary" href="{{ route('user.edit',$company) }}" role="button">Edit Profile</a>
			@endcan
		</div>
	</div>
	<!-- Page info end -->
	<section class="category-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-9  order-1 order-lg-2 mb-5 mb-lg-0">
					<div class="row">
						<div class="col-3">
							<img class="img-fluid" style="width: 100%; height:100%;" src="{{asset('storage/'.$company->image)}}" alt="">
						</div>
						<div class="col-5">
							<h3 class="mb-5">
								{{$company->name}}
							</h3>
							
							@if($company->profile)
								<h5 class="text-dark"> About :</h5>
								<p>
									 {{$company->profile->about}}
								</p>
							@endif
						</div>
						<div class="col-4 border">
							<h4 class="text-center mb-5">
								Contact Information 
							</h4>
							
							@if($company->profile)
							<h5>Website </h5>
							<p>{{$company->profile->website}}</p>
							@endif
							<h5>
								Email
							</h5>
							<p>{{$company->email}}</p>
							<h5>
								Address
							</h5>
							<p>{{$company->address}}</p>
							<h5>
								Phone
							</h5>
							<p>{{$company->phone}}</p>
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
                <h2>Our Designs</h2>
            </div>
            <div class="product-slider owl-carousel">
			@forelse($company->company_designs as $comany_design)
				<div class="product-item">
					<div class="pi-pic">
						<img src="{{ asset('images/product/1.jpg') }}" alt="">
						<div class="pi-links">
						<a href="javascript:void(0)" data-id="{{ $comany_design->id }}" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
							<a href="javascript:void(0)" class="wishlist-btn"><i class="flaticon-heart"></i></a>
						</div>
					</div>
					<div class="pi-text">
						<h6>${{$comany_design->design->price}}</h6>
						<p>{{ $comany_design->design->description}}</p>
					</div>
				</div>
			@empty
				<!-- <div class="alert alert-danger">No Designs Yet!</div> -->
			@endforelse
		</div>
    </section>
	<!-- letest design section end -->
@endsection