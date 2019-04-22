@extends("layouts.app")

@section("content")


<style>
    div.card{
        margin-bottom:2rem;
        font-size:2rem;
    }
    div.card-body{
    font-size:1.5rem;
    }
    button.btn-primary{
        font-size:20px;
    }
</style>
<div id="voting-page" class="container">
    <div class="row justify-content-center">
        <h1 id="delphi_code_header"> Welcome to Voting </h1>

</div>
<hr style="border-top:15px solid;"/>
    <div class="row justify-content-center">
        @if($group->method)
            <h1> Enter a range for each option 1 being HIGHEST priority 3 being LOWEST priority </h1>
        @else
            <h1> You have {{$votingCount}} votes to vote with, you may assign them however you like and some results may be left empty. </h1>
        @endif
    </div>

@if($group->method)
    <form action="/group/{{$group->code}}/{{$group->id}}/voting"  method="POST">
        {{ csrf_field() }}
        <div class="row justify-content-center">
            <h4 id="delphi_code_header"> Vote Below </h4>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table table-hover table-bordered text-center">
                    <thead class="table-dark">
                        <th> Option Name </th>
                        <th> Option Description </th>
                        <th> Vote </th>
                    </thead>
                    <tbody>
                        @foreach($options as $option)
                            <tr>
                                <td> {{ $option->name }} </td>
                                <td> {{ $option->description }} </td>
                                <td class="voting-slot"><label for="{{$option->id}}">Prioritize (1-3) </label>
                                <input type="number" name="{{$option->id}}" min="1" max="3" value="3" style="width:150px;"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Submit Vote</button>
            </div>
        </div>
    </form>
@else
    <form action="/group/{{$group->code}}/{{$group->id}}/voting"  method="POST">
        {{ csrf_field() }}
        <div class="row justify-content-center">
            <div ><h1 id="points" data-pointsLeft="{{$votingCount}}" style="margin-top:2rem;">Points Left: {{$votingCount}}</h1></div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table table-hover table-bordered text-center">
                    <thead class="table-dark">
                        <th> Option Name </th>
                        <th> Option Description </th>
                        <th> Vote </th>
                    </thead>
                    <tbody>
                        @foreach($options as $option)
                            <tr>
                                <td> {{ $option->name }} </td>
                                <td> {{ $option->description }} </td>
                                <td class="voting-slot"><label for="{{$option->id}}"> Enter Number of Points </label>
                                <input type="number" name="{{$option->id}}" min="0" max="{{$votingCount}}" style="width:150px;" value=0></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div><h1 id="explanation"> Please use only the alloted points to vote. </h1>
        <button id="btn-disabled" type="submit" disabled="true" class="btn btn-primary">Submit Vote</button>
    </form>

    <script>
    $("input").change(function(){
        var sum = 0;
        $("input[type='number']").each(function(){
            sum += Number($(this).val());
            console.log(sum);
        });
        var points_left = {{$votingCount}} - sum;
        $("#points").data("pointsLeft", points_left );
        $("#points").html("Points Left: " + points_left);

        if(points_left == 0){
            $("#btn-disabled").removeAttr("disabled");
            $("#explanation").hide();
        }else{
            $("#btn-disabled").attr("disabled", true);
            $("#explanation").show();
        }

    });
    

    

</script>


@endif
    
@endsection