
		$('.js-example-basic-single').select2();
		
		    // $( "#selectable" ).selectable({
		    // 	 stop: function() {
			   //      $( ".ui-selected", this ).each(function() {
			   //        var index = $( "#selectable li" ).index( this );
			   //        console.log(index);
			   //      });
			   //    }
			    
		    // });
		    function getValues(){
				var category = $('.filter1').val();
				var min=$('#minamount').val();
				var max=$('#maxamount').val();
				var filterType=$('.filter2').val();
				console.log(category);
				console.log(min);
				console.log(max);
				console.log(filterType);
				$.ajaxSetup({
			        headers: {
			          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        }
			      });
				$.ajax({
		        type: 'POST',
		        url: 'http://localhost:8000/design/filterBy',
		        data: {
		            'category':category,
		            'minPrice':min,
		            'maxPrice':max,
		            'filterType':filterType
		        },
		        success: function (data) {
		            console.log(data.designs);
		            let designs=data.designs;
		            $('.designs').html("");
		            designs.forEach((element) => {
		            	$('.designs').append(`
		            		<div class="col-lg-4 col-sm-6">
							<div class="product-item">
								<div class="pi-pic">
									<img src="{{asset ('storage/${element.image}') }} " alt="Design Image" id="designImage">
									<div class="pi-links">
										<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
										<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
									</div>
								</div>

								<div class="pi-text">
									<h6>${element.price} &dollar;</h6>
									<h5>${element.title} </h5>
									<p>By ${element.designer.name}</p>
								</div>

							</div>
						</div>
		            		`);
		            });

		            // $('.designs').html(`

		            // 	`);
		        },
		        error: function (XMLHttpRequest) {
		            // handle error
		        }
		    });

			}
			$('.price-range').slider({change: function() { getValues(); }});

		$( document ).ready(function() {		
			
			$('.filter').change(function(event){
				event.preventDefault();
				console.log('hi');
				
				getValues();
				// var f=$('.filter').options[$('filter'.selectedIndex)].value;
			})
		 //    $('.filter').click(function(event) {
			//   console.log( event.target.innerText );
			//   let filterType = event.target.innerText;
		    

			// });
		});
