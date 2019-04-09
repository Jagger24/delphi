@extends('layouts.app')

@section('content')
<div id="user-dashboard" class="container">

  <div class="row justify-content-center" style="margin-bottom: 10px;">
    <h2> Edit Profile </h2>
  </div>

  <hr/>

  <div class="row justify-content-center" style="margin-bottom: 20px;">
    <form class="form-horizontal" role="form">
      <div class="form-group">
          <label class="col-md-18 control-label">Name:</label>
          <div class="col-md-18">
            <input class="form-control" type="text" value="{{ $user->name }}">
          </div>
      </div>
      <div class="form-group">
          <label class="col-md-18 control-label">Email:</label>
          <div class="col-md-18">
            <input class="form-control" type="text" value="{{ $user->email }}">
          </div>
      </div>
      <div class="form-group">
          <label class="col-md-18 control-label">Password:</label>
          <div class="col-md-18">
            <input class="form-control" type="password" value="">
          </div>
      </div>
      <div class="form-group">
          <label class="col-md-18 control-label">Confirm Password:</label>
          <div class="col-md-18">
            <input class="form-control" type="password" value="">
          </div>
      </div>
    </form>
  </div>

  <hr/>

  <div class="row justify-content-center" style="margin-bottom: 30px;">
    @if($user)
      <!-- Edit Account Submit Button -->
      <a href="user/{{ $user->id}}/editUserAccount" data-method="" data-token="{{csrf_token()}}" data-confirm="Are you sure you want edit your account?"><button class="btn btn-primary" value="Edit Account" type="submit">Edit Account</button>
      &nbsp;
      <!-- Delete Account Submit Button --> 
      <a href="user/{{ $user->id}}/deleteUserAccount" data-method="delete" data-token="{{csrf_token()}}" data-confirm="Are you sure you want delete your account?"><button class="btn btn-danger" value="Delete Account" type="submit">Delete Account</button>
    @endif
  </div>
</div>
@endsection
