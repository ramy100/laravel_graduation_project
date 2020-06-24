<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BalanceController extends Controller
{
   
    /**
     * Display the specified user balance.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('balance.show',compact('user'));
    }

    /**
     * Make new withdraw request
     *
     */
    public function request(Request $request,User $user)
    {   
        $data=array_merge($request->all(),['designer_id'=>$user->id]);
        // determine which form is beign submitted
        if(array_key_exists('paypal',$request->input())){
            $type='paypal';
        }
        if(array_key_exists('bank_name',$request->input())){
            $type='bank';
        }
        // validate form data
        $this->balance_validator($data,$type,$user)->validate();
        // create new record
        $this->create_new_withdraw_request($request->all(),$user,$type);
        return redirect(route('balance',$user))->with('message','Your ' .$type.' transfer request is pending now please wait!');
    }






    // function
    //validating balance data
    protected function balance_validator(array $data,$type,$user)
    {

        // validation for bank form
        if ($type === 'bank') {
            return Validator::make($data, [
                'designer_id'=>['required',
                Rule::unique('withdraw_requests')->where(function ($query) {
                    return $query->whereNotIn('state', ['complete','incomplete']);
                }),
            ],
                'bank_name' => ['required', 'string', 'max:25'],
                'bank_account_number' => ['required', 'numeric', 'digits:18'],
                'bank_account_owner' => ['required', 'string', 'max:25'],
                'amount'=>['numeric','lt:'.$user->balance->balance],
            ],[
                'unique'    => 'Your previous request is still in progress',
                'lt'=>'You dont have that amount in your balance'
            ]);

        // validation for paypal form
        }elseif($type === 'paypal') {
            return Validator::make($data, [
                'designer_id'=>['required',
                Rule::unique('withdraw_requests')->where(function ($query) {
                    return $query->whereNotIn('state', ['complete','incomplete']);
                }),
            ],
                'paypal' => ['required', 'email', 'max:25','confirmed'],
                'amount'=>['numeric','lt:'.$user->balance->balance],
            ],[
                'unique'    => 'Your previous request is still in progress',
                'lt'=>'You dont have that amount in your balance'
            ]);
        }
    }



    // function
    // create new withdraw request
    protected function create_new_withdraw_request(array $data,User $user,$type)
    {
        // create record for bank form
        if ($type === 'bank') {
            $user->withdraw_request()->create([
                'amount'=>$data['amount'],
                'method'=>'bank',
                'bank_name'=>$data['bank_name'],
                'bank_account_number'=>$data['bank_account_number'],
                'bank_owner_name'=>$data['bank_account_owner'],
                ]);

        // create record for paypal form
        }elseif($type =='paypal') {
            $user->withdraw_request()->create([
                'amount'=>$data['amount'],
                'method'=>'paypal',
                'paypal_email'=>$data['paypal']
                ]);
        }
    }

    
}
