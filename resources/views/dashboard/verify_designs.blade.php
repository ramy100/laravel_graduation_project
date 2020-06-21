@extends('layouts.admin')
    
@section('content')

@csrf
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Verify Designs {{$state}}</h1>
<p class="mb-4">This is a list of designs which needs to be verified.</a>.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Designs Table</h6>
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
                    @forelse ($design->images as $image)
                        <img class="img-thumbnail" style="width: 100px; height:100px" src={{asset('storage/'.$image->image)}} alt="" srcset="">
                    @empty
                        <div class="alert alert-danger" role="alert">
                            <strong>No Images yet</strong>
                        </div>
                    @endforelse
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
                        <button type="button" class="btn btn-danger" onclick="change_verification(this,{{$design->id}},'rejected')">Reject</button>
                    </td>
                @endif
            </tr>
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
                        status
                    },success:function (data) {
                        $(btn).parents('tr').hide('1000');
                        alert(data);
                    },error:function (responseJSON){
                        alert(responseJSON.responseText);
                    }
                })
            }
        }
    </script>
@endpush