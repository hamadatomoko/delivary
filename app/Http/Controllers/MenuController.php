<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $data = Menu::all();
        //dd($posts);
        
        //取得したデータを画面へ渡す
        return view('menu.index', ['data' => $data]);
    }
    public function detail(Request $request)
    {
        return view('menu.detail', ["menu" => Menu::find($request->id)]);
    }
    public function search(Request $request)
    {
        // admin/news/createにリダイレクトする
        return redirect('menu/create');
    }
}
