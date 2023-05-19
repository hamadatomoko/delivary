<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $data = User::all()->sortBy('name');
        return view('admin.user.index', compact('data'));
    }
    
    public function create(Request $request)
    {
        $this->validate($request, User::$rules);

        $user = new User;
        $form = $request->all();
        
        $user->fill($form);
        $user->save();
        return redirect('admin//');
    }
    public function edit(Request $request)
    {
        // News Modelからデータを取得する
        $user = User::find(Auth::id());
        if (empty($user)) {
            abort(404);
        }
        return view('admin.user.edit', ['user_form' => $user]);
    }


    public function update(Request $request)
    {
        // Validationをかける
        $this->validate($request, User::$rules);
        // News Modelからデータを取得する
        $user = User::find(Auth::id());
        // 送信されてきたフォームデータを格納する
        $user_form = $request->all();
        unset($user_form['_token']);

        // 該当するデータを上書きして保存する
        $user->fill($user_form)->save();

        return redirect('admin/');
    }
    public function detail(Request $request)
    {
        dd(User::find($request->id));
        return view("admin.user.detail", ["user" => User::find($request->id)]);
    }
}
