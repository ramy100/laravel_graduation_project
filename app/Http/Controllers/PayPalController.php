<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;
use Cart;
use App\Order;
use App\SubOrder;
use Illuminate\Support\Facades\DB;
class PayPalController extends Controller
{

    protected $provider;

    public function __construct(){
        $this->provider = new ExpressCheckout;
    }

    public function getExpressCheckout(){
        $cart = $this->getCheckoutData();
        // dd($cart);
        try {
            $response = $this->provider->setExpressCheckout($cart);
            // dd($response);
            return redirect($response['paypal_link']);
        } catch (\Exception $e) {
            $invoice = $this->makeOrder('Invalid');
            session()->put(['code' => 'danger', 'message' => "Error processing PayPal payment for Order!"]);
        }        
    }

    protected function getCheckoutData(){
        $data = [];

        $items = array_map(function($item) {
            return [
                'name'=> $item['name'],
                'price'=> $item['price'],
                'quantity' => $item['quantity']
            ];
        }, Cart::session(auth()->id())->getContent()->toarray());

        $data['items'] = $items;
        $data['return_url'] = route('paypal.success');
        $data['cancel_url'] = route("paypal.cancel");
        $data['invoice_id'] = uniqid();
        $data['invoice_description'] = "Order Description";
        $data['total'] = Cart::session(auth()->id())->getTotal();

        return $data;
    }

    public function getExpressCheckoutCancel(){
        return back()->with('error','Your transaction has been canelled');
    }

    public function getExpressCheckoutSuccess(Request $request)
    {
        $token = $request->get('token');
        $PayerID = $request->get('PayerID');
        $cart = $this->getCheckoutData();

        // Verify Express Checkout Token
        $response = $this->provider->getExpressCheckoutDetails($token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            $payment_status = $this->provider->doExpressCheckoutPayment($cart, $token, $PayerID);
            $status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];
        }
        $check = $this->makeOrder($status);
        Cart::clear();
        return redirect('/cart')->with('message', 'success transaction');
    }

    public function makeOrder($status){

        $cart = Cart::session(auth()->id())->getContent();
        $designs_ids = $cart->keys();
        
        DB::beginTransaction();
        $order = new Order();
        $order->company_id = auth()->user()->id;
        $order->total = Cart::session(auth()->user()->id)->getTotal();
        $order->payment_method = 'paypal';
        if (!strcasecmp($status, 'Completed') || !strcasecmp($status, 'Processed')) {
            $order->state = 'success';
        } else {
            $order->state = 'failed';
        }
        $order->save();

        foreach(Cart::session(auth()->id())->getContent() as $item){
            $subOrder = new SubOrder();
            $subOrder->order_id = $order->id;
            $subOrder->design_id = $item->id;
            $subOrder->price = $item->price;
            $subOrder->save();
        }
        foreach ($designs_ids as $design) {
            DB::table('designs')->where('id',$design)->update(['company_id'=>auth()->user()->id,'state'=>'sold']);
        }
        DB::commit();
        return 0;
    }
}
