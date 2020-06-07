@extends('layouts.app')

	@section('content')
	<!-- product section -->
	<section class="product-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-6" >
						<img class="product-big-img" style="width:300px;height:400px;"src="<?php echo asset("storage/$designer->image")?>" alt="">
                        </br>
                        <h3>{{ $designer->name }}</h3>
                        </br>
                        <div class="col-lg-3" >
                        <a style="display:block;" href="{{ route('user.edit',$designer) }}" class="btn btn-info">Edit Profile</a>
                        </div>
						</br>
						<div class="col-lg-3" >
						{!! Form::open(['route'=>['designer.destroy',$designer],'method'=>'delete']) !!} 
						{!! Form::submit('DELETE',['class'=>'btn btn-danger']) !!}
						{!! Form::close() !!} 
                        </div>
                </div>
                </br> 
				<div class="col-lg-6 product-details">
					<h2 class="p-title"> {{ $designer->name }}</h2>
					<h3 class="p-price">//followers count</h3>
					<h4 class="p-stock">Emial <span>{{$designer->email}}</span></h4>
                    <h4 class="p-stock">Phone <span>{{$designer->phone}}</span></h4>
					<h4 class="p-stock">Address <span>{{$designer->address}}</span></h4>
                    @if($user->role == "designer")
					<a href="#" class="btn site-btn"style="margin-top:15px;">ADD NEW DESIGN</a>
                    @endif
					<div id="accordion" class="accordion-area">
						<div class="panel">
							<div class="panel-header" id="headingOne">
								<button class="panel-link active" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">information</button>
							</div>
							<div id="collapse1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="panel-body">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so dales. Phasellus sagittis auctor gravida. Integer bibendum sodales arcu id te mpus. Ut consectetur lacus leo, non scelerisque nulla euismod nec.</p>
									<p class="p-price">designs count</p>
									<p>Mixed fibres</p>
									<p>The Model wears a UK size 8/ EU size 36/ US size 4 and her height is 5'8"</p>
								</div>
							</div>
						</div>
						<div class="panel">
							<div class="panel-header" id="headingTwo">
								<button class="panel-link" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">care details </button>
							</div>
							<div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
								<div class="panel-body">
									<img src="asset{{('img/cards.png')}}" alt="">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so dales. Phasellus sagittis auctor gravida. Integer bibendum sodales arcu id te mpus. Ut consectetur lacus leo, non scelerisque nulla euismod nec.</p>
								</div>
							</div>
						</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- product section end -->
	<!-- featured designs section -->
	<section class="related-product-section">
		<div class="container">
			<div class="section-title">
				<h2>FEATURED DESIGNS</h2>
			</div>
            @foreach($current_designs as $design)
            @if($design->featured == True)
			<div class="product-slider owl-carousel">
				<div class="product-item">
					<div class="pi-pic">
						<img src="<?php echo asset("storage/$design->source_file")?>" alt="">
						<div class="pi-links">
							<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
							<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
						</div>
					</div>
					<div class="pi-text">
						<h6>{{$design->price}}</h6>
						<p>{{$design->title}}</p>
					</div>
				</div>			
			@endif	
            @endforeach
			</div>
		</div>
	</section>
	<!-- featured designs section end -->
    	<!-- current designs section -->
	<section class="related-product-section">
		<div class="container">
			<div class="section-title">
				<h2>CURRENT DESIGNS</h2>
			</div>
			<div class="product-slider owl-carousel">
            @foreach($current_designs as $design)
				<div class="product-item">
					<div class="pi-pic">
						<img src="<?php echo asset("storage/$design->source_file")?>" alt="">
						<div class="pi-links">
							<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
							<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
						</div>
					</div>
					<div class="pi-text">
						<h6>{{$design->price}}</h6>
						<h5>{{$design->title}} </h5>
					</div>
				</div>
            @endforeach
			</div>
		</div>
	</section>
	<!-- current designs section end -->


	@endsection