@extends('master')

{{-- The next section only serves to 
    let know master blade that the shops 
    menu option needs to be highligted--}}
    
@section('config_active')
active
@stop

@section('main')

    <div class='container-fluid'>
        <h1> Create Contact </h1>
        {{ Form::open(array('route'=>'contacts.store')) }}
            @include('contacts.form')
        {{ Form::close() }}
    </div>

@stop