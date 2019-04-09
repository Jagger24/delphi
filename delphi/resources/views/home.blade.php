@extends('layouts.app')

@section('content')
<div id="user-dashboard" class="container">
    <!-- Welcome messag to user -->
    <div class="row justify-content-center">
        <h2 id="welcome-header">Welcome back, <?= Auth::user()->name ?> </h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a new Delphi List </div>

                <div class="card-body">
                    <form action="{{ route('sessionStore') }}" method="POST">
                        {{ csrf_field() }}

                        <input type="hidden" id="userId" name="userId" value="<?= Auth::user()->id; ?>">

                        <label for="joinCode">Join Code:</label>
                        <input name="joinCode" type="text" pattern=".{5,10}" required title="5 to 10 characters">

                        <input type="submit" class="btn btn-primary" value="Submit Code">
                        @if (!empty($errorMessage))
                            <p class="error-message"> @if($errorMessage == '1') Code Already exists! Please try another code @else Something went wrong please try again @endif</p>

                        @endif          
                    </form> 
                </div>
            </div>
        </div>
    </div>

    <!-- Delphi Codes Table -->
    <div class="row justify-content-center">
        <h4 id="delphi_code_header"> Your Delphi Codes </h4>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table table-hover table-bordered text-center">
                <thead class="table-dark"> 
                    <th> # </th>
                    <th> Delphi Code </th>
                    <th> List Name </th>
                    <th> Create/View List </th>
                    <th> Active </th>
                    <th> Delete </th>
                </thead>
                <tbody>
                @if($infoArray)
                    @foreach($infoArray as $sessioned)
                        <tr>
                            <td> {{$sessioned['id']}} </td>
                            <td> {{$sessioned['code']}} </td>
                            <td></td>
                            <td> <a href="user/{{ $sessioned['code'] }}/create"><button class="btn btn-primary" value="Create List">Create List</button> </td>
                            <td></td>
                            <td><a href="user/{{ $sessioned['code'] }}/delete" data-method="delete" data-token="{{csrf_token()}}" data-confirm="Are you sure?"><button class="btn btn-danger" value="Delete Code">Delete Code</button></td>
                        </tr>
                    @if (array_key_exists("groups", $sessioned))
                        @foreach($sessioned['groups'] as $group)
                            <tr>
                                <td> </td>
                                <td> {{$sessioned['code']}} </td>
                                <td>{{$group['name']}}</td>
                                <td> <a href="user/{{ $sessioned['code'] }}/{{$group['id']}}/view"><button class="btn btn-danger" value="Create List">View List</button></td>
                                <td> @if($group['active'] == 0) Not Active @else Active @endif</td>
                                <td> <a href="user/{{ $sessioned['code'] }}/{{$group['id']}}/delete" data-method="delete" data-token="{{csrf_token()}}" data-confirm="Are you sure?"><button class="btn btn-danger" value="Delete Code">Delete List</button></td>
                            </tr>

                        @endforeach
                    @endif
                    @endforeach 
                @endif    
            </table>
        </div>
    </div>
</div>


 
<script>

    //this script is to allow the functionality of a delete method with confirmations easily
(function() {
 
  var laravel = {
    initialize: function() {
      this.methodLinks = $('a[data-method]');
      this.token = $('a[data-token]');
      this.registerEvents();
    },
 
    registerEvents: function() {
      this.methodLinks.on('click', this.handleMethod);
    },
 
    handleMethod: function(e) {
      var link = $(this);
      var httpMethod = link.data('method').toUpperCase();
      var form;
 
      // If the data-method attribute is not PUT or DELETE,
      // then we don't know what to do. Just ignore.
      if ( $.inArray(httpMethod, ['PUT', 'DELETE']) === - 1 ) {
        return;
      }
 
      // Allow user to optionally provide data-confirm="Are you sure?"
      if ( link.data('confirm') ) {
        if ( ! laravel.verifyConfirm(link) ) {
          return false;
        }
      }
 
      form = laravel.createForm(link);
      form.submit();
 
      e.preventDefault();
    },
 
    verifyConfirm: function(link) {
      return confirm(link.data('confirm'));
    },
 
    createForm: function(link) {
      var form = 
      $('<form>', {
        'method': 'POST',
        'action': link.attr('href')
      });
 
      var token = 
      $('<input>', {
        'type': 'hidden',
        'name': '_token',
        'value': link.data('token')
        });
 
      var hiddenInput =
      $('<input>', {
        'name': '_method',
        'type': 'hidden',
        'value': link.data('method')
      });
 
      return form.append(token, hiddenInput)
                 .appendTo('body');
    }
  };
 
  laravel.initialize();
 
})();
</script>
@endsection

