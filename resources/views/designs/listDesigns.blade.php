				<div class="col-lg-12 mb-2 row designs">
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
									<h5>{{$design->title}}</h5>
									<p>By {{$design->designer->name}}</p>
								</div>

							</div>
						</div>
						@empty
							<div class="alert alert-danger">No Designs Yet!</div>
						@endforelse
					</div>

					{{-- <div class="row">
							 {!! $desings->links() !!}  
					</div>	--}}