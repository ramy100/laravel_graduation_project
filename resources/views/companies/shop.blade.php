@extends('layouts.app')

@section('content')
	<!-- Page info -->
	<div class="page-top-info">
		<div class="container">
			<h4 class="text-danger">{{$company->name}}</h4>
			<h4>Shop</h4>
		</div>
	</div>
	<!-- Page info end -->


	<!-- Category section -->
	<section class="category-section spad">
		<div class="container">
			<div class="row">


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
                        @forelse($company->company_designs as $design)
						<div class="col-lg-4 col-sm-6">
							<div class="product-item">
								<div class="pi-pic">
								<img src="{{asset('storage/'.$design->image)}}" alt="" class="img-thumbnail" style="width: 300px; height:200px">
								</div>
								<div class="pi-text text-center">
									<h5 class="mb-1 text-primary">{{$design->title}}</h5>
									<p>{{$design->price}}$</p>
									<a href="//{{$design->link}}" class="btn btn-outline-success">Buy Now</a>
								</div>
							</div>
						</div>
						@empty
						<div class="alert alert-danger text-center col-12"><span>No Designs Yet!</span></div>
						@endforelse
						
				</div>
			</div>
		</div>
	</section>
	<!-- Category section end -->
@endsection