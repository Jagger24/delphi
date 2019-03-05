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
        <h1 id="delphi_code_header"> @if ($message == 1) Success! Please wait while voting is in process @elseif ($message == 2) List is currently inactive @endif </h1>

    </div>
<hr style="border-top:15px solid;"/>
    <div class="row justify-content-center">
        <h1 id="delphi_code_header">  @if ($message == 1) When the Voting is complete please click below:@elseif ($message == 2) Click below to see the stats of the voting @endif </h1>
    </div>
<div class="row justify-content-center">
    <a href="/group/{{$group->code}}/{{$group->id}}">
    	<button id="stat-check" type="button" @if($message == 1) disabled @endif>SEE STATS </button>
	</a>
</div>

<script>
	$(document).ready(function(){
		setInterval(studentAjax, 3000); //call ajax every 3 seconds
	});

	function studentAjax(){
		$.ajax({
			url: '/stat-check',
			type: 'GET',
			data: {
				'listId': {{$group->id}}
			},
			dataType: 'json',
			success: function(data){
				console.log(data);
				if(data.complete){
					$('#voted-students').removeAttr('disabled');
				}
			},
			error: function(){
				console.log('failed');
			}
		});

	}

</script>
@endsection