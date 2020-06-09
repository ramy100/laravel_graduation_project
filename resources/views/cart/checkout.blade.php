@extends('layouts.app')	

@section('content')
<!-- Page Preloder -->
	
	<!-- Page info -->
	<div class="page-top-info">
		<div class="container">
			<h4>Your cart</h4>
			<div class="site-pagination">
				<a href="">Home</a> /
				<a href="">Your cart</a>
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
						<li class="mastercardBtn">Credit / Debit card<a href='javascript:void(0)'><img src="{{ asset('images/mastercart.png') }}" alt=""></a></li>
							{{-- <li>Pay when you get the package</li> --}}
						</ul>

						<div id="paypalform">
							<button class="site-btn submit-order-btn">Place Order</button>
						</div>
					</form>
					<div id="mastercardform" style="display: none;">
						<div class="container">
							<div class="container">
									<div class="form-group row">
										<legend class="col-form-legend col-sm-1-12">Name On Card</legend>
										<div class="col-sm-1-12">
											<input id="card-holder-name" class="form-control" type="text">
										</div>
									</div>
									<fieldset class="form-group row">
										<legend class="col-form-legend col-sm-1-12">Card Details</legend>
										<div class="col-sm-1-12">
											<div id="card-element" class="form-control"></div>
										</div>
									</fieldset>
									<div class="form-group row">
										<div class="offset-sm-2 col-sm-10">
										<button class="site-btn submit-order-btn" data-secret="{{ $intent->client_secret }}" id="card-button">Process Payment</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 order-1 order-lg-2">
					<div class="checkout-cart">
						<h3>Your Cart</h3>
						<ul class="product-list">
							<?php $total = 0; ?>
							@foreach (Cart::session(auth()->id())->getContent() as $item)
							<li>
							<div class="pl-thumb"><img src="{{ asset('images/cart/2.jpg') }}" alt=""></div>
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

@push('scripts')


<script>

$(document).ready(function(){

    $(document).find('.paypalBtn').click();

	$(document).on('click', '.paypalBtn', function(){
		$(this).addClass('activeBtn');
	
		$('.mastercardBtn').removeClass('activeBtn');
		$('#paypalform').show();
		$('#mastercardform').hide();
	})

	$(document).on('click', '.mastercardBtn', function(){
		$(this).addClass('activeBtn');
		$('.paypalBtn').removeClass('activeBtn');
		$('#paypalform').hide();
		$('#mastercardform').show();
	})

});
</script>
<script src="https://js.stripe.com/v3/"></script>

<script>
    const stripe = Stripe('pk_test_51Gs8VBEb0NnSvBW4f2JICqtWkPdANVNbnqf9n3Pl7NR9dg8HvSCXQitdWIxkjVoIH1bSzijcCxT9WOPkibJmmmY800NYcA89FB');

    const elements = stripe.elements();
    const cardElement = elements.create('card');

    cardElement.mount('#card-element');
</script>   
<script>
const cardHolderName = document.getElementById('card-holder-name');
const cardButton = document.getElementById('card-button');

cardButton.addEventListener('click', async (e) => {
    const { paymentMethod, error } = await stripe.createPaymentMethod(
        'card', cardElement, {
            billing_details: { name: cardHolderName.value }
        }
    );

    if (error) {
        // Displaing error to user if form not complete to the user
        alert(error.message)
    } else {
        axios.post('',{
            payment_method:paymentMethod.id
        }).then((data)=>{
			location.replace(data.data.url)
		})
    }
});
</script>
@endpush