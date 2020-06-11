
		$('.js-example-basic-single').select2();
		let domselected=0;
		let tagSelected="";
		let materialSelected="";
		let tag="";
		let filters="";
		$( "#tags" ).selectable({
		    	 stop: function() {
			        tagSelected = $("#tags .ui-selected").map(function() {
                        return $(this).text();

                    });
					console.log(tagSelected[0]);
					getValues();
			      }	    
		});
		$( "#materials" ).selectable({
		    	 stop: function() {
			        materialSelected = $("#materials .ui-selected").map(function() {
                        return $(this).text();
                    });
					console.log(materialSelected[0]);
					getValues();
			      }	    
		});
		$( "#selectable" ).selectable({
		    	 stop: function() {
			        domselected = $("#selectable .ui-selected").map(function() {
                        return $(this).text();

                    });
					console.log(domselected[0]);
					getValues();
			      }	    
		});
		$( ".filter" ).selectmenu({
	      change: function( event, data ) {
	      filters=data.item.value;
	      getValues();
	       console.log(data.item.value);
	      }
	    });
	    // $('#tags').on('change', function (e) {
	    // 	tag=$(this).val();
	    // 	// getValues();
	    // 	console.log(tag);
	    // });
		function getValues(){
				let category = domselected[0];
				let min=$('#minamount').val();
				let max=$('#maxamount').val();
				let tag=tagSelected[0];
				let material=materialSelected[0];
				let filterType=filters;
				// let tag=
				console.log(tag);
				console.log(category);
				console.log(min);
				console.log(tag);
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
		            'filterType':filterType,
		            'tag':tag,
		            'material':material

		        },
		        success: function (data) {
		            console.log(data);
		            console.log(data.user_exist);
		            console.log(data.user_role);
		            console.log(data.tag);
		            let designs=data.designs;
		            let product="";
		            $('.designs').html("");
		            designs.forEach((element) => {
		            	$('.designs').append(`
		            	<div class="col-lg-4 col-sm-6">
							<div class="product-item">
								<div class="pi-pic">
									${ element.state != "sketch" ? '<div class="tag-sale">Sold</div>' : ''}
									<a href="design/${element.id}">
										<img src="/storage/${element.image}" alt="Design Image" id="designImage">
									</a>
									
									<div class="pi-links">
										${data.user_exist && data.user_role == "company" && element.state == "sketch" ? 
										`<div class="pi-links">
											<a href="javascript:void(0)" data-id="${element.id}" class="add-card">
											<i class="flaticon-bag"></i><span>ADD TO CART</span>
											</a>
										</div>`
										:''}
										${data.user_exist && data.user_role == "user" && element.state == "sketch" ?
										 `<a href="design/${element.id}" class="wishlist-btn">
										 <i class="flaticon-heart"></i>
										 </a>`
										 :''}
									</div>
								</div>
								<div class="pi-text">
									<h6>&dollar;${element.price} </h6>
									<h5>${element.title} </h5>
									<p>By ${element.designer.name}</p>
								</div>

							</div>
						</div>
		            		`);
		            });
		        },
		        error: function (XMLHttpRequest) {
		        }
		    });

			}
			$('.price-range').slider({change: function() { 
				getValues(); }
			});

		$( document ).ready(function() {		
			
			$("#selectable li").click(function() {
			  $(this).addClass("selected");
			});
		});
