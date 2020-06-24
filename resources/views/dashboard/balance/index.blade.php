@extends('layouts.admin')
@section('content')
@csrf
<!-- Page Heading -->
<div class="form-group">
  <label for="state">State</label>
  <select class="form-control" name="state" id="state" onchange="filter_state(this.value)">
    <option @if($state === 'pending') selected @endif>pending</option>
    <option @if($state === 'processing') selected @endif>processing</option>
    <option @if($state === 'complete') selected @endif>complete</option>
    <option @if($state === 'incomplete') selected @endif>incomplete</option>
  </select>
</div>
<div id="tables">

    @include('dashboard.balance.tables')

</div>
@endsection
@push('scripts')
<script>
    $(()=>{
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    })
    function change_state(btn,withdraw_request_id,state) {
        $.ajax({
            type:'POST',
            url:'withdraws/changestate',
            data:{
                withdraw_request_id,
                state
            },success:function (data) {
                $(btn).parents('tr').hide('1000');
            },error:function (responseJSON){
                console.log(responseJSON.responseText);
            }
        })
    }
    function filter_state(state) {
        $.ajax({
            type:'POST',
            data:{
                state
            },success:function (data) {
                $('#tables').html(data);
            },error:function (responseJSON){
                console.log(responseJSON.responseText);
            }
        })
    }
    </script>
@endpush