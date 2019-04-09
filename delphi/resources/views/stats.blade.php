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
						<h5 class="card-title"> Delphi Code: {{ $sessioned['code'] }}</h5>
						<h5 class="card-text"> Method: </h5>
						@if(array_key_exists("groups", $sessioned))
							@foreach($sessioned['groups'] as $group)
								<h5 class="card-text"> Activity: @if($group['active'] == 0) Not Active @else Active @endif </h5>
								<h5 class="card-text"> Std. Deviation: </h5>
							@endforeach
							<a href=""> <button class="btn btn-primary" value="Delphi Code Stats"> Statistics </button> </a>
						@else
							<a href=""> <button class="btn btn-secondary" value="Delphi Code Stats" disabled> Statistics </button> </a>
						@endif
					</div>
				</div>
			@endforeach
		@else
			<h2> Currently you have no Delphi Codes to keep track of statistis </h2>
		@endif
	</div>
@endsection