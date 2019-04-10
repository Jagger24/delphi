@extends('layouts.app')

@section('content')

	<div class="row justify-content-center" style="margin-bottom: 50px;">
		<h2> Your Delphi Codes Statistics </h2>
	</div>

	<div class="row justify-content-center"> 
		@if($infoArray)
			@foreach($infoArray as $sessioned)
				<div class="card" style="width: 18rem;">
					<div class="card-body">
						<h5 class="card-title"> <b> Delphi Code: </b> {{ $sessioned['code'] }} </h5>
						@if (array_key_exists("groups", $sessioned))
                        	@foreach($sessioned['groups'] as $group)
                        		<h5 class="card-text"> <b> List Name: </b> {{ $group['name'] }} </h5>
                        		<h5 class="card-text"> <b> Activity: </b> @if($group['active'] == 0) Not Active @else Active @endif </h5>

                        	@endforeach
                        	<div class="row justify-content-center" style="margin-bottom: 5px;"> </div>
                        	<a href="group/{{ $sessioned['code'] }}/{{$group['id']}}"> <button class="btn btn-primary" value="Delphi Code Stats" style="float:right"> Statistics </button> </a>
                        @else
                        	<h5 class="card-text"> <b> List Name: </b> None </h5>
                       		<h5 class="card-text"> <b> Activity: </b> Not Active </h5>
                       		<div class="row justify-content-center" style="margin-bottom: 5px;"> </div>
                       		<a href=""> <button class="btn btn-secondary" value="Delphi Code Stats" style="float:right" disabled> Statistics </button> </a>
                    	@endif
					</div>
				</div>
			@endforeach
		@else
			<h2> Currently, you have no Delphi Codes to keep track of statistics. </h2>
		@endif
	</div>
@endsection