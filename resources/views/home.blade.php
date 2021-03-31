@extends('layout')

@section('content')
@if(Auth::user()->role=='UC')
<div class="row">    
    <div class="col ml-3 mr-3">
        <h2>Team Submissions</h2>
        <div style="background-color:white; height: 400px"> 
            <div id="chart" style="background-color:white"></div>
        </div>
    </div>
    <div class="col">
        <h2>Dispute Cases</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Case Title</th>
                    <th>Date Submitted</th>
                    <th>Submitted by </th>
                    <th>Team</th>
                    <th>Module</th>
                </tr>

            </thead>

            @foreach($disputeCases as $case) 
            
            <tr>
                <td>{{$case->id}}</td>
                <td>
                    <a href="{{ route('view_dispute_case_details', ['disputecase'=>$case->id])}}">
                    {{$case->case_title}}
                    </a>
                </td>
                <td>{{$case->created_at->format('d/m/Y')}}</td>
                <td>{{$case->students->s_givenname}}</td>
                <td>{{$case->team->team_name}}</td>
                <td>{{$case->module->module_name}}</td>
            </tr>

        @endforeach
            </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    let allSubmissions = {!!$allSubmissions!!};
    let teams = [];
    let data = [];
    for (let eachSubmission of allSubmissions) {
        teams.push(eachSubmission.team_name);
        data.push(eachSubmission.submissions);
    }



    const options =  {
    chart: {
        type: 'bar',
        height:"100%",
        background: "#fff"
    },
    plotOptions: {
        bar: {
            borderRadius: 4,
            horizontal: true
        }
        
    },
    // each series represents one set of data
    series:[
        {
            name: 'submissions_count',
            data: data
        }
    ],
    // what is are the labels along the x-axis (horizontal line)
    xaxis: {
        categories: teams
    },   
}

const chart = new ApexCharts(document.querySelector('#chart'), options);
 
 // render the chart
 chart.render()

</script>
@else
<h1>Admin</h1>
@endif
@endsection
