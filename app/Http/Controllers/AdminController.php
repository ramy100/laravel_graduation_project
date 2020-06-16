<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Chartisan\PHP\Chartisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
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
     * Display the document.
     *
     * @return \Illuminate\Http\Response
     */
    public function change_verification(Request $request,$role)
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_payment_chart_data()
    {

        $orders = Order::select('created_at','total')
        ->get()
        ->groupBy(function($item){ return $item->created_at->format('d'); })->map(function ($row) {
            return $row->sum('total');
        });
        $chart = Chartisan::build()
        ->labels($orders->keys()->toArray())
        ->dataset('Sample 1', $orders->values()->toArray())
        ->toJSON();
        return $chart;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view_payment_chart()
    {
        return view('dashboard.payment_chart');
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
