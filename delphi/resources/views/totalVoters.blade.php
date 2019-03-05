@extends('layouts.app')

@section('content')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


<div id="total-voters-page" class="container">
    <div class="row justify-content-center">
        <h1 id="delphi_code_header"> Welcome To Voter's Watch</h1>
    </div>
<hr style="border-top:15px solid;"/>

	<div class="row justify-content-center" style="font-size:30px;">
	    <span id="voted-students">0</span>/{{$group->students}} students have voted
    </div>		

	<div class="row justify-content-center" style="font-size:30px;">
    	<a href="/group/{{ $group->code }}/{{ $group->id }}">
    		<button type="button" class="btn btn-secondary">END VOTING</button>
		</a>
	</div>


</div>


<script>
	$(document).ready(function(){
		setInterval(studentAjax, 3000); //call ajax every 3 seconds
	});

	function studentAjax(){
		$.ajax({
			url: '/student-count-ajax',
			type: 'GET',
			data: {
				'listId': {{$group->id}}
			},
			dataType: 'json',
			success: function(data){
				console.log(data);
				$('#voted-students').html(data.students);
			},
			error: function(data){
				console.log('failed');
			}
		});

	}

</script>
@endsection

