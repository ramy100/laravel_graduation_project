@extends('layouts.app')

@section('content')
	@if (session('success'))
        <div class="alert alert-success" style="margin:0 auto;">
            {{ session('success') }}
        </div>
    @endif
	<!-- product section -->
	<section class="product-section">
		<div class="container">
			<div class="back-link">
				<a href="{{ route('design.index') }}"> &lt;&lt; Back to Designs</a>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="product-pic-zoom">
						<img class="product-big-img" src="{{asset ('storage/'.$design->images->first()->image) }}" alt="">
					</div>
					<div class="product-thumbs" tabindex="1" style="overflow: hidden; outline: none;">
						<div class="product-thumbs-track">
							@forelse ($design->images as $Image)
							<div class="pt active" data-imgbigurl="{{asset ('storage/'. $Image->image) }}"><img src="{{asset ('storage/'. $Image->image) }}" alt=""></div>
							@empty
								<div>No Images for this product</div>
							@endforelse
						</div>
					</div>
				</div>
				<div class="col-lg-6 product-details">
					<h2 class="p-title ">{{$design->title}}</h2>
					<h3 class="p-price" style="display: inline;">&dollar;{{$design->price}} </h3><a href="#" class="wishlist-btn" style="font-size: 40px;margin-left: 10px;color: #f51167"><i class="flaticon-heart"></i></a>
					<h4 class="p-stock">Available: <span>In Stock</span></h4>
					<div class="pi-links">
						<p>Designer : {{ $design->designer->name}}</p> 
					</div>
					<div class="pi-links">
						<p>Total Votes : {{ $design->total_likes}}</p> 
					</div>
					<div class="p-review">
						<a href="">3 reviews</a>|<a href="">Add your review</a>
					</div>
					<div class="pi-links">
					
					</div>
					@if(Auth::id() == $design->designer_id)
					<form action="{{route('design.destroy',$design->id)}}" method="POST" style="display: inline;">
                            @method('DELETE')
                            @csrf
                        <button class="deleteDesign btn-danger" onclick="return confirm('Are you sure?')"  type="submit">Delete</button>
                    </form>
                    	<a class=" editDesign " href="{{route('design.edit',$design->id)}}"  >Edit</a>
                    @else
                    	<a href="#" class="site-btn mb-2">Buy NOW</a>		
                    @endif
					<div id="accordion" class="accordion-area">
						<div class="panel">
							<div class="panel-header" id="headingOne">
								<button class="panel-link active" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">information</button>
							</div>
							<div id="collapse1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="panel-body">
									<p>{{$design->description}}</p>
								</div>
							</div>
						</div>
						
						
					</div>
					
				</div>
			</div>
		</div>
	</section>
	<!-- product section end -->


	<!-- RELATED PRODUCTS section -->
	@if(count($RelatedDesigns) > 0)
		<section class="related-product-section">
			<div class="container">
				<div class="section-title">
					<h2>RELATED Designs</h2>
				</div>
				<div class="product-slider owl-carousel">
					@foreach($RelatedDesigns as $design)
					<div class="product-item">
						<div class="pi-pic">
							<a href="{{route('design.show', ['design' => $design->id])}}"><img id="designImage" src="{{asset ('storage/'.$design->images->first()->image) }}" alt=""></a>
						</div>
						<div class="pi-text">
							<h6>&dollar;{{ $design->price }}</h6>
							<p>{{ $design->title }} </p>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</section>
	@endif
	<!-- RELATED PRODUCTS section end -->

@endsection
