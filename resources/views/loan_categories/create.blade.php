@extends('master')

{{-- The next section only serves to 
    let know master blade that the aux tables 
    menu option needs to be highligted--}}
    
@section('aux_tables_active')
active
@stop

@section('main')

    <div class='container-fluid'>
        <h1> Create {{ Lang::get('loan_categories.singular') }} </h1>
        {{ Form::open(array('route'=>'loan_categories.store')) }}
            @include('loan_categories.form')
        {{ Form::close() }}
    </div>

@stop