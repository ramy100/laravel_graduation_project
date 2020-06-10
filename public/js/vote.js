$('.wishlist-btn').click(function(e) {
			e.preventDefault();
			let design_id = $('#designId').val();
			let IconClasses=e.target.className;
			let heartClass=	IconClasses.split(" ");
			let vote="";
			if (heartClass.includes("hide"))
			{
				vote="add";
			}
			else if (heartClass.includes("show")) {
				vote="remove";
			}
			 console.log(vote);
			 console.log(heartClass);
			  $.ajaxSetup({
			        headers: {
			          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        }
			      });
				$.ajax({
		        type: 'POST',
		        url: 'http://localhost:8000/design/vote',
		        data: {
		            'design_id':design_id,
		            'vote':vote
		        },
		        success: function (data) {
		        	console.log(data);
		        	$( ".fa-heart" ).toggleClass( "show" );
		        	$( ".fa-heart" ).toggleClass( "hide" );
		        	$(".votes").html(`Total Votes : ${data}`);

		        },
		        error: function (XMLHttpRequest) {
		        }
		    });
		});