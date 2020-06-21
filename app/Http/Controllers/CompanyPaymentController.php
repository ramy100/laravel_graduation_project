<?php

namespace App\Http\Controllers;

use App\Design;
use App\Order;
use App\User;
use Cart;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Notifications\designerNotifications;

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

        // try changing in database record first
        try {
            $this->change_company_ids_for_designs($items_ids,$user->id,$total_amount_in_cents);

        } catch (\Throwable $th) {
            // if database fails to update rollback and stop transaction and return fail message
            DB::rollBack();
            return $this->create_order_record_with_message($user->id,$total_amount,'fail in database','payment failed','danger');
        }

        // try charging user
        try {
            $user->charge($total_amount_in_cents, $payment_method);
            $designs=Design::find($items_ids);
            foreach ($designs as $design) {
                $designer=$design->designer;
                $company_name=$design->company->name;
                $designer->notify(new designerNotifications($company_name,$design));
            }
        } catch (\Throwable $th) {
            // if payment fails rollback and return fail message
            DB::rollBack();
            return $this->create_order_record_with_message($user->id,$total_amount,'fail in paying','payment failed','danger');
        }


        // if payment succeed -> commit database changes and clear cart and return success message
        DB::commit();
        Cart::session($user->id)->clear();
        return response([
            'url'=> redirect()->route('website.result')->with(['status'=>'Payment Success','color'=>'success','designs'=>$designs])->getTargetUrl(),
        ]);
    }



    public function show_payment_form(Request $request)
    {
        $user = Auth::user();
        return view('cart.creditcard',[
            'intent' => $user->createSetupIntent()
        ]);
    }



    protected function change_company_ids_for_designs($designIds,$user_id,$priceInCents)
    {
        DB::beginTransaction();
        // success record in orders
        Order::create([
            'company_id'=> $user_id,
            'total' => $priceInCents/100,
            'state'=>'success',
            'payment_method'=>'credit_card',
        ]);
        // changing company ids for those designs
        foreach ($designIds as $design) {
            DB::table('designs')->where('id',$design)->update(['company_id'=>$user_id,'state'=>'sold']);
        }
    }

    protected function create_order_record_with_message($company_id,$totalPriceInDollars,$status,$message,$messsageColor)
    {
        // create faile record in database
        Order::create([
            'company_id'=> $company_id,
            'total' => $totalPriceInDollars,
            'state'=>$status,
            'payment_method'=>'credit_card',
        ]);
        // return fail message
        return response([
            'url'=> redirect()->route('website.cart')->with(['status'=>$message,'color'=>$messsageColor])->getTargetUrl(),
        ]);
    }
    
}
