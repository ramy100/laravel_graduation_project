@extends('layouts.app')

@section('content')
    <section class="container">
        @if (session('status'))
        <div class="alert alert-{{ session('color') }}">
            {{ session('status') }}
        </div>
        @endif
    </section>
	<section class="cart-section spad" id='cart-data'>
		<h1 class="text-center"><span class="fa fa-spinner fa-spin fa-3x" ></span></h1>
	</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function(){

        $(document).on('click', '.removed-card', function(){
            var design_id = $(this).data('id');
            $.post('{{ route('remove-from-cart') }}', {"_token": "{{ csrf_token() }}","id": design_id}, function(response){
					
					loadCart();
					
            }).fail(function(error){

            })
        })

		function loadCart(){
			$.get('{{ route('load-cart') }}', {}, function(response){
		
				$(document).find('#cart-count').html(response.count);
				$(document).find('#cart-data').html(response.html);

            }).fail(function(error){

            })
		}
		loadCart();

    });
</script>
@endpush