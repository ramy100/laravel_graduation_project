<h1 class="h3 mb-2 text-gray-800">{{ ucfirst(trans($state)) }} withdraw requests</h1>
<p class="mb-4">This is a list of {{$state}} withdraw requests .</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Requests Table</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Designer Name</th>
                        <th scope="col">Amount</th>
                        <th scope="col">State</th>
                        <th scope="col">Method</th>
                        <th colspan="3" scope="col">Details</th>
                        <th scope="col">User Documents</th>
                        @if($state === 'pending')
                        <th scope="col">Move To Proccessing</th>
                        @endif
                        @if($state === 'processing')
                        <th scope="col">Complete</th>
                        <th scope="col">Incomplete</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($withdraw_requests as $request)
                    <tr>
                        <th class="align-middle" scope="row">{{$request->id}}</th>
                        <td class="align-middle">{{$request->user->name}}</td>
                        <td class="align-middle">{{$request->amount}}$</td>
                        <td class="align-middle">{{$request->state}}</td>
                        <td class="align-middle">{{$request->method}}</td>
                        @if ($request->method === 'bank')
                        <td colspan="3">
                            <table class="table" style="display: inline;">
                                <tr>
                                    <td>Bank Name</td>
                                    <td>Account Number</td>
                                    <td>Account Owner</td>
                                </tr>
                                <tr>
                                    <td>{{$request->bank_name}}</td>
                                    <td>{{$request->bank_account_number}}</td>
                                    <td>{{$request->bank_owner_name}}</td>
                                </tr>
                            </table>
                        </td>
                        @else
                        <td colspan="3">
                            <table class="table">
                                <tr>
                                    <td >Paypal Email</td>
                                </tr>
                                <tr>
                                    <td>{{$request->paypal_email}}</td>
                                </tr>
                </table>
            </td>
            @endif
            <td class="align-middle">
                <a target="_blank" href="{{route('admin.view_user_document',$request->user->id)}}" class="btn btn-success ">Preview Document</a>
            </td>
            @if($state === 'pending')
            <td class="align-middle">
                <button type="button" class="btn btn-primary" onclick="change_state(this,{{$request->id}},'processing')">Move to in progress</button>
            </td>
            @endif
            @if($state === 'processing')
            <td class="align-middle">
                <button type="button" class="btn btn-success" onclick="change_state(this,{{$request->id}},'Complete')">Complete</button>
            </td>
            <td class="align-middle">
                <button type="button" class="btn btn-danger" onclick="change_state(this,{{$request->id}},'incomplete')">Incomplete</button>
            </td>
            @endif
        </tr>
        @empty
        <tr>
            <td colspan="11">
                <div class="alert alert-danger" role="alert">
                    <strong>No {{$state}} Withdraws yet</strong>
                </div>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
{{ $withdraw_requests->appends(['state' => $state])->links() }}
</div>