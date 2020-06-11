	<div class="container">
		
		@if(count($items))		
		<div class="row">
			<div class="col-lg-8">
				<div class="cart-table">
					<h3>Your Cart</h3>
					<div class="cart-table-warp" tabindex="1" style="overflow: hidden; outline: none;">
						<table>
						<thead>
							<tr>
								<th class="product-th">Product</th>
								<th class=" quy-th">Quantity</th>
								<th class="total-th">Price</th>
								<th class="total-th">Remove</th>
							</tr>
						</thead>
						<tbody>
							<?php $total = 0; ?>
							@foreach ($items as $item)
							<?php  $total += $item->price; ?>
							<tr>
								<td class="product-col text-center">
									<img src="{{asset('storage/'.$item->attributes->image)}}" alt="">
									<div class="pc-title">
									<h4>{{ $item->name }}</h4>
									</div>
								</td>
								<td class="quy-col text-center">
									<p>1</p>
								</td>
								<td class="total-col text-center">
									<h4>${{ $item->price }}</h4>
								</td>
								<td class="text-center">
									<a href="javascript:void(0)"  data-id="{{ $item->id }}" class="removed-card"><i class="text-danger fa-2x fa fa-trash"></i></a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					</div>
					<div class="total-cost">
					<h6>Total <span>${{$total}}</span></h6>
					</div>
				</div>
			</div>
			<div class="col-lg-4 card-right">
				<a href="{{ route('checkoutPage') }}" class="site-btn">Proceed to checkout</a>
				<a href="{{ route('website.index') }}" class="site-btn sb-dark">Continue shopping</a>
				<a href="{{ route('empty-cart') }}" class="site-btn">Empty your cart</a>
			</div>
		</div>

		@else
			<h2 class="text-center text-muted">Cart is Empty!</h2>
		@endif
	</div>


	