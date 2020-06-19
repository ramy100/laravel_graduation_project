@extends('layouts.app')

@section('content')
	<!-- Page info -->
	<div class="page-top-info">
		<div class="container">
			<h4>Designers</h4>
		</div>
	</div>
	<!-- Page info end -->


	<!-- Category section -->
	<section class="category-section spad">
		<div class="container"style="display:flex-box;">
            <div class="row">
            		<div class="col-lg-9 row" style="margin: 0 auto;" >
                        @forelse($designers as $designer)
							<div class=" col-lg-3 product-item"style="margin:auto;">
								<div class="pi-pic">
                                    <a href="{{ route('designer.show',$designer->id) }}">
									<img src="{{ asset('storage/'.$designer->image)}}" alt=""class="img-thumbnail" style="width: 300px; height:200px">
                                    </a>
									<div class="pi-links">
									</div> 
								</div>
								<div class="pi-text" style="text-align:center;">
									<a href="{{ route('designer.show',$designer->id) }}">
										<h4>{{$designer->name}}<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a></h4>
										<h5 class="p-stock" style="color:pink";>Followers <span style="color:purple;">{{$designer->likes}}</span></h5>
									</a>
								</div>
							</div>
                             @empty 
								 <div style="height:200px;margin:auto;">No Designers Yet!</div> 
						 @endforelse                 
					</div>
						<div class="text-center w-100 pt-3">
							<button>{{ $designers->links() }}</button>
						</div>
			</div>
		</div>
	</section>
	<!-- Category section end -->
	@endsection
             
