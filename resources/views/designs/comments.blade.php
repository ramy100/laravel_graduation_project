<style type="text/css">
  .send-icon i{
  font-size: 20px;
  background: #f3f3f3;
  padding: 6px 5px;
  border-radius: 50%;
  color: #74C2E1;
  height: 35px;
  width: 35px;
}
.displayForm{
  display: none;
}

/*.ReplyForm{
  display:block;
}*/
</style>
<div class="panel-body row comments">
	@forelse ($comments as $comment)
    <div class="col-md-12">
        <div class="media g-mb-30 media-comment">
            <img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15" src="{{asset('storage/'.$comment->user->image)}}" alt="Image Description">
            <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
              <div class="g-mb-15">
                <h5 class="h5 g-color-gray-dark-v1 mb-0">{{$comment->user->name}}</h5>
                <span class="g-color-gray-dark-v4 g-font-size-12">{{ date('Y-m-d h:i:s', strtotime($comment->created_at)) }}</span>
              </div>
              <p>{{ $comment->body }}</p>
              <ul class="list-inline d-sm-flex my-0">
                <li class="list-inline-item ml-auto">
                  <a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="#!" onclick="CommentReply({{$comment->id}})">
                    <i class="fa fa-reply g-pos-rel g-top-1 g-mr-3"></i>
                    Reply
                  </a>
                </li>
              </ul>

            </div>
        </div>
        <!-- <div class="status-upload col-md-8"> -->
                <div style="margin:10px 0;margin-left: 65px;" class="ReplyForm displayForm" id="{{$comment->id}}">
                  <form method="POST" action="#" >
                    {{ csrf_field() }}
                    <input type="hidden" name="commentId" id="commentId" value="{{$comment->id}}">
                     <div style="display: inline;width: 100px;">
                      <input type="text" class="form-control reply_body" placeholder="write a reply ..." style="width: 400px;display: inline;">
                    </div>
                    <div class="send-icon" style="display: inline;">
                      <button> <i class="reply fa fa-paper-plane" aria-hidden="true" style="color: #f51167;"></i></button>
                    </div>
              <!-- </div> -->
                  </form>
               </div>   
        </div>
	@empty
		<div style="text-align: center;margin:10px auto;" class="NoComment">No Comments Yet!</div>
	@endforelse
</div>
@if (Auth::check())
<div class="panel-body row addComment">
	<div class="col-md-12">
		<div class="widget-area no-padding blank">
			<div class="status-upload">
				<form method="POST" action="#" id="addCommentForm">
					{{ csrf_field() }}
					<input type="hidden" name="designId" id="designId" value="{{$design->id}}">
					<textarea placeholder="Leave a comment.." id="body"></textarea>
					<button type="submit" class="btn site-btn"><i class="fa fa-share"></i> ADD</button>
				</form>
			</div><!-- Status Upload  -->
		</div><!-- Widget Area -->
	</div>
</div>
@endif


    
