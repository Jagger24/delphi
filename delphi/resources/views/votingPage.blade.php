@extends('layouts.app')

@section('content')


<style>
	div.card{
		margin-bottom:2rem;
		font-size:2rem;
	}
	div.card-body{
	font-size:1.5rem;
	}
	button.btn-primary{
		font-size:20px;
	}
</style>
<div id="voting-page" class="container">
    <div class="row justify-content-center">
        <h1 id="delphi_code_header"> Welcome to List View </h1>

    </div>
<hr style="border-top:15px solid;"/>
    <div class="row justify-content-center">
        <h1 id="delphi_code_header"> Welcome To Voting Prioritization Method</h1>
        <h1> Enter a range for each option 1 being HIGHEST priority 3 being LOWEST priority </h1>
    </div>


    <form action="/group/{{$group->code}}/{{$group->id}}/voting"  method="POST">
    	{{ csrf_field() }}
    	@foreach($options as $option)
			<div class="card">
				<div class="card-header">
					Option Name: {{ $option->name }}
				</div>
				<div class="card-body" style="horizontal-align:center">
						<p>{{$option->description}}</p>
						<!-- ADD FORM INPUT HERE FOR 1-3 -->

						<label for="{{$option->id}}">Prioritize (1-3) 
						<input type="number" name="{{$option->id}}" min="1" max="3" value="3">

				</div>

			</div>
    	@endforeach


    	<button type="submit" class="btn btn-primary">Submit Vote</button>

    </form>

    
@endsection