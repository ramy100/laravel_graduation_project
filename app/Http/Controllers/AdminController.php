<?php

namespace App\Http\Controllers;

use App\Charts\PaymentChart;
use App\Design;
use App\Order;
use App\User;
use App\Admin;
use App\DesignerRate;
use App\DesignVote;
use Illuminate\Http\Request;
use App\Charts\LikesChart;
use App\Charts\PieChart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Notifications\UserNotifications;
use App\WithdrawRequest;
use Illuminate\Pagination\Paginator;

class AdminController extends Controller
{
    public function list(){
        $yearTotal = Order::whereYear('created_at', '=', now()->year)
              ->pluck('total');
        $monthTotal = Order::whereMonth('created_at', '=', now()->month)
            ->pluck('total');
        // dd(($monthTotal->sum()) * 0.2);  
        $yearAvg = ($yearTotal->sum()) * 0.2;
        $monthAvg = ($monthTotal->sum()) * 0.2;

        $usersCount = User::all()->count();

        $designerCount = User::where('role', '=', 'designer')->count();
        $companyCount = User::where('role', '=', 'company')->count();
        $userCount = User::where('role', '=', 'user')->count();


        $orders = Order::select('created_at','total')
        ->get()
        ->groupBy(function($item){ return $item->created_at->format('d/M/Y'); })->map(function ($row) {
            return $row->sum('total');
        });

        $chart = new PaymentChart;
        $chart->labels($orders->keys());
        $chart->dataset('daily Profit','line',$orders->values())
            ->backgroundColor('#e74a3b');
        
        $pieChart = new PieChart;
        $pieChart->labels(['Users', 'Companies', 'Designers']);
        $pieChart->dataset('system users','bar', [$userCount, $companyCount, $designerCount])
        ->backgroundColor(collect(['#4e73df','#1cc88a', '#36b9cc']));
        
        return view('dashboard.index',compact('monthAvg', 'yearAvg', 'usersCount', 'chart', 'pieChart'));
    }

    public function listDesigners(){
        $designers = User::where('role', '=', 'designer')->get();
        return view('dashboard.designers.index', compact('designers'));

    }
    public function designerChart($id){
        $designerR = DesignerRate::selectRaw("COUNT(*) designer_rates, DATE_FORMAT(created_at, '%Y %m %e') date")
        ->where('designer_id', '=', $id)
        ->groupBy('date')
        ->pluck('designer_rates', 'date');
        
        $designerChart = new LikesChart;
        $designerChart->labels($designerR->keys());
        $designerChart->dataset('Designers likes', 'bar', $designerR->values())
            ->backgroundColor('#89CFF0');
        
        return view('dashboard.designers.chart', compact('designerChart'));
    }

    public function listDesigns(){
        $designs = Design::All();
        return view('dashboard.designs.index', compact('designs'));

    }
    public function designChart($id){
        $designR = DesignVote::selectRaw("COUNT(*) designer_rates, DATE_FORMAT(created_at, '%Y %m %e') date")
        ->where('design_id', '=', $id)
        ->groupBy('date')
        ->pluck('designer_rates', 'date');
        
        $designChart = new LikesChart;
        $designChart->labels($designR->keys());
        $designChart->dataset('Designers likes', 'bar', $designR->values())
            ->backgroundColor('#89CFF0');
        
        return view('dashboard.designs.chart', compact('designChart'));
    }
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
        $validator = \Validator::make($request->all(), [
            'reciever' => 'required',
            'Subject' => 'required',
            'Message' => 'required',
        ]);
        
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        $email=$request->reciever;
        $subject=$request->Subject;
        $message=$request->Message;
        $id=$request->design_id;
        $design=Design::find($id);
        try {
            Design::where('id','=',$request->design_id)->update(['is_verified'=>$request->status]);
            \Mail::to($email)->send(new \App\Mail\designConfirmation(['message' => $message,'subject' =>$subject,'design' => $design,'status' =>$request->status]));
            $design = Design::find($request->design_id);
            $designer=$design->designer;
                $designrates = DesignerRate::where('designer_id',$designer->id)->get();
                foreach($designrates as $designrate)
                {
                    $user = User::find($designrate->liker_id);
                    if($user->count() > 0)
                    {
                        if($designer->id != $user->id)
                        {            
                            $user->notify(new UserNotifications($design,$designer));
                        }                   
                    } 
                }
        } catch (\Throwable $th) {
            return response('failed to change status',500);
        }
        return response($request->status ,200);

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
        $chart->dataset('daily Profit','bar',$orders->values())
            ->backgroundColor('#b76e79');
        return view('dashboard.payment_chart',compact('chart'));
    }

    
    public function listWithdrawRequests(Request $request,$state='pending')
    {
        if(array_key_exists('state',$request->input())){
            $state=$request->input('state');
        };
        $withdraw_requests=WithdrawRequest::where('state','=',$state)->paginate(5);
        return view('dashboard.balance.index',compact('withdraw_requests','state'));
    }


    public function withdraws_filter(Request $request)
    {
        $currentPage = 1;
        Paginator::currentPageResolver(function () use ($currentPage) {
        return $currentPage;
        });
        $withdraw_requests=WithdrawRequest::where('state','=',$request->state)->paginate(5);
        $state=$request->state;
        return view('dashboard.balance.tables',compact('withdraw_requests','state'));
    }

    public function change_withdraw_state(Request $request)
    {
       $request_id = $request->withdraw_request_id;
       $withdraw_request = WithdrawRequest::find($request_id);
       $amount= floatval($withdraw_request->amount);
       $withdraw_request->update(['state'=>$request->state]);
       if($withdraw_request->wasChanged()){
        if($request->state === 'Complete'){
            $withdraw_request->user->balance()->decrement('balance',$amount);
        }
        return response('updated',200);
       }
       return response('failed',500);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::all();
        return view('dashboard.admins.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admin = new Admin();
        return view('dashboard.admins.create', compact('admin'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
        ]);
        $data['password'] = bcrypt($request->password);
        $admin = Admin::create($data);
            return redirect('admin/admin')->with('message','a new admin has been added ');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
        
    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect('admin/admin')->with('deleted','admin has been deleted successfully ');
    }
}
