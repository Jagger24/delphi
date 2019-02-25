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
        <h2 id="welcome-header">Please fill out the below Information to create a new list</h1>

		<form action="{{ route('newList') }}" method="POST">

		</form>
    </div>
	@endif

</div>


<script>
	$(document).ready(function(){
		console.log("test");
	});
</script>	
@endsection