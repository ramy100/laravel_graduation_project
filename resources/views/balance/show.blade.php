@extends('layouts.app')
@section('content')
.<div class="container">
  
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
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#paypal">
    Transfer to paypal
  </button>
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bank">
    Transfer to bank
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
</div>
  @endsection