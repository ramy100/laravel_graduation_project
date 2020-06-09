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
					<h3 class="p-price" style="display: inline;">&dollar;{{$design->price}} </h3>
					<input type="hidden" name="designId" value="{{ $design->id }}" id="designId">

					<!-- vote -->
					@if((Auth::user()->role == "user") && ($design->state == "sketch") )
					<a href="#" class="wishlist-btn " style="font-size: 40px;margin-left: 10px;"><i class="fa fa-heart {{($voted == 'True') ? 'show':'hide' }}"></i>
					</a>
					@endif

					@if($design->state == "sketch")
					<h4 class="p-stock">Available: <span>{{$design->state}}</span></h4>
					@else
						<h4 class="p-stock"><span>Not Available</span></h4>
					@endif

					<div class="pi-links">
						<p>Designer : {{ $design->designer->name}}</p> 
					</div>
					<div class="pi-links">
						<p class="votes">Total Votes : {{ $design->total_likes}}</p> 
					</div>
					<!-- <div class="p-review">
						<a href="">3 reviews</a>|<a href="">Add your review</a>
					</div> -->

					<!-- delete design -->
					@if(Auth::id() == $design->designer_id)
					<form action="{{route('design.destroy',$design->id)}}" method="POST" style="display: inline;">
                            @method('DELETE')
                            @csrf
                        <button class="deleteDesign btn-danger" onclick="return confirm('Are you sure?')"  type="submit">Delete</button>
                    </form>
                    	<a class=" editDesign " href="{{route('design.edit',$design->id)}}"  >Edit</a>
                    @elseif((Auth::user()->role == "company") && ($design->state == "sketch") )

                    <!-- buy design -->
                    	<a href="javascript:void(0)" data-id="{{ $design->id }}" class="add-card site-btn mb-2"  >ADD TO CART</a>		
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
						<div class="panel">
							<div class="panel-header" id="headingTwo">
								<button class="panel-link" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">Reviews </button>
							</div>
							<div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
								<div class="panel-body">

									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so dales. Phasellus sagittis auctor gravida. Integer bibendum sodales arcu id te mpus. Ut consectetur lacus leo, non scelerisque nulla euismod nec.</p>
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
@push('scripts')
	<script type="text/javascript">
		$('.wishlist-btn').click(function(e) {
			e.preventDefault();
			let design_id = $('#designId').val();
			let IconClasses=e.target.className;
			let heartClass=	IconClasses.split(" ");
			let vote="";
			if (heartClass.includes("hide"))
			{
				vote="add";
			}
			else if (heartClass.includes("show")) {
				vote="remove";
			}
			 console.log(vote);
			 console.log(heartClass);
			  $.ajaxSetup({
			        headers: {
			          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        }
			      });
				$.ajax({
		        type: 'POST',
		        url: 'http://localhost:8000/design/vote',
		        data: {
		            'design_id':design_id,
		            'vote':vote
		        },
		        success: function (data) {
		        	console.log(data);
		        	$( ".fa-heart" ).toggleClass( "show" );
		        	$( ".fa-heart" ).toggleClass( "hide" );
		        	$(".votes").html(`Total Votes : ${data}`);

		        },
		        error: function (XMLHttpRequest) {
		        }
		    });
		});
	</script>
@endpush