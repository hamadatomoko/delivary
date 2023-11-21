@extends('layouts.app')
@section('title', 'リスト')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
              <form action="{{ route('order.confirm') }}" method="post">
                  @csrf
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">住所</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail3" placeholder="address" name="address" value="{{ $order->address}}" >
                  </div>
                </div>
                
                <label for="phone">電話番号:</label>
                
                <input type="tel" id="tel" name="tel" value="{{ $order->tel }}"
                       pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
                       required>
               
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="syouyu" value="0">お醤油が必要ですか？
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="hashi" value="0">お箸が必要ですか？
                    </label>
                </div>
                
                <!--<label for="appt">Choose a time for your meeting:</label>-->
                
                <input type="datetime-local" id="appt" name="appt"
                       min="{{$minTime}}" required>
                
                <small>Office hours are 9am to 6pm</small>
                
        <div class="row">
            <button type="submit" class="btn btn-primary">確認画面へ</button>
        </div>
              </form>
              
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function(){
	//入力したとき
	$("#appt").on("change", function(){
		//内容を取得
		let val = $(this).val();
		//整形
		let date = new Date(val);
		//曜日を取得 0=日 
		let week = date.getDay();
		console.log(date);
		//日曜日の時
		if(week == 0){
			//アラート
			alert("その日は選択できません｡");
			//inputを空に
			$(this).val("");
			return;
		}
		
		let hourlater = new Date();
		hourlater.setHours(hourlater.getHours() + 1);
		// 1時間後の条件。date nowの時間の差分が１以上の時
		
	/*	if(){
			//アラート
			alert("その時間は選択できません｡");
			//inputを空に
			$(this).val("");
			return;
		}*/

		let hour = date.getHours();
		// アラートを出す条件
        // 今より１時間後 AND ( (0 ~11時) OR (14 ~ 17) OR (21 ~) )
        // 11~14 17~21 !(11~14) and !(17~21)
        //(11 <= hour && hour <= 14) || (17 <= hour && hour <= 21)
        
		if(!((11 <= hour && hour < 14) || (17 <= hour && hour < 21))){
		    alert("その時間は選択できません｡");
			//inputを空に
			$(this).val("");
			return;
		}
	});
});
</script>



@endsection