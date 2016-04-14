@extends('master')

{{-- The next section only serves to 
    let know master blade that the shops 
    menu option needs to be highligted--}}
    
@section('config_active')
active
@stop

@section('main')

    <div class='container-fluid'>
        <h1> Create country </h1>
        {{ Form::open(array('route'=>'countries.store')) }}
            @include('countries.form')
        {{ Form::close() }}
    </div>

@stop