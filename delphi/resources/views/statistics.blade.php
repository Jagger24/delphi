@extends('layouts.app')

@section('content')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


<div id="total-voters-page" class="container">
    <div class="row justify-content-center">
        <h1 id="delphi_code_header"> Welcome To This Groups Statistics </h1>
    </div>
<hr style="border-top:15px solid;"/>		

    @if($group->prioritization)
    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table table-hover table-bordered text-center">
                <thead class="table-dark"> 
                    <th> Priority </th>
                    <th> Option Name </th>
                    <th> Option Description </th>
                    <th> Option Mean </th>
                    <th> Option Standard Deviation </th>
                </thead>
                <tbody>
                @if($sorted_options)
                    @foreach($sorted_options as $key => $option)
                        <?php $classes = '' ?>
                        @if($stats[$key][0] >= 2) <?php $classes = 'grayed' ?> @endif
                        @if($stats[$key][1] >= 1) <?php $classes = 'grayed highlighted' ?> @endif
                        <tr class='{{$classes}}'>
                            <td> {{$key + 1}} </td>
                            <td> {{$option->name}} </td>
                            <td> {{$option->description}} </td>
                            <td> {{round($stats[$key][0], 3)}} </td>
                            <td> {{round($stats[$key][1], 3)}} </td>
                        </tr>
                    @endforeach 
                @endif    
            </table>
        </div>
    </div>
    @else
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table table-hover table-bordered text-center">
                    <thead class="table-dark"> 
                        <th> Top Options </th>
                        <th> Option Name </th>
                        <th> Option Description </th>
                        <th> Option Percentage </th>
                        <th> Option Standard Deviation </th>
                    </thead>
                    <tbody>
                    @if($sorted_options)
                        @foreach($sorted_options as $key => $option)
                            <?php $classes = '' ?>
                            @if($elimination_votes < $key + 1) <?php $classes = 'grayed' ?> @endif
                            @if($stats[$key][1] >= 1) <?php $classes = 'grayed highlighted' ?> @endif
                            <tr>
                                <td> {{$key + 1}} </td>
                                <td> {{$option->name}} </td>
                                <td> {{$option->description}} </td>
                                <td> {{$percentage[$key]}} </td>
                                <td> {{round($stats[$key][1], 3)}} </td>
                            </tr>
                        @endforeach 
                    @endif    
                </table>
            </div>
        </div>

    @endif

</div>

@endsection

