@extends('layouts.app')
@section('title', 'リスト')
@section('content')
<form>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-10 offset-sm-2">
      <button type="submit" class="btn btn-primary">Sign in</button>
    </div>
  </div>
</form>

<label for="phone">Enter your phone number:</label>

<input type="tel" id="phone" name="phone"
       pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
       required>

<small>Format: 123-456-7890</small>


<label for="appt">Choose a time for your meeting:</label>

<input type="datetime-local" id="appt" name="appt"
       min="09:00" max="18:00" required>

<small>Office hours are 9am to 6pm</small>
@endsection