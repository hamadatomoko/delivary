<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Menu;
use App\Category;

class MenuController extends Controller
{
    public function index()
    {
        $data = Menu::all()->sortBy('name');
        return view('admin.menu.index', compact('data'));
    }
    
    public function add()
    {
        $cate = Category::all()->sortBy('name');
        return view('admin.menu.create', compact('cate'));
    }
  
    public function create(Request $request)
    {
    
        // 以下を追記
        // Varidationを行う
        $this->validate($request, Menu::$rules);

        $menu = new Menu;
        $form = $request->all();
        // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            $menu->picture = basename($path);
        } else {
            $menu->picture = null;
        }
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // フォームから送信されてきたimageを削除する
        unset($form['image']);
        // データベースに保存する
        $menu->fill($form);
        $menu->save();
        return redirect('admin/menu/create');
    }
    
    
    public function edit(Request $request)
    {
        $cate = Category::all()->sortBy('name');
        $menu = Menu::find($request->id);
        return view('admin.menu.edit', compact('cate', 'menu'));
    }
  
    public function update(Request $request)
    {
    
        // 以下を追記
        // Varidationを行う
        $this->validate($request, Menu::$rules);

        $menu = new Menu;
        $form = $request->all();
        // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            $menu->picture = basename($path);
        } else {
            $menu->picture = null;
        }
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // フォームから送信されてきたimageを削除する
        unset($form['image']);
        // データベースに保存する
        $menu->fill($form);
        $menu->save();
        return redirect('admin/menu/create');
    }
}
