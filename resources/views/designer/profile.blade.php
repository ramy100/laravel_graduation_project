@extends('layouts.app')

	@section('content')
	<!-- product section -->
	<section class="product-section">
	@forelse($designer as $designer_data)
		<div class="container">
			<div class="row">
				<div class="col-lg-6" >
						<img class="product-big-img" style="width:300px;height:400px;"src="<?php echo asset("storage/$designer_data->image")?>" alt="">
                        </br>
                        <h3>{{ $designer_data->name }}<i class="flaticon-heart text-dark" value="{{$designer_data->id}}"></i></h3>
						<!-- <i class="fas fa-heart fa-2x"></i> -->
                        </br>
						@if($user->role == "designer")
                        <div class="col-lg-3" >
                        <a  href="{{ route('user.edit',$designer_data) }}" class="editDesign">Edit Profile</a>
                        </div> 
						@endif
						</br>
						@if($user->role == "designer")
						<div class="col-lg-3" >
                        <a  href="{{ route('user.create',$designer_data) }}" class="editDesign">Add a Piography</a>
                        </div> 
						@endif
						</br>
                        
						</br>
						@if($user->role == "designer")
						<div class="col-lg-3" >
						{!! Form::open(['route'=>['designer.destroy',$designer_data],'method'=>'delete']) !!} 
						{!! Form::submit('DELETE',['class'=>'deleteDesign btn-danger']) !!}
						{!! Form::close() !!} 
                        </div>
						@endif
                </div>
                </br> 
				<div class="col-lg-6 product-details">
					<h2 class="p-title"> {{ $designer_data->name }}</h2></br>
					<h4 class="p-stock">followers  <span >{{$likes}}</span></h4>
					<h4 class="p-stock">Emial <span>{{$designer_data->email}}</span></h4>
                    <h4 class="p-stock">Phone <span>{{$designer_data->phone}}</span></h4>
					<h4 class="p-stock">Address <span>{{$designer_data->address}}</span></h4>
                    @if($user->role == "designer")
					<a href="{{ route('design.create',$designer_data) }}" class="btn site-btn"style="margin-top:15px;">ADD NEW DESIGN</a>
                    @endif
					<div id="accordion" class="accordion-area">
						<div class="panel">
							<div class="panel-header" id="headingOne">
								<button class="panel-link active" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">information</button>
							</div>
							<div id="collapse1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="panel-body">
									<p>{{$about[0]->about}}</p>
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
			<div class="product-slider owl-carousel">   
			    @foreach($featured_images as $fimage)
				<div class="product-item">
					<div>
					<a href="{{route('design.show', ['design' => $fimage->design_id])}}"><img src="{{asset ('storage/'.$fimage->image) }}" alt=""></a>
					</div>
				</div>			
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
            @foreach($current_images as $cimage)
				<div class="product-item">
					<div class="pi-pic">
						<a href="{{route('design.show', ['design' => $cimage->design_id])}}"><img src="{{asset ('storage/'.$cimage->image) }}" alt=""></a>
					</div>
					</br>
					@if($user->role == "designer")
					<a  href="{{ route('featuredesign',$cimage->design_id) }}" class="btn btn-info">Add as a Featured</a>
					@endif
				</div>
            @endforeach
			</div>
		</div>
	</section>
	@empty
	<div style="height:300px;margin:auto;">
	<h3 style="text-align:center;color:navy;">This Designer Doesn't Exist</h3>
	</div>
	@endforelse
	<!-- current designs section end -->
	@endsection