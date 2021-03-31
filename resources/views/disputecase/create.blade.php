@extends('seclayout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

                <div class="section-title">

                    <h2>Dispute Case</h2>
                    <p>Module name: {{$disputecase->module->module_name}} </p>
                </div>
            </div>
        </div>


{{Form::open()}}
{{Form::token()}}

<br>
<div class="card">
   <div class="card-body">
    
    {{Form::label("Case Title", null, ['class'=>'form-label'])}}
    {{Form::text('case_title', '', ['class'=>'form-control'])}}




    {{Form::label("Case Description", null, ['class'=>'form-label'])}}
    {{Form::text('case_description', '', ['class'=>'form-control'])}}
   </div>
</div>
    

{{Form::submit('Create', ['class'=>'btn btn-primary mt-3'])}}
{{Form::close()}}

@endsection()