@extends('master')

{{-- The next section only serves to 
    let know master blade that the aux tables 
    menu option needs to be highligted--}}
    
@section('aux_tables_active')
active
@stop

@section('main')

    <div class='container-fluid'>
        <h1> Create loan status </h1>
        {{ Form::open(array('route'=>'loan_statuses.store')) }}
            @include('loan_statuses.form')
        {{ Form::close() }}
    </div>

@stop