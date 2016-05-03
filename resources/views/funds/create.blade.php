@extends('master')

{{-- The next section only serves to 
    let know master blade that the aux tables 
    menu option needs to be highligted--}}
    
@section('aux_tables_active')
active
@stop

@section('main')

    <div class='container-fluid'>
        <h1> Create fund </h1>
        {{ Form::open(array('route'=>'funds.store')) }}
            @include('funds.form')
        {{ Form::close() }}
    </div>

@stop