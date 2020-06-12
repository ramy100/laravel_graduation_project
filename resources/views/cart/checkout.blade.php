@extends('layouts.app')	

@section('content')
<!-- Page Preloder -->
	
	<!-- Page info -->
	<div class="page-top-info">
		<div class="container">
			<h4>Your cart</h4>
			<div class="site-pagination">
				<a href="/">Home</a> /
				<a href="{{route('website.cart')}}">Your cart</a>
			</div>
		</div>
	</div>
	<!-- Page info end -->


	<!-- checkout section  -->
	<section class="checkout-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 order-2 order-lg-1">
					<form class="checkout-form">
						<div class="cf-title">Payment</div>
						<ul class="payment-list">
						<li class="paypalBtn activeBtn">Paypal<a href="{{route('checkout')}}"><img src="{{ asset('images/paypal.png') }}" alt=""></a></li>
						<li class="mastercardBtn">Credit / Debit card<a href="{{route('pay.credit.card.form')}}"><img src="{{ asset('images/mastercart.png') }}" alt=""></a></li>
							{{-- <li>Pay when you get the package</li> --}}
						</ul>
						<div id="paypalform">
							{{-- <button class="site-btn submit-order-btn">Place Order</button> --}}
						</div>
					</form>
					
				</div>
				<div class="col-lg-4 order-1 order-lg-2">
					<div class="checkout-cart">
						<h3>Your Cart</h3>
						<ul class="product-list">
							<?php $total = 0; ?>
							@foreach (Cart::session(auth()->id())->getContent() as $item)
							<li>
							<div class="pl-thumb"><img src="{{ asset('storage/'.$item->attributes->image) }}" alt=""></div>
							<h6>{{ $item->name }}</h6>
								<p>${{ $item->price }}</p>
							</li>	
							<?php $total += $item->price; ?>
							@endforeach
							
						</ul>
						<ul class="price-list">
							<li>Total<span>${{ $total }}</span></li>
							{{-- <li>Shipping<span>free</span></li> --}}
							{{-- <li class="total">Total<span>$99.90</span></li> --}}
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- checkout section end -->

@stop