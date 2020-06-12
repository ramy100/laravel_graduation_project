@extends('layouts.app')

	@section('content')
	<!-- product section -->
	<section class="product-section">
	@forelse($designer as $designer_data)
		<div class="container">
			<div class="row">
				<div class="col-lg-6" >
						<div style="width:300px;height:400px;margin-bottom : 30px;">
							<img class="product-big-img" style="width:300px;height:400px;"src="<?php echo asset("storage/$designer_data->image")?>" alt="{{ $designer_data->name }}">
							</br>
							<h3 style="text-align: center;">{{ $designer_data->name }}
								@if($vote_exist->count() > 0)
									<i class="flaticon-heart text-danger" value="{{$designer_data->id}}"></i>
								@else
									<i class="flaticon-heart text-dark" value="{{$designer_data->id}}"></i>
								@endif
							</h3>
						</div>
						</br>
						<div class="row" >
							@can('update',$designer_data)
							@if($user->role == "designer")
								<div class="col-lg-3" style="margin-right:15px;"  >
								<a  href="{{ route('user.edit',$designer_data) }}" class="editDesign">Edit Profile</a>
								</div> 
							@endif
							@endcan
							@can('update',$designer_data)
							@if($user->role == "designer")
								<div class="col-lg-3" >
								<a  href="{{ route('user.create',$designer_data) }}" class="editDesign">Add Piography</a>
								</div> 
							@endif
							@endcan
						</div>
						@can('update',$designer_data)
						@if($user->role == "designer")
						
						</br>
						<div class="col-lg-3"style="margin-left:60px;" >
							{!! Form::open(['route'=>['designer.destroy',$designer_data],'method'=>'delete']) !!} 
							{!! Form::submit('DELETE',['class'=>'deleteDesign btn-danger']) !!}
							{!! Form::close() !!} 
                        </div>
						@endif
						@endcan

					
					
                </div>
                </br> 
				<div class="col-lg-6 product-details"style="margin-top: 80px;">
					<h2 class="p-title"> {{ $designer_data->name }}</h2></br>
					<h4 class="p-stock">followers  <span id = "followers">{{$likes}}</span></h4>
					<h4 class="p-stock">Emial <span>{{$designer_data->email}}</span></h4>
                    <h4 class="p-stock">Phone <span>{{$designer_data->phone}}</span></h4>
					<h4 class="p-stock">Address <span>{{$designer_data->address}}</span></h4>
					@can('update',$designer_data)
                    @if($user->role == "designer")
					<a href="{{ route('design.create',$designer_data) }}" class="btn site-btn"style="margin-top:15px;">ADD NEW DESIGN</a>
					@endif
					@endcan
					<div id="accordion" class="accordion-area">
						<div class="panel">
							<div class="panel-header" id="headingOne">
								<button class="panel-link " data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">about</button>
							</div>
							<div id="collapse1" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="panel-body">
									<p>{{$about[0]->about}}</p>
								</div>
							</div>
						</div>
						<div class="panel">
							<div class="panel-header" id="headingTwo">
								<button class="panel-link" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">Achievements</button>
							</div>
							<div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
								<div class="panel-body">
								<h5 style="color: #f51167;">Designs</h5>
								<h6>{{$design_count}}</h6>
									</br>
								<h5 style="color: #f51167;">Sold Designs</h5>
								<h6>{{$prev_count}}</h6>
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
		<!-- current designs section end -->
	</br>
</br>
		<!-- previous work section start -->
	<section class="related-product-section">
		<div class="container">
			<div class="section-title">
				<h2>PREVIOUS DESIGNS</h2>
			</div>
			<div class="product-slider owl-carousel">
            @foreach($prev_img as $pimage)
				<div class="product-item">
					<div class="pi-pic">
					{{-- <h5>{{$pimage[0]}}</h5> --}}
						<img src="{{asset ('storage/'.$pimage->image) }}" alt="">
					</div>
					</br>
				</div>
            @endforeach
			</div>
		</div>
		<!-- previous work section end -->
	</section>
	@empty
	<div style="height:300px;margin:auto;">
	<h3 style="text-align:center;color:navy;">This Designer Doesn't Exist</h3>
	</div>
	@endforelse
	<!-- current designs section end -->
	@endsection