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
                            <p class="error-message"> @if($errorMessage == '1') Code does not exist! Please try another code @else Something went wrong please try again @endif</p>
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
                    <th> Description </th>
                </thead>
                <tbody>
                    @foreach($infoArray as $session)
                        <tr>
                            <td> {{$session['id']}} </td>
                            <td> {{$session['code']}} </td>
                            <td></td>
                            <td> <a href="user/{{ $session['code'] }}/create"><button class="btn btn-primary" value="Create List">Create List</button> </td>
                            <td></td>
                            <td></td>
                            <td> -- </td>
                        </tr>

                        @foreach($session['groups'] as $group)
                            <tr>
                                <td> </td>
                                <td> {{$session['code']}} </td>
                                <td>{{$group['name']}}</td>
                                <td> <a href="user/{{ $session['code'] }}/{{$group['name']}}/view"><button class="btn btn-danger" value="Create List">View List</button></td>
                                <td> @if($group['active'] == 0) false @else true @endif</td>
                                <td> HARD CODED N/A</td>
                                <td> -- </td>
                            </tr>

                        @endforeach
                    @endforeach
            </table>
        </div>
    </div>


    <!--

     @TODO Enter a section to add new lists to a specific code? 
        <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Your Delphi Codes </div>

                <div class="card-body">
                    @TODO Enter in lists dynamically
                    <ul class="delphi-list">
                        @foreach ($sessions as $session)
                            <li class="delphi-list-item"><span class="session-code">{{ $session->code }}</span> <a href="user/{{ $session->code }}/create"><button>Create List</button></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    -->
</div>
@endsection
