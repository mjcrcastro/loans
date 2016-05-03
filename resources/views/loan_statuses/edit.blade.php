@extends('master')

{{-- The next section only serves to 
    let know master blade that the countries 
    menu option needs to be highligted--}}

@section('aux_tables_active')
    class="active"
@stop

@section('main')

<h1> Edit loan status </h1>

<div class='container-fluid'>
    {{ Form::model($loan_status, array('method'=>'PATCH', 'route'=> array('loan_statuses.update', $loan_status->id)))  }}
        @include('loan_statuses.form')
    {{ Form::close() }}
</div>

@stop