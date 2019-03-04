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
			<div class="card-body">
 				<form class="form-horizontal" action="/action_page.php">
  					<div class="form-group">
    					<label class="control-label col-sm-5" for="list_name">Name of List:</label>
    					<div class="col-sm-10">
      						<input type="text" class="form-control" id="listname" placeholder="Name of List">
    					</div>
  					</div>
  					<div class="form-group">
    					<label class="control-label col-sm-5" for="max_student">Number of students for list:</label>
    					<div class="col-sm-10">
      						<input type="text" class="form-control" id="maxstudent" placeholder="Number of students for list">
    					</div>
  					</div>

  					<div class="form-group">
    					<label class="control-label col-sm-5" for="option_name">Option Name:</label>
    					<div class="col-sm-10">
      						<input type="text" class="form-control" id="optionname" placeholder="Option name">
    					</div>
  					</div>

  					<div class="form-group">
    					<label class="control-label col-sm-5" for="additional_info">Additional Info:</label>
    					<div class="col-sm-10">
      						<input type="text" class="form-control" id="additionalinfo" placeholder="Additional info">
    					</div>
  					</div>

  					<div class="form-group">
    					<div class="col-sm-offset-2 col-sm-10">
      						<button type="submit" id="addoption" class="btn btn-secondary">Add an Option</button>
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

		<form action="/user/{{ $code }}/create" id="new-list-form" method="POST">
			{{ csrf_field() }}	
			<input type="hidden" id="joinCode" name="joinCode" value="{{ $code }}">

				<div class="row">
					<label for="name">Name of list: </label> 
					<input name="name" type="text" required> 
				</div>

				<div class="row">
					<label for="students">Number of Students for List: </label> 
					<input name="students" type="Number" min="0"> 
				</div>

				<div class="row">
					<label for="active">Start voting after creation?</label>
					<input class="radio" type="radio" name="active" value="true">Yes
					<input class="radio" type="radio" name="active" value="false" checked="checked">No
				</div>

				<p> Add options for your list here! </p>
				<div class="inject-options">
					<div class="option" data-number="1">
						<label for="option[1][name]">Option Name:</label>
						<input type="text" name="option[1][name]">
						<label for="option[1][description]">Additional Info:</label>
						<input type="textarea" name="option[1][description]">
					</div>


				</div>
				<button type="button" class="addOption btn btn-secondary"> Add an Option </button> 

			<div class="row ">
					<input type="submit" class="btn btn-primary" value="Submit Code">
			</div>
		</form>
    
	@endif

</div>


<script>
	$(document).ready(function(){
		$(".addOption").click(function(e){
			e.preventDefault();

			var nextOptionIndex = $('.option').last().data("number");
			nextOptionIndex++;


			console.log(nextOptionIndex);
			var nextOption = "<div class='option' data-number=" + nextOptionIndex + "> <label for='option[" + nextOptionIndex + "][name]'>Option Name: </label> <input type='text' name='option[" + nextOptionIndex + "][name]'><label for='option["+nextOptionIndex+"][description]'>Additional Info: </label> <input type='text' name='option[" + nextOptionIndex + "][description]'></div>";
			console.log(nextOption);
			$(".inject-options").append(nextOption);
		});


	});

	
</script>	
@endsection