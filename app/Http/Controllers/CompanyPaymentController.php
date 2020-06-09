<?php

namespace App\Http\Controllers;

use App\Design;
use App\User;
use Cart;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CompanyPaymentController extends Controller
{
    public function __construct(Request $request){
        $this->middleware('auth');
        $this->middleware('check-role:company');
    }
    public function credit_card_checkout(Request $request)
    {
        $user=Auth::user();
        $payment_method=$request->payment_method;
        $items = Cart::session($user->id)->getContent();
        $total_amount = $items->sum('price');
        $items_ids = $items->keys();
        $total_amount_in_cents=$total_amount*100;
        $this->change_company_ids_for_designs($items_ids,$user->id);
        $this->charge_user($user,$total_amount_in_cents,$payment_method);
        // if payment succeed -> commit database changes and clear cart and return success message
        DB::commit();
        Cart::session($user->id)->clear();
        return response([
            'url'=> redirect()->route('website.cart')->with(['status'=>'Payment Success','color'=>'success'])->getTargetUrl(),
        ]);
    }
    protected function change_company_ids_for_designs($designIds,$user_id)
    {
        DB::beginTransaction();
        try {
            // changing company ids for those designs
            foreach ($designIds as $design) {
                DB::table('designs')->where('id',$design)->update(['company_id'=>$user_id,'state'=>'sold']);
            }
        } catch (\Throwable $th) {
            // if database fails to update rollback and stop transaction and return fail message
            DB::rollBack();
            return response([
                'url'=> redirect()->route('website.cart')->with(['status'=>'Payment Failed','color'=>'danger'])->getTargetUrl(),
            ]);
        }
    }
    protected function charge_user(User $user , float $priceInCents,$paymenMethod)
    {
        try {
            // charging customer
            $user->charge($priceInCents, $paymenMethod);
        } catch (Exception $e) {
            // if payment fails rollback and return fail
            DB::rollBack();
            return response([
                'url'=> redirect()->route('website.cart')->with(['status'=>'Payment Failed','color'=>'danger'])->getTargetUrl(),
            ]);
        }
    }
}
