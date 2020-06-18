<?php

namespace App\Http\Controllers;

use App\Charts\PaymentChart;
use App\Design;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use App\Charts\LikesChart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function likesChart(){
        $designsR = Design::orderBy('title')->pluck('total_likes','title');
        $designersR = User::where('role', '=', 'designer')->orderBy('name')->pluck('likes','name');

        $designsChart = new LikesChart;
        $designersChart = new LikesChart;

        $designsChart->labels($designsR->keys());
        $designsChart->dataset('Designs likes', 'bar', $designsR->values())
            ->backgroundColor('#89CFF0');

        $designersChart->labels($designersR->keys());
        $designersChart->dataset('Designers likes', 'bar', $designersR->values())
            ->backgroundColor('#b76e79');
        // dd($designsChart);
        return view('dashboard.designChart', compact('designsChart','designersChart'));
    }

    /**
     * Display a listing of the Users.
     *
     * @return \Illuminate\Http\Response
     */
    public function list_users($role,$state)
    {
        $pending_users=DB::table('users')->join('profiles','users.id','=','profiles.user_id')
        ->where('role','=',$role)
        ->where('is_verified','=',$state)
        ->select('users.id','name','email','website','image')->paginate(5);
        return view('dashboard.verify_users',compact('pending_users','role','state'));
    }

    /**
     * Display a listing of the Users.
     *
     * @return \Illuminate\Http\Response
     */
    public function mark_as_read()
    {
        Auth::guard('admin')->user()->unreadNotifications->markAsRead();
    }

    /**
     * Display a listing of the Designs.
     *
     * @return \Illuminate\Http\Response
     */
    public function list_designs($state)
    {
        $designs=Design::where('is_verified','=',$state)->paginate(5);
        return view('dashboard.verify_designs',compact('designs','state'));
    }
    /**
     * Display the document.
     *
     * @return \Illuminate\Http\Response
     */
    public function view_user_document(Request $request,User $user)
    {
        if($user->role === 'user'){
            abort(403,'Not a company or a designer');
        }
        return response()->file(public_path().'/storage/'.$user->profile->document);
    }

    /**
     * Display the Design document.
     *
     * @return \Illuminate\Http\Response
     */
    public function view_design_document(Request $request,Design $design)
    {
        return response()->file(public_path().'/storage/'.$design->source_file);
    }

    /**
     * Display the document.
     *
     * @return \Illuminate\Http\Response
     */
    public function change_user_verification(Request $request,$role)
    {
        
        try {
            $user = User::find($request->user_id);
            $user->profile->update(['is_verified'=>$request->status]);
        } catch (\Throwable $th) {
            return response('failed to change status',500);
        }
        return response($request->status ." ". $user->name ,200);

    }

    /**
     * Display the document.
     *
     * @return \Illuminate\Http\Response
     */
    public function change_Design_verification(Request $request)
    {
        try {
            Design::where('id','=',$request->design_id)->update(['is_verified'=>$request->status]);
        } catch (\Throwable $th) {
            return response('failed to change status',500);
        }
        return response($request->status ,200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Show the Payment Chart.
     *
     * @return \Illuminate\Http\Response
     */
    public function view_payment_chart()
    {
        $orders = Order::select('created_at','total')
        ->get()
        ->groupBy(function($item){ return $item->created_at->format('d/M/Y'); })->map(function ($row) {
            return $row->sum('total');
        });
        $chart = new PaymentChart;
        $chart->labels($orders->keys());
        $chart->dataset('daily Profit','line',$orders->values());
        return view('dashboard.payment_chart',compact('chart'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
