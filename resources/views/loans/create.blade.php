@extends('master')

{{-- The next section only serves to 
    let know master blade that the loans 
    menu option needs to be highligted--}}
    
@section("loans_active")
    class="active"
@stop

@section('main')

    <div class='container-fluid'>
        <h1> Create loan </h1>
        {{ Form::open(array('route'=>'loans.store')) }}
            @include('loans.form')
        {{ Form::close() }}
    </div>

@stop