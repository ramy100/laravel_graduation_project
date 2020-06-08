@extends('layouts.app')

@section('content')
<body>
	<!-- Category section -->
	<section >
		<div class="container">
				<div class="col-lg-9  order-1 order-lg-2 mb-5 mb-lg-0">
					<div class="row">
						<div class="col-lg-4 col-sm-6">
                        @forelse($designers as $designer)
							<div class="product-item">
								<div class="pi-pic">
									<div class="tag-new">new</div>
                                    <a href="{{ route('designer.show',$designer->designer_id) }}">
									<img src="<?php echo asset("storage/$designer->image")?>" alt="">
                                    </a>
									<div class="pi-links">
										<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
										<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
									</div>
								</div>
								<div class="pi-text">
									<h4>{{$designer->name}}</h4>
									<p>Black and White Stripes Dress</p>
								</div>
							</div>
                            @empty
								<div style="height:200px;margin:auto;">No Designers Yet!</div>
                        @endforelse
						</div>
						<div class="text-center w-100 pt-3">
							<button class="site-btn sb-line sb-dark">LOAD MORE</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Category section end -->
	@endsection
	<!--====== Javascripts & Jquery ======-->
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/jquery.slicknav.min.js') }}"></script>
	<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('js/jquery.nicescroll.min.js') }}"></script>
	<script src="{{ asset('js/jquery.zoom.min.js') }}"></script>
	<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('js/main.js') }}"></script>

	</body>
</html>
