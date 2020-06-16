@extends('layouts.app')

@section('content')
<section class="category-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 mb-2 row" style="margin: 0 auto;">
						@forelse($designs as $design)
							<div class="col-lg-4 col-sm-6">
								<div class="product-item">
									<div class="pi-pic">
	                                   <a href="{{route('design.show', ['design' => $design->id])}}"><img src="{{asset ('storage/'.$design->images()->first()->image) }} " alt="Design Image" id="designImage"></a>
										
									</div>
									
									<div class="pi-text">
										@if((Auth::user())&&(Auth::user()->role != "user"))
										<h6 style="font-family: monospace;">&dollar;{{$design->price}}</h6>
										@endif
										<a href="{{route('design.show',$design->id)}}" style="color: black;">{{$design->title}}</a>
									</div>
								</div>
							</div>
						@empty
							<div class="alert alert-danger">No Designs Yet!</div>
						@endforelse
				</div>
			</div >
			<div class="row " style="margin-left: 100px;">
				{!! $designs->links() !!}
			</div>
		</div>
</section>

@endsection