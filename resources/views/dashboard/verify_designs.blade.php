@extends('layouts.admin')
    
@section('content')

@csrf
<div class="container">
<table class="table text-center table-striped table-dark inline-table">
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