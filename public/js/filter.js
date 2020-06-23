
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
		function getValues(page){
				let category = domselected[0];
				let min=$('#minamount').val();
				let max=$('#maxamount').val();
				let tag=tagSelected[0];
				let material=materialSelected[0];
				let filterType=filters;
				let url='http://localhost:8000/designs/?min='+min+'&max='+max;
				if(category)
				{
					url+='&category='+category;
				}
				if(tag)
				{
					url+='&tag='+tag;
				}
				if(material)
				{
					url+='&material='+material;
				}
				if(filterType)
				{
					url+='&filterType='+filterType;
				}
				$.ajaxSetup({
			        headers: {
			          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        }
			      });
				$.ajax({
		        type: 'GET',
		        url: url+'&filtered=' + page,
		        success: function (data) {
		            console.log(data);
		            $('.designs').html(data);
		        },
		        error: function (XMLHttpRequest) {
		        }
		    });

			}
			$('.price-range').slider({change: function() { 
				getValues(); }
			});

		$( document ).ready(function() {	
			domselected = $("#selectable .ui-selected").map(function() {
                        return $(this).text();
                    });	
			$("#selectable li").click(function() {
			  $(this).addClass("selected");
			});
			$("#tags li").click(function() {
			  $(this).addClass("selected");
			});
			$("#materials li").click(function() {
			  $(this).addClass("selected");
			});

	        $(document).on('click', '.pagination a', function(e) {
	        	if($(this).attr('href').split('filtered=')[1])
	        	{
	        		console.log($(this).attr('href').split('filtered=')[1]);
		        	let page=$(this).attr('href').split('filtered=')[1];
		        	getValues(page);
		            e.preventDefault();
	        	}

	        	
	        });

		});
