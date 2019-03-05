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
        <h1 id="delphi_code_header"> @if ($message == 1) Success! Please wait.. You will be redirected when voting is complete @elseif ($message == 2) List is currently inactive ... Redirecting to stats page @endif </h1>

    </div>
<hr style="border-top:15px solid;"/>





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
					window.location.replace("http://localhost:8000/group/{{$group->code}}/{{$group->id}}")
				}
			},
			error: function(){
				console.log('failed');
			}
		});

	}

</script>
@endsection