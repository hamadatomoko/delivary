<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //  管理者がログインすると注文一覧の画面に遷移する
    protected $redirectTo = '/admin/order';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }
    public function showLoginForm()
    {
        return view('admin.login');  //変更
    }
 
    protected function guard()
    {
        return Auth::guard('admin');  //変更
    }
    
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();  //変更
        $request->session()->flush();
        $request->session()->regenerate();
 
        return redirect('/admin/login');  //変更
    }
}
