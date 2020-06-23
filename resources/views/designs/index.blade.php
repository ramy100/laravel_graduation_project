@extends('layouts.app')

@section('content')

	<!-- Category section -->
	<section class="category-section spad">
		<div class="container">
			<div class="row">
<!-- start filter  -->
				<div class="col-lg-3 order-2 order-lg-1">
					<!-- Categories -->
					<div class="filter-widget">
						<h2 class="fw-title">Categories</h2>
						<ul class="category-menu" id = "selectable">
							<li class=" {{ $categoryFiltered && $categoryType == 'women' ? 'ui-selected':''}} "><a href="#">women</a></li>
							<li class=" {{ $categoryFiltered && $categoryType == 'men' ? 'ui-selected':''}} "><a href="#">men</a></li>
							<li class=" {{ $categoryFiltered && $categoryType == 'kids' ? 'ui-selected':''}} "><a href="#">kids</a></li>
							<li class=" {{ $categoryFiltered  && $categoryType == 'teenagers' ? 'ui-selected':''}} "><a href="#">teenagers</a></li>
						</ul>
						<!-- <select class="category-menu filter1 filter" >
							<option value="" selected disabled>Category</option>
							<option value="women" >Women wear</option>
							<option value="men" >Men Wear</option>
							<option value="kids" >Kids</option>
							<option value="teenagers" >Teenagers</option>
						</select> -->
					</div>
					<!-- tags -->
					<div class="filter-widget">
						<h2 class="fw-title">Tags</h2>
						<ul class="category-menu" id = "tags">
							@foreach ($tags as $tag)
							<li><a href="#">{{$tag->name}}</a></li>
							@endforeach
						</ul>
					</div>
					
					<!-- Materials -->
					<div class="filter-widget">
						<h2 class="fw-title">Materials</h2>
						<ul class="category-menu" id = "materials">
							@foreach ($materials as $material)
							<li><a href="#">{{$material->name}}</a></li>
							@endforeach
						</ul>
					</div>

					<!-- price -->
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
                                    <input type="text" id="minamount" >
                                    <input type="text" id="maxamount" >
                                </div>
                            </div>
                        </div>
					</div>
					
					
					
				</div>

				<div class="col-lg-9  order-1 order-lg-2 mb-5 mb-lg-0">
					<div class="row">
						<div class="col-lg-12 mb-2">
							<div class="dropdown show">
								 <!-- <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: black;color: white;float: right;">
								    Filter By
								  </a> -->
								 <select class="btn filter2 filter" role="menu" aria-labelledby="dropdownMenuLink">
								 	<option selected disabled> Sort</option>
								  	<option> <a class="dropdown-item " href="#" >Top Rated</a></option>
								  	<option> <a class="dropdown-item " href="#" >Latest</a></option>
								 </select>
							</div>
						</div>
<!-- filter end -->
					<!-- <div class="col-lg-12 mb-2 row designs">
						@forelse($desings as $design)
						<div class="col-lg-4 col-sm-6">
							<div class="product-item">
								<div class="pi-pic">
									@if($design->state != "sketch")
									<div class="tag-sale">Sold</div>
									@endif
									<a href="{{route('design.show', ['design' => $design->id])}}"><img src="{{asset ('storage/'.$design->images()->first()->image) }} " alt="Design Image" id="designImage"></a>
									<div class="pi-links">

										@if((Auth::user())&&(Auth::user()->role == "company") && ($design->state == "sketch") )
										<div class="pi-links">
											<a href="javascript:void(0)" data-id="{{ $design->id }}" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
										</div>
										@endif

										@if((Auth::user())&&(Auth::user()->role == "user") && ($design->state == "sketch") )
										<a href="{{route('design.show', ['design' => $design->id])}}" class="wishlist-btn"><i class="flaticon-heart"></i></a>
										@endif
									</div>
								</div>

								<div class="pi-text">
									@if((Auth::user())&&(Auth::user()->role != "user"))
									<h6>&dollar;{{$design->price}}</h6>
									@endif
									<a href="{{route('design.show', ['design' => $design->id])}}"><h5>{{$design->title}}</h5></a>
									<div class="designer-name">
									<i style="font-style: italic;">By</i> 
									<a href="{{route('designer.show', ['designer' => $design->designer->id])}}" class="designer">{{$design->designer->name}}</a>
									</div>

								</div>

							</div>
						</div>
						@empty
							<div class="alert alert-danger">No Designs Yet!</div>
						@endforelse
					</div> -->
					@include('designs.listDesigns')
				</div>
				
			</div>
		</div>
	</section>
	<!-- Category section end -->
@endsection
@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
	<script src="{{ asset('js/filter.js') }}"></script>

@endpush