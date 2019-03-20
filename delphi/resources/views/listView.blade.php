@extends('layouts.app')

@section('content')
<div id="list-view-page" class="container">
    <div class="row justify-content-center">
        <h1 id="delphi_code_header"> Welcome to List View </h1>

    </div>
<hr style="border-top:15px solid;"/>
    <div class="row justify-content-center">
        <h1 id="delphi_code_header"> Activate this List for Voting </h1>
    </div>
<div class="card">
			<div class="card-header">
				New List Form
			</div>
			<div class="card-body" style="horizontal-align:center">
 				<form class="form-horizontal" action="/user/{{$code}}/{{$id}}/view" method="POST" >
 					{{ csrf_field() }}	

  					<div class="form-group">
    					<div class="col-sm-10">
    						<label class="control-label" for="max_student">Number of students for list:</label>
      						<input type="number" class="form-control" min="0" name="students" id="maxstudent" required placeholder="Number of students for list">
    					</div>
  					</div>

  					<div class="form-group">
    					<div class="col-sm-10">
    						<label class="control-label col-sm-5">Activate List</label>
      						<button type="submit" class="btn btn-danger">Activate List</button>
    					</div>
  					</div>

				</form> 
			</div>
		</div>
<hr />

    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table table-hover table-bordered text-center">
                <thead class="table-dark"> 
                    <th> # </th>
                    <th> Option Name </th>
                    <th> Option Description </th>
                </thead>
                <tbody>
                    @foreach($options as $key => $option)
                        <tr>
                            <td> {{$key + 1}} </td>
                            <td> {{$option['name']}} </td>
                            <td>{{$option['description']}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection
