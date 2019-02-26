@extends('layouts.app')

@section('content')
<div id="user-dashboard" class="container">
    <div class="row justify-content-center">
        <h2 id="welcome-header">Welcome to your profile <?= Auth::user()->name ?></h2>
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
                        @if ( !empty($errorMessage))
                            <p class="error-message"> @if($errorMessage == '1') Code does not exist! Please try another code @else Something went wrong please try again @endif</p>
                        @endif          
                    </form> 
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Start Voting on Your List: </div>

                <div class="card-body">
                    <!-- @TODO Enter in lists dynamically-->
                    <ul class="delphi-list">
                        <li class="delphi-list-item">List1 <span class="delphi-description" >This is a description of list one</span></li>
                        <li class="delphi-list-item">List2 <span class="delphi-description" >This is a description of list two</span></li>
                        <li class="delphi-list-item">List3 <span class="delphi-description" >This is a description of list three</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- @TODO Enter a section to add new lists to a specific code? -->
        <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Your Delphi Codes </div>

                <div class="card-body">
                    <!-- @TODO Enter in lists dynamically-->
                    <ul class="delphi-list">
                        @foreach ($sessions as $session)
                            <li class="delphi-list-item"><span class="session-code">{{ $session->code }}</span> <a href="user/{{ $session->code }}/create"><button>Create List</button></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
