@extends('master')

{{-- The next section only serves to 
    let know master blade that the shops 
    menu option needs to be highligted--}}
    
@section('config_active')
active
@stop

@section('main')

    <div class='container-fluid'>
        <h1> {{ Lang::get('occupations.create') }} </h1>
        {{ Form::open(array('route'=>'occupations.store')) }}
            @include('occupations.form')
        {{ Form::close() }}
    </div>

@stop