<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Response;
use Illuminate\Auth\Events\Registered;
use App\Charts\LikesChart;
use App\Design;

class AdminController extends Controller
{
    public function likesChart(){
        $designsR = Design::orderBy('title')->pluck('total_likes','title');
        $designersR = User::where('role', '=', 'designer')->orderBy('name')->pluck('likes','name');

        $designsChart = new LikesChart;
        $designersChart = new LikesChart;

        $designsChart->labels($designsR->keys());
        $designsChart->dataset('Designs likes', 'bar', $designsR->values())
            ->backgroundColor('rgba(100,100,100,.5)');

        $designersChart->labels($designersR->keys());
        $designersChart->dataset('Designers likes', 'bar', $designersR->values());
        // dd($designsChart);
        return view('dashboard.designChart', compact('designsChart','designersChart'));
    }
}
