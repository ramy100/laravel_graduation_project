$('#addCommentForm').submit(function( event ) {
  event.preventDefault();
  let design_id = $('#designId').val();
  let comment_body=$('#body').val();
   $.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.ajax({
		type: 'POST',
		url: 'http://localhost:8000/design/comment',
		data: {
		    'design_id':design_id,
		    'comment_body':comment_body
		},
		success: function (data) {
			console.log(data);
			let comment=data.comment;
				$('.comments').append(`
					<div class="col-md-12">
				        <div class="media g-mb-30 media-comment">
				            <img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15" src="/storage/${comment.user.image}" alt="Image Description">
				            <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
				              <div class="g-mb-15">
				                <h5 class="h5 g-color-gray-dark-v1 mb-0">${comment.user.name}</h5>
				                <span class="g-color-gray-dark-v4 g-font-size-12">${comment.created_at}</span>
				              </div>
				              <p>${comment.body}</p>
				              <ul class="list-inline d-sm-flex my-0">
				                <li class="list-inline-item ml-auto">
				                  <a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="#!">
				                    <i class="fa fa-reply g-pos-rel g-top-1 g-mr-3"></i>
				                    Reply
				                  </a>
				                </li>
				              </ul>
				            </div>
				        </div>
				</div>
				`);
			$('#body').val('');
		},
		error: function (XMLHttpRequest) {
		        }
	});
});