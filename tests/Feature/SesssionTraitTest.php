<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use \Mockery;
use Illuminate\Session\NullSessionHandler;
use Illuminate\Session\Store;

class SesssionTraitTest extends TestCase
{
    use \App\Traits\SessionTrait;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    public function testExample()
    {
        $request = Mockery::mock(Request::class);
        $session_handler = new NullSessionHandler();
        $this->session = new Store('test', $session_handler);
        // テストデータとしリクエストインスタンスを用意し、セッションへ値を登録
        $items = ['address', 'tel', 'appt', 'memo', 'syouyu', 'hashi'];
        /*
        $request  = Mockery::mock("Request" . '/')
            ->shouldReceive('route')
            ->with('id')
            ->once()
            ->andReturn('1')
            ->getMock();
            */
        foreach ($items as $value) {
            $request->session()->put($value, 'test');
        }
        
        // セッションの削除関数を実行(テスト対象)
        $this->delete_session_data($request);
        
        // 結果を確認
        foreach ($items as $value) {
            $this->assertFalse($request->session()->has($value));
        }
    }
}
