@extends('layouts.app')	
@section('content')
<div class="container" style="padding: 50px;">
    <div class="checkout-cart">
            <h3 class="text-danger">Invoice</h3>
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
        </ul>
        <img width="300px" class=" pt-5" style="margin-left:-7px;" src="{{asset('images/creditcards.png')}}">
        <div id="mastercardform"  >
            <div class="container">
                @csrf
                    <div class="form-group row">
                        <legend class="col-form-legend col-sm-1-12">Name On Card</legend>
                        <div class="col-sm-1-12">
                            <input id="card-holder-name" class="form-control" placeholder="Name" type="text">
                        </div>
                    </div>
                    <fieldset class="form-group row" style="padding-bottom: 40px;">
                        <legend class="col-form-legend col-sm-1-12">Card Details</legend>
                        <div class="col-sm-1-12">
                            <div id="card-element" class="form-control"></div>
                        </div>
                    </fieldset>
    
                    <div class="form-group row">
                        <button class="site-btn submit-order-btn" data-secret="{{ $intent->client_secret }}" id="card-button">Confirm Payment</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script src="https://js.stripe.com/v3/"></script>

<script>

    const stripe = Stripe("{{env('STRIPE_KEY')}}");


    const elements = stripe.elements();
    const cardElement = elements.create('card');

    cardElement.mount('#card-element');
</script>   
<script>
const cardHolderName = document.getElementById('card-holder-name');
const cardButton = document.getElementById('card-button');
const app = document.getElementById('app');
function get_loading_element() {
    return (
    `
    <div class="container" style="display: flex;;flex-direction: column;height:100vh;align-items:center;justify-content:center;">
            <img src="{{asset('images/loading.gif')}}">
        <h3 class="text-primary">please wait while confirming the transaction</h3>
    </div>
    `
    )
}
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
        app.innerHTML=get_loading_element();
        axios.post('',{
            payment_method:paymentMethod.id
        }).then((data)=>{
			location.replace(data.data.url)
		})
    }
});
</script>
@endpush
