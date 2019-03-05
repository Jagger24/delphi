@extends('layouts.app')

@section('content')
<div id="user-dashboard" class="container">

    <!-- Welcome messag to user -->
    <div class="row justify-content-center">
        <h2 id="welcome-header">Welcome back, <?= Auth::user()->name ?> </h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a new Delphi List </div>

                <div class="card-body">
                    <form action="{{ route('sessionStore') }}" method="POST">
                        {{ csrf_field() }}

                        <input type="hidden" id="userId" name="userId" value="<?= Auth::user()->id; ?>">

                        <label for="joinCode">Join Code:</label>
                        <input name="joinCode" type="text" pattern=".{5,10}" required title="5 to 10 characters">

                        <input type="submit" class="btn btn-primary" value="Submit Code">
                        @if (!empty($errorMessage))
                            <p class="error-message"> @if($errorMessage == '1') Code Already exists! Please try another code @else Something went wrong please try again @endif</p>

                        @endif          
                    </form> 
                </div>
            </div>
        </div>
    </div>

    <!-- Delphi Codes Table -->
    <div class="row justify-content-center">
        <h4 id="delphi_code_header"> Your Delphi Codes </h4>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table table-hover table-bordered text-center">
                <thead class="table-dark"> 
                    <th> # </th>
                    <th> Delphi Code </th>
                    <th> List Name </th>
                    <th> Create/View List </th>
                    <th> Active </th>
                    <th> Remaining Time </th>
                    <th> View Stats </th>
                </thead>
                <tbody>
                @if($infoArray)
                    @foreach($infoArray as $sessioned)
                        <tr>
                            <td> {{$sessioned['id']}} </td>
                            <td> {{$sessioned['code']}} </td>
                            <td></td>
                            <td> <a href="user/{{ $sessioned['code'] }}/create"><button class="btn btn-primary" value="Create List">Create List</button> </td>
                            <td></td>
                            <td></td>
                            <td> -- </td>
                        </tr>
                    @if (array_key_exists("groups", $sessioned))
                        @foreach($sessioned['groups'] as $group)
                            <tr>
                                <td> </td>
                                <td> {{$sessioned['code']}} </td>
                                <td>{{$group['name']}}</td>
                                <td> <a href="user/{{ $sessioned['code'] }}/{{$group['id']}}/view"><button class="btn btn-danger" value="Create List">View List</button></td>
                                <td> @if($group['active'] == 0) false @else true @endif</td>
                                <td> HARD CODED N/A</td>
                                <td> <a href="group/{{ $sessioned['code'] }}/{{$group['id']}}"><button class="btn btn-danger" value="Create List">View Statistics</button> </td>
                            </tr>

                        @endforeach
                    @endif
                    @endforeach 
                @endif    
            </table>
        </div>
    </div>
</div>
@endsection
