@extends('layouts.app')
@section('content')
{{-- <div class="container">
  @if ($errors->any())
  <div class="alert alert-danger">
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach  
  </div>
  @endif
  @if (session()->has("message"))
  <div class="alert alert-success" role="alert">
    <strong>{{session()->get("message")}}</strong> 
  </div>
  @endif
  
  <div class="row">
    <i class="fa fa-money" aria-hidden="true"></i>
    
  </div>

  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#paypal">
    <i class="fa fa-paypal" aria-hidden="true"></i>
    paypal
  </button>
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bank">
    <i class="fa fa-university" aria-hidden="true"></i>
    bank
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="paypal" tabindex="-1" role="dialog" aria-labelledby="paypalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="paypalLongTitle">paypal transfer request</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post">
            @csrf
            <div class="form-group">
              <label for="paypal">Paypal Account</label>
              <input type="text" class="form-control" name="paypal" id="paypal" aria-describedby="emailHelpId" placeholder="">
            </div>
            <div class="form-group">
              <label for="paypal_confirmation">Confirm</label>
              <input type="text" class="form-control" name="paypal_confirmation" id="paypal_confirmation" aria-describedby="emailHelpId" placeholder="">
            </div>
            <div class="form-group">
              <label for="amount">Amount</label>
              <input type="text" class="form-control" name="amount" id="amount" aria-describedby="emailHelpId" placeholder="">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="bank" tabindex="-1" role="dialog" aria-labelledby="bankTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="bankLongTitle">Bank transfer request</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post">
            @csrf
            <div class="form-group">
              <label for="bank_name">Bank Name</label>
              <input type="text" name="bank_name" id="bank_name" class="form-control" aria-describedby="helpId">
            </div>
            <div class="form-group">
              <label for="bank_account_owner">Bank Account Owner</label>
              <input type="text" name="bank_account_owner" id="bank_account_owner" class="form-control"  aria-describedby="helpId">
              <small id="helpId" class="text-muted">must be as the one in documents</small>
            </div>
            <div class="form-group">
              <label for="bank_account_number">Bank Account Number</label>
              <input type="text" name="bank_account_number" id="bank_account_number" class="form-control"  aria-describedby="helpId">
            </div>
            <div class="form-group">
              <label for="amount">Amount</label>
              <input type="text" class="form-control" name="amount" id="amount" aria-describedby="emailHelpId" placeholder="">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div> --}}
<div class="container">
  @if ($errors->any())
  <div class="alert alert-danger">
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach  
  </div>
  @endif
  @if (session()->has("message"))
  <div class="alert alert-success" role="alert">
    <strong>{{session()->get("message")}}</strong> 
  </div>
  @endif
  <div class="row">
          <div class="col-lg-4">
             <div class="profile-card-4 z-depth-3">
              <div class="card">
                {{-- <div class="card-body text-center bg-primary rounded-top">
                  <div class="user-box">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="user avatar">
                  </div>
                  <h5 class="mb-1 text-white">Jhon Doe</h5>
                  <h6 class="text-light">UI/UX Engineer</h6>
                </div> --}}
                <div class="card-body">
                  <ul class="list-group shadow-none">
                  <li class="list-group-item">
                    <div class="list-icon">
                      <i class="fa fa-money" aria-hidden="true"></i>
                    </div>
                    <div class="list-details">
                      <span>{{$user->balance->balance}}</span>
                      <small>Current Balance</small>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="list-icon">
                      <i class="fa fa-handshake-o" aria-hidden="true"></i>
                    </div>
                    <div class="list-details">
                      <span>{{$user->withdraw_requests_by_state('complete')->count()}}</span>
                      <small>Complete Withdraws</small>
                    </div>
                  </li>
                  </ul>
                  <div class="row text-center mt-4">
                    <div class="col p-2">
                     {{-- <h4 class="mb-1 line-height-5">154</h4>
                      <small class="mb-0 font-weight-bold">Projects</small> --}}
                     </div>
                      <div class="col p-2">
                        <h4 class="mb-1 line-height-5">{{$user->withdraw_requests_by_state('complete')->sum('amount')}} $</h4>
                       <small class="mb-0 font-weight-bold">Total Withdraws</small>
                      </div>
                      <div class="col p-2">
                       {{-- <h4 class="mb-1 line-height-5">9.1k</h4>
                       <small class="mb-0 font-weight-bold">Views</small> --}}
                      </div>
                   </div>
                 </div>
               </div>
             </div>
          </div>
          <div class="col-lg-8">
             <div class="card z-depth-3">
              <div class="card-body">
              <ul class="nav nav-pills nav-pills-primary nav-justified">
                  <li class="nav-item">
                      <a href="javascript:void();" data-target="#latest_request" data-toggle="pill" class="nav-link active"><i class="icon-user"></i> <span class="hidden-xs">Latest Withdrw</span></a>
                  </li>
                  <li class="nav-item">
                      <a href="javascript:void();" data-target="#messages" data-toggle="pill" class="nav-link"><i class="icon-envelope-open"></i> <span class="hidden-xs">Previous Withdraws</span></a>
                  </li>
                  <li class="nav-item">
                      <a href="javascript:void();" data-target="#bank_form" data-toggle="pill" class="nav-link"><i class="icon-note"></i> <span class="hidden-xs">
                      <i class="fa fa-university" aria-hidden="true"></i>
                      Bank Withdraw</span></a>
                  </li>
                  <li class="nav-item">
                    <a href="javascript:void();" data-target="#paypal_form" data-toggle="pill" class="nav-link"><i class="icon-note"></i> <span class="hidden-xs">
                    <i class="fa fa-paypal" aria-hidden="true"></i>
                    Paypal Request</span></a>
                  </li>
              </ul>
              <div class="tab-content p-3">
                  <div class="tab-pane active show" id="latest_request">
                      <h5 class="mb-4">Latest request status</h5>
                      <div class="row">
                        @if ($last_request)
                          <div class="col-md-6">
                              <h6>Amount</h6>
                              <p>
                                {{$last_request->amount}}$
                              </p>
                              <h6>Method</h6>
                              <p>
                                Withdraw using {{$last_request->method}} Account
                              </p>
                              <h6>Requested at</h6>
                              <p>
                                {{$last_request->created_at}}
                              </p>
                              <h6>Last Update</h6>
                              <p>
                                {{$last_request->updated_at}}
                              </p>
                          </div>
                          <div class="col-md-6">
                              <h6 class="mb-5">State</h6>
                              <h6 class="text-center mb-2 
                              @if($last_request->state === 'pending')
                              text-info
                              @elseif($last_request->state === 'processing')
                              text-primary
                              @elseif($last_request->state === 'complete')
                              text-success
                              @elseif($last_request->state === 'incomplete')
                              text-danger
                              @endif
                              ">{{$last_request->state}}</h6>
                              <div class="progress">
                                <div class="progress-bar progress-bar-striped 
                                @if($last_request->state === 'pending')
                                bg-info
                                @elseif($last_request->state === 'processing')
                                bg-primary
                                @elseif($last_request->state === 'complete')
                                bg-success
                                @elseif($last_request->state === 'incomplete')
                                bg-danger
                                @endif" 
                                role="progressbar" 
                                style="width: 
                                @if($last_request->state === 'pending')
                                30%
                                @elseif($last_request->state === 'processing')
                                60%
                                @elseif($last_request->state === 'complete')
                                100%
                                @elseif($last_request->state === 'incomplete')
                                100%
                                @endif
                                " aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                          </div>
                        @else
                        <div class="alert alert-danger">
                          You dont have any withdraws yet!
                        </div>
                        @endif
                      </div>
                      <!--/row-->
                  </div>
                  <div class="tab-pane" id="messages">
                      <table class="table table-hover table-striped">
                          <tbody>  
                            @forelse ($user->withdraw_requests as $request)
                              <tr>
                                  <td>
                                     <span class="float-right font-weight-bold
                                      @if($request->state === 'pending')
                                      text-info
                                      @elseif($request->state === 'processing')
                                      text-primary
                                      @elseif($request->state === 'complete')
                                      text-success
                                      @elseif($request->state === 'incomplete')
                                      text-danger
                                      @endif
                                     ">{{$request->state}}</span>Requested at {{$request->created_at->format('m/d/Y')}} a {{$request->amount}} $ withdraw
                                  </td>
                              </tr>
                            @empty
                            <div class="alert alert-danger">
                              You dont have any withdraws yet!
                            </div>
                            @endforelse                                  
                          </tbody> 
                      </table>
                  </div>
                  <div class="tab-pane" id="bank_form">
                      <form method="post">
                        @csrf
                        <div class="form-group">
                          <label for="bank_name">Bank Name</label>
                          <input type="text" name="bank_name" id="bank_name" class="form-control" aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                          <label for="bank_account_owner">Bank Account Owner</label>
                          <input type="text" name="bank_account_owner" id="bank_account_owner" class="form-control"  aria-describedby="helpId">
                          <small id="helpId" class="text-muted">must be as the one in documents</small>
                        </div>
                        <div class="form-group">
                          <label for="bank_account_number">Bank Account Number</label>
                          <input type="text" name="bank_account_number" id="bank_account_number" class="form-control"  aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                          <label for="amount">Amount</label>
                          <input type="text" class="form-control" name="amount" id="amount" aria-describedby="emailHelpId" placeholder="">
                        </div>
                        <div class="text-center">
                          <button type="submit" class="btn btn-primary">Request Bank Transfer</button>
                        </div>
                      </form>
                  </div>
                  <div class="tab-pane" id="paypal_form">
                    <form method="post">
                      @csrf
                      <div class="form-group">
                        <label for="paypal">Paypal Account</label>
                        <input type="text" class="form-control" name="paypal" id="paypal" aria-describedby="emailHelpId" placeholder="">
                      </div>
                      <div class="form-group">
                        <label for="paypal_confirmation">Confirm</label>
                        <input type="text" class="form-control" name="paypal_confirmation" id="paypal_confirmation" aria-describedby="emailHelpId" placeholder="">
                      </div>
                      <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="text" class="form-control" name="amount" id="amount" aria-describedby="emailHelpId" placeholder="">
                      </div>
                      <div class="text-center">
                        <button type="submit" class="btn btn-primary">Request Paypal Transfer</button>
                      </div>
                    </form>
                  </div>
              </div>
          </div>
        </div>
        </div>
          
      </div>
  </div>
@endsection
@push('my_style')
<style>
  body{
    margin-top:20px;
}
/* User Cards */
.user-box {
    width: 110px;
    margin: auto;
    margin-bottom: 20px;
    
}

.user-box img {
    width: 100%;
    border-radius: 50%;
	padding: 3px;
	background: #fff;
	-webkit-box-shadow: 0px 5px 25px 0px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: 0px 5px 25px 0px rgba(0, 0, 0, 0.2);
    -ms-box-shadow: 0px 5px 25px 0px rgba(0, 0, 0, 0.2);
    box-shadow: 0px 5px 25px 0px rgba(0, 0, 0, 0.2);
}

.profile-card-2 .card {
	position:relative;
}

.profile-card-2 .card .card-body {
	z-index:1;
}

.profile-card-2 .card::before {
    content: "";
    position: absolute;
    top: 0px;
    right: 0px;
    left: 0px;
	border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
    height: 112px;
    background-color: #e6e6e6;
}

.profile-card-2 .card.profile-primary::before {
	background-color: #008cff;
}
.profile-card-2 .card.profile-success::before {
	background-color: #15ca20;
}
.profile-card-2 .card.profile-danger::before {
	background-color: #fd3550;
}
.profile-card-2 .card.profile-warning::before {
	background-color: #ff9700;
}
.profile-card-2 .user-box {
	margin-top: 30px;
}

.profile-card-3 .user-fullimage {
	position:relative;
}

.profile-card-3 .user-fullimage .details{
	position: absolute;
    bottom: 0;
    left: 0px;
	width:100%;
}

.profile-card-4 .user-box {
    width: 110px;
    margin: auto;
    margin-bottom: 10px;
    margin-top: 15px;
}

.profile-card-4 .list-icon {
    display: table-cell;
    font-size: 30px;
    padding-right: 20px;
    vertical-align: middle;
    color: #223035;
}

.profile-card-4 .list-details {
	display: table-cell;
	vertical-align: middle;
	font-weight: 600;
    color: #223035;
    font-size: 15px;
    line-height: 15px;
}

.profile-card-4 .list-details small{
	display: table-cell;
	vertical-align: middle;
	font-size: 12px;
	font-weight: 400;
    color: #808080;
}

/*Nav Tabs & Pills */
.nav-tabs .nav-link {
    color: #223035;
	font-size: 12px;
    text-align: center;
	letter-spacing: 1px;
    font-weight: 600;
	margin: 2px;
    margin-bottom: 0;
	padding: 12px 20px;
    text-transform: uppercase;
    border: 1px solid transparent;
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
	
}
.nav-tabs .nav-link:hover{
    border: 1px solid transparent;
}
.nav-tabs .nav-link i {
    margin-right: 2px;
	font-weight: 600;
}

.top-icon.nav-tabs .nav-link i{
	margin: 0px;
	font-weight: 500;
	display: block;
    font-size: 20px;
    padding: 5px 0;
}

.nav-tabs-primary.nav-tabs{
	border-bottom: 1px solid #008cff;
}

.nav-tabs-primary .nav-link.active, .nav-tabs-primary .nav-item.show>.nav-link {
    color: #008cff;
    background-color: #fff;
    border-color: #008cff #008cff #fff;
    border-top: 3px solid #008cff;
}

.nav-tabs-success.nav-tabs{
	border-bottom: 1px solid #15ca20;
}

.nav-tabs-success .nav-link.active, .nav-tabs-success .nav-item.show>.nav-link {
    color: #15ca20;
    background-color: #fff;
    border-color: #15ca20 #15ca20 #fff;
    border-top: 3px solid #15ca20;
}

.nav-tabs-info.nav-tabs{
	border-bottom: 1px solid #0dceec;
}

.nav-tabs-info .nav-link.active, .nav-tabs-info .nav-item.show>.nav-link {
    color: #0dceec;
    background-color: #fff;
    border-color: #0dceec #0dceec #fff;
    border-top: 3px solid #0dceec;
}

.nav-tabs-danger.nav-tabs{
	border-bottom: 1px solid #fd3550;
}

.nav-tabs-danger .nav-link.active, .nav-tabs-danger .nav-item.show>.nav-link {
    color: #fd3550;
    background-color: #fff;
    border-color: #fd3550 #fd3550 #fff;
    border-top: 3px solid #fd3550;
}

.nav-tabs-warning.nav-tabs{
	border-bottom: 1px solid #ff9700;
}

.nav-tabs-warning .nav-link.active, .nav-tabs-warning .nav-item.show>.nav-link {
    color: #ff9700;
    background-color: #fff;
    border-color: #ff9700 #ff9700 #fff;
    border-top: 3px solid #ff9700;
}

.nav-tabs-dark.nav-tabs{
	border-bottom: 1px solid #223035;
}

.nav-tabs-dark .nav-link.active, .nav-tabs-dark .nav-item.show>.nav-link {
    color: #223035;
    background-color: #fff;
    border-color: #223035 #223035 #fff;
    border-top: 3px solid #223035;
}

.nav-tabs-secondary.nav-tabs{
	border-bottom: 1px solid #75808a;
}
.nav-tabs-secondary .nav-link.active, .nav-tabs-secondary .nav-item.show>.nav-link {
    color: #75808a;
    background-color: #fff;
    border-color: #75808a #75808a #fff;
    border-top: 3px solid #75808a;
}

.tabs-vertical .nav-tabs .nav-link {
    color: #223035;
    font-size: 12px;
    text-align: center;
    letter-spacing: 1px;
    font-weight: 600;
    margin: 2px;
    margin-right: -1px;
    padding: 12px 1px;
    text-transform: uppercase;
    border: 1px solid transparent;
    border-radius: 0;
    border-top-left-radius: .25rem;
    border-bottom-left-radius: .25rem;
}

.tabs-vertical .nav-tabs{
	border:0;
	border-right: 1px solid #dee2e6;
}

.tabs-vertical .nav-tabs .nav-item.show .nav-link, .tabs-vertical .nav-tabs .nav-link.active {
    color: #495057;
    background-color: #fff;
    border-color: #dee2e6 #dee2e6 #fff;
    border-bottom: 1px solid #dee2e6;
    border-right: 0;
    border-left: 1px solid #dee2e6;
}

.tabs-vertical-primary.tabs-vertical .nav-tabs{
	border:0;
	border-right: 1px solid #008cff;
}

.tabs-vertical-primary.tabs-vertical .nav-tabs .nav-item.show .nav-link, .tabs-vertical-primary.tabs-vertical .nav-tabs .nav-link.active {
    color: #008cff;
    background-color: #fff;
    border-color: #008cff #008cff #fff;
    border-bottom: 1px solid #008cff;
    border-right: 0;
    border-left: 3px solid #008cff;
}

.tabs-vertical-success.tabs-vertical .nav-tabs{
	border:0;
	border-right: 1px solid #15ca20;
}

.tabs-vertical-success.tabs-vertical .nav-tabs .nav-item.show .nav-link, .tabs-vertical-success.tabs-vertical .nav-tabs .nav-link.active {
    color: #15ca20;
    background-color: #fff;
    border-color: #15ca20 #15ca20 #fff;
    border-bottom: 1px solid #15ca20;
    border-right: 0;
    border-left: 3px solid #15ca20;
}

.tabs-vertical-info.tabs-vertical .nav-tabs{
	border:0;
	border-right: 1px solid #0dceec;
}

.tabs-vertical-info.tabs-vertical .nav-tabs .nav-item.show .nav-link, .tabs-vertical-info.tabs-vertical .nav-tabs .nav-link.active {
    color: #0dceec;
    background-color: #fff;
    border-color: #0dceec #0dceec #fff;
    border-bottom: 1px solid #0dceec;
    border-right: 0;
    border-left: 3px solid #0dceec;
}

.tabs-vertical-danger.tabs-vertical .nav-tabs{
	border:0;
	border-right: 1px solid #fd3550;
}

.tabs-vertical-danger.tabs-vertical .nav-tabs .nav-item.show .nav-link, .tabs-vertical-danger.tabs-vertical .nav-tabs .nav-link.active {
    color: #fd3550;
    background-color: #fff;
    border-color: #fd3550 #fd3550 #fff;
    border-bottom: 1px solid #fd3550;
    border-right: 0;
    border-left: 3px solid #fd3550;
}

.tabs-vertical-warning.tabs-vertical .nav-tabs{
	border:0;
	border-right: 1px solid #ff9700;
}

.tabs-vertical-warning.tabs-vertical .nav-tabs .nav-item.show .nav-link, .tabs-vertical-warning.tabs-vertical .nav-tabs .nav-link.active {
    color: #ff9700;
    background-color: #fff;
    border-color: #ff9700 #ff9700 #fff;
    border-bottom: 1px solid #ff9700;
    border-right: 0;
    border-left: 3px solid #ff9700;
}

.tabs-vertical-dark.tabs-vertical .nav-tabs{
	border:0;
	border-right: 1px solid #223035;
}

.tabs-vertical-dark.tabs-vertical .nav-tabs .nav-item.show .nav-link, .tabs-vertical-dark.tabs-vertical .nav-tabs .nav-link.active {
    color: #223035;
    background-color: #fff;
    border-color: #223035 #223035 #fff;
    border-bottom: 1px solid #223035;
    border-right: 0;
    border-left: 3px solid #223035;
}

.tabs-vertical-secondary.tabs-vertical .nav-tabs{
	border:0;
	border-right: 1px solid #75808a;
}

.tabs-vertical-secondary.tabs-vertical .nav-tabs .nav-item.show .nav-link, .tabs-vertical-secondary.tabs-vertical .nav-tabs .nav-link.active {
    color: #75808a;
    background-color: #fff;
    border-color: #75808a #75808a #fff;
    border-bottom: 1px solid #75808a;
    border-right: 0;
    border-left: 3px solid #75808a;
}

.nav-pills .nav-link {
    border-radius: .25rem;
    color: #223035;
    font-size: 12px;
    text-align: center;
	letter-spacing: 1px;
    font-weight: 600;
    text-transform: uppercase;
	margin: 3px;
    padding: 12px 20px;
	-webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease; 

}

.nav-pills .nav-link:hover {
    background-color:#f4f5fa;
}

.nav-pills .nav-link i{
	margin-right:2px;
	font-weight: 600;
}

.top-icon.nav-pills .nav-link i{
	margin: 0px;
	font-weight: 500;
	display: block;
    font-size: 20px;
    padding: 5px 0;
}

.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    color: #fff;
    background-color: #008cff;
    box-shadow: 0 4px 20px 0 rgba(0,0,0,.14), 0 7px 10px -5px rgba(0, 140, 255, 0.5);
}

.nav-pills-success .nav-link.active, .nav-pills-success .show>.nav-link {
    color: #fff;
    background-color: #15ca20;
    box-shadow: 0 4px 20px 0 rgba(0,0,0,.14), 0 7px 10px -5px rgba(21, 202, 32, .5);
}

.nav-pills-info .nav-link.active, .nav-pills-info .show>.nav-link {
    color: #fff;
    background-color: #0dceec;
    box-shadow: 0 4px 20px 0 rgba(0,0,0,.14), 0 7px 10px -5px rgba(13, 206, 236, 0.5);
}

.nav-pills-danger .nav-link.active, .nav-pills-danger .show>.nav-link{
    color: #fff;
    background-color: #fd3550;
    box-shadow: 0 4px 20px 0 rgba(0,0,0,.14), 0 7px 10px -5px rgba(253, 53, 80, .5);
}

.nav-pills-warning .nav-link.active, .nav-pills-warning .show>.nav-link {
    color: #fff;
    background-color: #ff9700;
    box-shadow: 0 4px 20px 0 rgba(0,0,0,.14), 0 7px 10px -5px rgba(255, 151, 0, .5);
}

.nav-pills-dark .nav-link.active, .nav-pills-dark .show>.nav-link {
    color: #fff;
    background-color: #223035;
    box-shadow: 0 4px 20px 0 rgba(0,0,0,.14), 0 7px 10px -5px rgba(34, 48, 53, .5);
}

.nav-pills-secondary .nav-link.active, .nav-pills-secondary .show>.nav-link {
    color: #fff;
    background-color: #75808a;
    box-shadow: 0 4px 20px 0 rgba(0,0,0,.14), 0 7px 10px -5px rgba(117, 128, 138, .5);
}
.card .tab-content{
	padding: 1rem 0 0 0;
}

.z-depth-3 {
    -webkit-box-shadow: 0 11px 7px 0 rgba(0,0,0,0.19),0 13px 25px 0 rgba(0,0,0,0.3);
    box-shadow: 0 11px 7px 0 rgba(0,0,0,0.19),0 13px 25px 0 rgba(0,0,0,0.3);
}
</style>
@endpush