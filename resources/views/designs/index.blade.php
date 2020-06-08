@extends('layouts.app')

@section('content')
	<!-- Page info -->
	<div class="page-top-info">
		<div class="container">
			<h4>Designs PAge</h4>
		</div>
	</div>
	<!-- Page info end -->


	<!-- Category section -->
	<section class="category-section spad">
		<div class="container">
			<div class="row">
<!-- start filter  -->
				<div class="col-lg-3 order-2 order-lg-1">
					<div class="filter-widget">
						<h2 class="fw-title">Categories</h2>
						<!-- <ul class="category-menu" id = "selectable">
							<li><a href="#">Woman wear</a></li>
							<li><a href="#">Man Wear</a></li>
							<li><a href="#">Children</a></li>
							<li><a href="#">Teenagers</a></li>
						</ul> -->
						<select class="category-menu filter1 filter" >
							<option value="" selected disabled>Category</option>
							<option value="women" >Women wear</option>
							<option value="men" >Men Wear</option>
							<option value="kids" >Kids</option>
							<option value="teenagers" >Teenagers</option>
						</select>
					</div>
					<div class="filter-widget mb-0">
						<h2 class="fw-title">refine by</h2>
						<div class="price-range-wrap">
							<h4>Price</h4>
                            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" data-min="{{$minPrice}}" data-max="{{$maxPrice}}">
								<div class=" ssss ui-slider-range ui-corner-all ui-widget-header" style="left: 0%; width: 100%;"></div>
								<span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;">
								</span>
								<span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 100%;">
								</span>
							</div>
							<div class="range-slider">
                                <div class="price-input">
                                    <input type="text" id="minamount" class="filter">
                                    <input type="text" id="maxamount" class="filter">
                                </div>
                            </div>
                        </div>
					</div>
					
					
					
				</div>
<!-- filter end -->
				<div class="col-lg-9  order-1 order-lg-2 mb-5 mb-lg-0">
					<div class="row">
						<div class="col-lg-12 mb-2">
							<div class="dropdown show">
								 <!-- <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: black;color: white;float: right;">
								    Filter By
								  </a> -->
								 <select class="btn filter2 filter" role="menu" aria-labelledby="dropdownMenuLink" style="background-color: black;color: white;float: right;">
								 	<option selected disabled> Filter By</option>
								  	<option> <a class="dropdown-item " href="#" >Top Rated</a></option>
								  	<option> <a class="dropdown-item " href="#" >Latest</a></option>
								 </select>
							</div>
						</div>
					<div class="col-lg-12 mb-2 row designs">
						@forelse($desings as $design)
						<div class="col-lg-4 col-sm-6">
							<div class="product-item">
								<div class="pi-pic">
									<img src="{{asset ('storage/'.$design->images()->first()->image) }} " alt="Design Image" id="designImage">
									<div class="pi-links">
										<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
										<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
									</div>
								</div>

								<div class="pi-text">
									<h6>{{$design->price}} &dollar;</h6>
									<h5>{{$design->title}}</h5>
									<p>By {{$design->designer->name}}</p>
								</div>

							</div>
						</div>
						@empty
							<div class="alert alert-danger">No Designs Yet!</div>
						@endforelse
					</div>
				</div>
				<div class="row">
						{!! $desings->links() !!}
				</div>
			</div>
		</div>
	</section>
	<!-- Category section end -->
@endsection
@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
	<script src="{{ asset('js/filter.js') }}"></script>

@endpush