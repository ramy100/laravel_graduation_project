@extends('layouts.admin')
    
@section('content')
@if (session()->has('message'))
    <div class="alert alert-".{{color}} role="alert">
        <strong>{{message}}</strong>{{session()->get('message')}}
    </div>
@endif
@csrf
<div class="container">
<table class="table text-center table-striped table-dark inline-table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Website</th>
        <th scope="col">Logo</th>
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
        @forelse ($pending_users as $user)
            <tr>
            <th class="align-middle" scope="row">{{$loop->iteration}}</th>
                <td class="align-middle">{{$user->name}}</td>
                <td class="align-middle">{{$user->email}}</td>
                <td class="align-middle">{{$user->website}}</td>
                <td class="align-middle"><img class="img-thumbnail" style="width: 300px; height:200px" src={{asset('storage/'.$user->image)}} alt="" srcset=""></td>
                <td class="align-middle">
                    <a target="_blank" href="{{route('admin.view_user',$user->id)}}" class="btn btn-success ">Preview Document</a>
                </td>
                @if($state === 'rejected' || $state === 'pending')
                    <td class="align-middle">
                        <button type="button" class="btn btn-primary" onclick="change_verification(this,{{$user->id}},'accepted')">Accept</button>
                    </td>
                @endif
                @if($state === 'accepted' || $state === 'pending')
                    <td class="align-middle">
                        <button type="button" class="btn btn-danger" onclick="change_verification(this,{{$user->id}},'rejected')">Reject</button>
                    </td>
                @endif
            </tr>
            @empty
            <tr>
                <td colspan="8">
                    <div class="alert alert-danger" role="alert">
                        <strong>No {{$state}} {{$role}} yet</strong>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
</table>
{{ $pending_users->links() }}

</div>

@endsection
@push('scripts')
    <script>
        function change_verification(btn,user_id,status) {
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
                        user_id,
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