@extends('layouts.admin')
    
@section('content')

@csrf
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Verify {{$state}} designs</h1>
<p class="mb-4">This is a list of designs which needs to be verified.</a>.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Pending designs Table</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Price</th>
            <th scope="col">Category</th>
            <th scope="col">Images</th>
            <th scope="col">Document</th>
            @if($state === 'rejected' || $state === 'pending')
            <th scope="col">Accept</th>
            @endif
            @if($state === 'accepted' || $state === 'pending')
            <th scope="col">Reject</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @forelse ($designs as $design)
            <tr>
            <th class="align-middle" scope="row">{{$loop->iteration}}</th>
                <td class="align-middle">{{$design->title}}</td>
                <td class="align-middle">{{$design->price}}</td>
                <td class="align-middle">{{$design->category}}</td>
                <td class="align-middle">
                    <a href="#"  data-toggle="modal" data-target="#ImagesModal{{ $design->id }}" >
                        @forelse ($design->images as $image)
                            <img class="img-thumbnail" style="width: 100px; height:100px" src={{asset('storage/'.$image->image)}} alt="" srcset="">
                        @empty
                            <div class="alert alert-danger" role="alert">
                                <strong>No Images yet</strong>
                            </div>
                        @endforelse
                    </a>
                </td>
                <td class="align-middle">
                    <a target="_blank" href="{{route('admin.view_design_document',$design->id)}}" class="btn btn-success ">Preview Document</a>
                </td>
                @if($state === 'rejected' || $state === 'pending')
                    <td class="align-middle">
                        <button type="button" class="btn btn-primary" onclick="change_verification(this,{{$design->id}},'accepted')">Accept</button>
                    </td>
                @endif
                @if($state === 'accepted' || $state === 'pending')
                    <td class="align-middle">
                        <button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#RejectionModal{{ $design->id }}" id="{{ $design->id }}">Reject</button>
                    </td>
                @endif
            </tr>
            <!-- Rejection Modal -->
            <div class="modal fade" id="RejectionModal{{ $design->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Design Confirmation </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                               
                        <div class="modal-body">
                            <div class="alert alert-danger" style="display:none"></div>
                            <form class="form-horizontal" role="form"  method="post" action="#">
                                @csrf
                                            
                                <input type="text" placeholder="To" name="To" value="{{ $design->designer->email }}" class="form-control  reciever" autofocus>
                                <input type="text" placeholder="Subject" name="Subject"  class="form-control mt-2 Subject" autofocus>
                                <input type="hidden" value="{{$design->id}}" id="design_id">
                                <textarea  name="Message" placeholder="Message" class="form-control mb-2 mt-2 Message" rows="4" cols="50" autofocus></textarea>
                                              
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" type="submit" onclick="change_verification($('#'+{{ $design->id }}),{{$design->id}},'rejected')" >Send</button>
                                </div>
                             </form>
                        </div>
                    </div>
                </div>
            </div>  
             <!-- Images modal -->
            <div class="modal fade" id="ImagesModal{{ $design->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog  modal-lg" >
                <div class="modal-content">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                      <!-- Wrapper for slides -->

                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                  <img class="d-block w-100" src="{{asset ('storage/'.$design->images->first()->image) }}" alt="First slide">
                                </div>
                                @foreach ($design->images as  $key => $image)
                                    @if($key>0)
                                        <div class="carousel-item ">
                                          <img class="d-block w-100" src="{{asset ('storage/'.$image->image) }}" alt="First slide">
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev" style="color: black;">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next" style="color: black;">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                          </a>
                        </div>

                </div>
              </div>
            </div>
            @empty
            <tr>
                <td colspan="8">
                    <div class="alert alert-danger" role="alert">
                        <strong>No {{$state}} Designs yet</strong>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
</table>

{{ $designs->links() }}

</div>

@endsection
@push('scripts')
    <script>
        function change_verification(btn,design_id,status) {
            let reciever=$('.reciever').val();
            if(status == 'rejected')
            {
                Subject=$('.Subject').val();
                Message=$('.Message').val();
            }
            else if(status == 'accepted')
            {
                Subject= "Add Design confirmation";
                Message="Your design has been accepted ."
            }
            console.log(btn);
            console.log(Message);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            answer = confirm('are you sure ?')
            if(answer){
                $.ajax({
                    type:'POST',
                    data:{
                        design_id,
                        status,
                        reciever,
                        Subject,
                        Message
                    },success:function (data) {
                        if(data.errors)
                        {
                            $('.alert-danger').html('');

                            $.each(data.errors, function(key, value){
                                $('.alert-danger').show();
                                $('.alert-danger').append('<li>'+value+'</li>');
                            });
                        }
                        else
                        {
                            $('.alert-danger').hide();
                            $('#RejectionModal'+design_id).modal('hide');
                            $(btn).parents('tr').hide('1000'); 
                        }
                        console.log(data);
                        
                        // alert(data);
                    },error:function (responseJSON){
                        alert(responseJSON.responseText);
                    }
                })
            }
        }
    </script>
@endpush