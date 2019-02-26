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