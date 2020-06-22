<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\Admin;
use Illuminate\Support\Str;

class AdminAuthController extends Controller
{
    use AuthenticatesUsers;

    public function logMeOut(Request $request)
    {
        auth()->guard('admin')->logout();
        $request->session()->invalidate();
        return redirect()->route('admin-login')->with(['success' => 'You are now out!']);
    }

    public function login(){
        return view('dashboard.login');
    }

    public function adminLogin(Request $request)
    {
        // dd('test');
        if (Admin::count() == 0) {
            Admin::create([
                'name' => 'admin',
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
        }

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => trans('theme.email_required'),
            'email.email' => trans('theme.email_email'),
            'password.required' => trans('theme.password_required'),
        ]);
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        } else {

            $remember = $request->remember ? true : false;
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
                // dd('success');
                return redirect()->intended(route('dashboard'))->with(['success' => trans('theme.login_complete')]);
            } else {
                $this->incrementLoginAttempts($request);
                // dd('failed');
                return back()->with(['error' => trans('Wrong email or password')])
                    ->withInput($request->except('password'));
            }
        }
    }



}
