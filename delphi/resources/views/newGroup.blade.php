@extends('layouts.app')

@section('content')
<div id="new-list-page" class="container">
	@if (!empty($errorMessage))
	<!-- ENTER INVALID CODE MESSAGES AS THE USER IS MALICOUS OR ENTERED THE WRONG CODE-->
    <div class="row justify-content-center">
        <h2 id="welcome-header">{{ $errorMessage }} {{ $code }}</h1>
    </div>
	<!-- ADD A FORM FOR ENTERING A NEW CODE MAYBE? -->
		
	@else

	<!-- ENTER FORM FOR ADDING A NEW LIST HERE-->

	<div class="row justify-content-center">
        <h2 id="welcome-header">Create a new list for the code: {{ $code }}</h1>
	</div>

		<div class="card">
			<div class="card-header">
				New List Form
			</div>
			<div class="card-body" style="horizontal-align:center">
 				<form class="form-horizontal" action="/user/{{ $code }}/create" method="POST" >
 					{{ csrf_field() }}	
					<input type="hidden" id="joinCode" name="joinCode" value="{{ $code }}">
  					<div class="form-group">
    					<label class="control-label col-sm-5" for="list_name">Name of List:</label>
    					<div class="col-sm-10">
      						<input type="text" class="form-control" name="name" id="listname" required placeholder="Name of List">
    					</div>
  					</div>
  					<div class="form-group">
    					<label class="control-label col-sm-5" for="max_student">Number of students for list:</label>
    					<div class="col-sm-10">
      						<input type="number" clazss="form-control" min="0" name="students" id="maxstudent" required placeholder="Number of students for list">
    					</div>
  					</div>


  					<div class="form-group">
    					<label class="control-label col-sm-5" for="active">Start Voting immediateltly after list creation?</label>
      						<input type="radio"  name="active" value="true" >Yes
      						<input type="radio" name="active" value="" checked="checked">No
  					</div>


  					<div class="inject-options">
	  					<div class="form-group">
	    					<label class="control-label col-sm-5" for="option_name">Option Name:</label>
	    					<div data-number="1" class="col-sm-10 option">
	      						<input type="text" class="form-control" name="option[1][name]" required placeholder="Option name">
	    					</div>
	  					</div>

	  					<div class="form-group">
	    					<label class="control-label col-sm-5" for="additional_info">Additional Info:</label>
	    					<div class="col-sm-10">
	      						<input type="text" class="form-control" required name="option[1][description]" placeholder="Additional info">
	    					</div>
	  					</div>
					</div>
  					<div class="form-group">
    					<div class="col-sm-offset-2 col-sm-10">
      						<button type="button" id="addoption" class="addOption btn btn-secondary">Add an Option</button>
    					</div>
  					</div>

  					<div class="form-group">
    					<div class="col-sm-offset-2 col-sm-10">
    						<form action="{{action('SessionController@createListWithOptions', $code)}}">
    							<input type="hidden" id="createGroup" name="createGroup" value="{{$code}}">
      							<button type="submit" class="btn btn-danger">Submit List</button>
      						</form>
    					</div>
  					</div>
				</form> 
			</div>
		</div>
    
	@endif

</div>


<script>
	$(document).ready(function(){
		$(".addOption").click(function(e){
			e.preventDefault();

			var nextOptionIndex = $('.option').last().data("number");

			nextOptionIndex++;


			var nextOption = "<div class='form-group'><label class='control-label col-sm-5' for='option_name'>Option Name:</label><div data-number='" + nextOptionIndex + "' class='option col-sm-10'><input type='text' class='form-control' required name='option["+ nextOptionIndex + "][name]'  placeholder='Option name'></div></div> <div class='form-group'><label class='control-label col-sm-5' for='additional_info'>Additional Info:</label><div class='col-sm-10'><input type='text' required class='form-control' name='option[" + nextOptionIndex + "][description]' placeholder='Additional info'></div></div>";
			console.log(nextOption);

			
			$(".inject-options").append(nextOption);
		});


	});

	
</script>	
@endsection