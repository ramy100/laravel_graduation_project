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
    function ajax_request_to_change_state(btn,withdraw_request_id,state,mail_body) {
        $.ajax({
            type:'POST',
            url:'withdraws/changestate',
            data:{
                withdraw_request_id,
                state,
                mail_body
            },success:function (data) {
                $(btn).parents('tr').hide('1000');
            },error:function (responseJSON){
                console.log(responseJSON.responseText);
            }
        })
    }
    function change_state(btn,withdraw_request_id,state) {
        let mail_body=`Your withdraw request is ${state}`;
        if (state === 'incomplete') {
            bootbox.prompt({ 
            title: "Send Rejection Email",
            message: "reason of rejection ?",
            centerVertical: true,
            inputType: 'textarea',
            buttons: {
            confirm: {
                label: 'Send Email',
                className: 'btn-success'
            },
            cancel: {
                label: 'Not Now',
                className: 'btn-danger'
            }
            },
            callback: function(result){ 
                mail_body=result;
                if(mail_body){
                    if (mail_body.length > 10) {
                        ajax_request_to_change_state(btn,withdraw_request_id,state,mail_body)
                    }else{
                        bootbox.alert({
                            title:'Error Sending Mail!',
                            message:'To short message!',centerVertical: true
                        })
                    }
                }
            }
            });
        }else{
            ajax_request_to_change_state(btn,withdraw_request_id,state,mail_body)
        }
        
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