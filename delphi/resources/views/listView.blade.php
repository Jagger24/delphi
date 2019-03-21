@extends('layouts.app')

@section('content')
<div id="list-view-page" class="container">
    <div class="row justify-content-center">
        <h1 id="delphi_code_header"> Welcome to List View </h1>

    </div>
<hr style="border-top:15px solid;"/>
    <div class="row justify-content-center">
        <h1 id="delphi_code_header"> Activate this List for Voting </h1>
    </div>
<div class="card">
			<div class="card-header">
				New List Form
			</div>
			<div class="card-body" style="horizontal-align:center">
 				<form class="form-horizontal" action="/user/{{$code}}/{{$id}}/view" method="POST" >
 					{{ csrf_field() }}	

  					<div class="form-group">
    					<div class="col-sm-10">
    						<label class="control-label" for="max_student">Number of students for list:</label>
      						<input type="number" class="form-control" min="0" name="students" id="maxstudent" required placeholder="Number of students for list">
    					</div>
  					</div>

  					<div class="form-group">
    					<div class="col-sm-10">
    						<label class="control-label col-sm-5">Activate List</label>
      						<button type="submit" class="btn btn-danger">Activate List</button>
    					</div>
  					</div>

				</form> 
			</div>
		</div>
<hr />

    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table table-hover table-bordered text-center">
                <thead class="table-dark"> 
                    <th> # </th>
                    <th> Option Name </th>
                    <th> Option Description </th>
                    <th> Delete Option </th>
                </thead>
                <tbody>
                    @foreach($options as $key => $option)
       
                        <tr>
                            <td> {{$key + 1}} </td>
                            <td> {{$option['name']}} </td>
                            <td>{{$option['description']}}</td>
                            <td><a href="/{{ $code }}/{{ $id }}/{{ $option['id'] }}/deleteOption"  data-method="delete" data-token="{{csrf_token()}}" data-confirm="Are you sure?"><button class="btn btn-danger" value="Delete Option">Delete Option</button></td>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <button type="submit" class="btn btn-primary">Add Options to list.</button>
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
