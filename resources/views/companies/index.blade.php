@extends('layouts.app')

@section('content')
	<!-- Page info -->
	<div class="page-top-info">
		<div class="container">
			<h4>Our Companies</h4>
		</div>
	</div>
	<!-- Page info end -->


	<!-- Category section -->
	<section class="category-section spad">
		<div class="container">
			<div class="row">
				<!-- <div class="col-lg-3 order-2 order-lg-1">
					<div class="filter-widget">
						<h2 class="fw-title">Categories</h2>
						<ul class="category-menu">
							<li><a href="#">Woman wear</a></li>
							<li><a href="#">Man Wear</a></li>
							<li><a href="#">Children</a></li>
							<li><a href="#">Teenagers</a></li>
						</ul>
					</div>
					<div class="filter-widget mb-0">
						<h2 class="fw-title">refine by</h2>
						<div class="price-range-wrap">
							<h4>Price</h4>
                            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" data-min="1" data-max="1">
								<div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 0%; width: 100%;"></div>
								<span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;">
								</span>
								<span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 100%;">
								</span>
							</div>
							<div class="range-slider">
                                <div class="price-input">
                                    <input type="text" id="minamount">
                                    <input type="text" id="maxamount">
                                </div>
                            </div>
                        </div>
					</div>
					
					
					<div class="filter-widget">
						<h2 class="fw-title">Companies</h2>
						<ul class="category-menu">
							@forelse ($companies as $company)
							<li><a href="#">{{$company->name}} <span>(2)</span></a></li>
							@empty
								<div>No Companies Yet!</div>
							@endforelse
						</ul>
					</div>
				</div> -->

				<div class="col-lg-12  order-1 order-lg-2 mb-5 mb-lg-0">
					<div class="row">
						<div class="col-lg-12 mb-2">
							<div class="dropdown show">
								 {{-- <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: black;color: white;float: right;">
								    Filter By
								  </a> --}}
								 <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
								   <a class="dropdown-item" href="#">Rate</a>
								   <a class="dropdown-item" href="#">Latest</a>
								 </div>
							</div>
						</div>
						@forelse($companies as $company)
						<div class="col-lg-3 col-sm-6">
							<div class="product-item">
								<div class="pi-pic">
                                    <img src="{{asset('storage/'.$company->image)}}" alt="" class="img-thumbnail" style="width: 300px; height:200px">
									<!-- <div class="pi-links">
										<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
										<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
									</div> -->
								</div>

								<div class="pi-text">
									<a href="{{route('company.show',$company->id)}}">{{$company->name}}</a>
								</div>
							</div>
						</div>
						@empty
							<div class="alert alert-danger">No Companies Yet!</div>
						@endforelse
						
				</div>
			</div>
		</div>
	</section>
	<!-- Category section end -->
@endsection