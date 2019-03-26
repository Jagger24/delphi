@extends('layouts.app')

@section('content')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


<div id="total-voters-page" class="container">
    <div class="row justify-content-center">
        <h1 id="delphi_code_header"> Welcome To This Groups Statistics </h1>
    </div>
<hr style="border-top:15px solid;"/>

	<div class="row justify-content-center" style="font-size:30px;">
	    INSERT SORTED OPTIONS HERE
    </div>		

    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table table-hover table-bordered text-center">
                <thead class="table-dark"> 
                    <th> Priority </th>
                    <th> Option Name </th>
                    <th> Option Description </th>
                    <th> Option Result </th>
                </thead>
                <tbody>
                @if($sorted_options)
                    @foreach($sorted_options as $key => $option)
                        <tr>
                            <td> {{ $key + 1}} </td>
                            <td> {{$option->name}} </td>
                            <td>{{$option->description}}</td>
                            <td> {{$means[$key]}}</td>
                        </tr>
                    @endforeach 
                @endif    
            </table>
        </div>
    </div>


</div>
<script>
	//SOME SORTING METHOD HERE OR MAYBE IN BACKEND
</script>
@endsection

