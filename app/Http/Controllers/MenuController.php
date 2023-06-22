<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q;
        if ($q != '') {
            // 検索されたら検索結果を取得する
            $data = Menu::where('name', $q)->get();
        } else {
            // それ以外はすべてのメニューを取得する
            $data = Menu::all();
        }
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
