@extends('layouts.app')

@section('content')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    @if($owner)
    <style>
        .cursor{
            cursor:pointer;
        }
    </style>
    @endif

<div id="total-voters-page" class="container">
    <div class="row justify-content-center">
        <h1 id="delphi_code_header"> Welcome To This Groups Statistics </h1>
    </div>
<hr style="border-top:15px solid;"/>	

<form class="form-horizontal" action="/group/{{$group->code}}/{{$group->id}}/" method="POST">
    {{ csrf_field() }}
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
                        @if($stats[$key][0] >= 2) <?php $classes = 'grayed' ?> 
                            <input hidden id="option{{$option->id}}" name="option[{{$key}}]" type='radio' value='0' checked='checked'>
                        @else
                            <input hidden id="option{{$option->id}}" name="option[{{$key}}]" type='radio' value='1' checked='checked'>
                        
                        @endif
                        @if($stats[$key][1] >= 1) <?php $classes = 'grayed highlighted' ?> @endif
                        
                        <tr class='{{$classes}} cursor' id="option{{$option->id}}">
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
                            @if($elimination_votes < $key + 1) <?php $classes = 'grayed' ?> 
                                 <input hidden id="option{{$option->id}}" name="option[{{$key}}]" type='radio' value='0' checked='checked'>
                            @else
                                <input hidden id="option{{$option->id}}" name="option[{{$key}}]" type='radio' type='radio' value='1' checked='checked'>
                            @endif
                            @if($stats[$key][1] >= 1) <?php $classes = 'grayed highlighted' ?> @endif
                            <tr class = '{{$classes}}' id="option{{$option->id}}">
                                <td> {{$key + 1}} </td>
                                <td> {{$option->name}} </td>
                                <td> {{$option->description}} </td>
                                <td> {{round($percentage[$key], 3)}} </td>
                                <td> {{round($stats[$key][1], 3)}} </td>
                            </tr>
                        @endforeach 
                    @endif  
                    </tbody>  
                </table>
            </div>
        </div>

    @endif

</div>


@if($owner)
    <div class="container">
        <hr style="border-top:15px solid;"/>
        <div class="card">
            <div class="card-header">
                New List Form
            </div>
            <div class="card-body" style="horizontal-align:center">
                    <div class="form-group">
                        <div class="col-sm-10">
                            <label class="control-label" for="max_student">Number of students for list:</label>
                            <input type="number" class="form-control" min="0" name="students" id="maxstudent" value="{{$group->students}}" required placeholder="{{$group->students}}">
                        </div>
                    </div>

             <div class="form-group">
              <div class="col-sm-10">
                <label class="control-label col-sm-5" for="voting_method">Method of Sorting:</label>
                  <input type="radio"  name="voting_method" id="votingmethod" checked="checked" value="true">Prioritization
                  <input type="radio"  name="voting_method" id="votingmethod2" value="">Elimination
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-10">
                <label class="control-label col-sm-5" for="voting_style">Method of Voting:</label>
                  <input type="radio"  name="voting_style" id="votingstyle" checked="checked" value="true">Each student picks 1 - 3 for each option
                  <input type="radio"  name="voting_style" id="votingstyle2" value="">Each student gets 70%
              </div>
            </div>

                    <div class="form-group">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Start re-vote</button>
                        </div>
                    </div>

                </form> 
            </div>
        </div>
    </div>

    
@endif

</form>

@if($owner)
    <script>
        $('tr.cursor').click(function(){
            let currentval = $('input#' + this.id).val();
            let newval = 2;
            if(currentval === '1'){
                newval = 0;
                $('tr#' + this.id).addClass('grayed');
            }else{
                newval = 1;
                $('tr#' + this.id).removeClass('grayed');
            }
            $('input#' + this.id).val(newval);
        });
    </script>
@endif
@endsection

