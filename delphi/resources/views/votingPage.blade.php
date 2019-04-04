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
    	@if($group->prioritization)
        	<h1 id="delphi_code_header"> Welcome To Voting Prioritization Method</h1>
        	<h1> Enter a range for each option 1 being HIGHEST priority 3 being LOWEST priority </h1>
        @else
        	<h1 id="delphi_code_header"> Welcome To Voting Elimination Method</h1>
        	<h1> You have {{$votingCount}} to vote with, you may assign them however you like and some results may be left empty. </h1>
        @endif
    </div>

@if($group->prioritization)
    <form action="/group/{{$group->code}}/{{$group->id}}/voting"  method="POST">
    	{{ csrf_field() }}
    	@foreach($options as $option)
			<div class="card">
				<div class="card-header">
					Option Name: {{ $option->name }}
				</div>
				<div class="card-body" style="horizontal-align:center">
						<p>{{$option->description}}</p>

						<label for="{{$option->id}}">Prioritize (1-3) 
						<input type="number" name="{{$option->id}}" min="1" max="3" value="3">

				</div>

			</div>
    	@endforeach


    	<button type="submit" class="btn btn-primary">Submit Vote</button>

    </form>
@else

	<div ><h1 id="points" data-pointsLeft="{{$votingCount}}">Points Left: {{$votingCount}}</h1></div>


    <form action="/group/{{$group->code}}/{{$group->id}}/voting"  method="POST">
    	{{ csrf_field() }}
    	@foreach($options as $option)
			<div class="card">
				<div class="card-header">
					Option Name: {{ $option->name }}
				</div>
				<div class="card-body" style="horizontal-align:center">
						<p>{{$option->description}}</p>

						<label for="{{$option->id}}">Enter Number of Points
						<input type="number" name="{{$option->id}}" min="0" max="{{$votingCount}}" value=0>

				</div>

			</div>
    	@endforeach

    	<div><h1 id="explanation"> PLEASE ONLY USE ALL YOUR VOTING POINTS, BUT MAKE SURE TO NOT USE MORE THAN YOU HAVE</h1></div>
    	<button id="btn-disabled" type="submit" disabled="true" class="btn btn-primary">Submit Vote</button>

    </form>


    <script>
	$('input').change(function(){
		var sum = 0;
		$('input[type="number"]').each(function(){
			sum += Number($(this).val());
			console.log(sum);
		});
		var points_left = {{$votingCount}} - sum;
		$('#points').data('pointsLeft', points_left );
		$('#points').html("Points Left: " + points_left);

		if(points_left == 0){
			$('#btn-disabled').removeAttr("disabled");
			$('#explanation').hide();
		}else{
			$('#btn-disabled').attr("disabled", true);
			$('#explanation').show();
		}

	});
	

	

</script>


@endif
    
@endsection