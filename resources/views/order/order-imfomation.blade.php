@extends('layouts.app')
@section('title', 'リスト')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
              <form action="{{ route('order.confirm') }}" method="post">
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">住所</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmail3" placeholder="address">
                  </div>
                </div>
                
                <label for="phone">電話番号:</label>
                
                <input type="tel" id="tel" name="tel"
                       pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
                       required>
                
                <small>Format: 123-456-7890</small>
                
                
                <!--<label for="appt">Choose a time for your meeting:</label>-->
                
                <input type="datetime-local" id="appt" name="appt"
                       min="09:00" max="18:00" required>
                
                <small>Office hours are 9am to 6pm</small>
              </form>
              
            </div>
        </div>
    </div>



@endsection