@extends('master')

{{-- The next section only serves to 
    let know master blade that the shops 
    menu option needs to be highligted--}}

@section('aux_tables_active')
    class="active"
@stop

@section('main')

<div class='container-fluid'>
    <h1> Create municipality </h1>
    {{ Form::open(array('route'=>'municipalities.store')) }}
    @include('municipalities.form')
    {{ Form::close() }}
</div>

@if(Session::has('message')) 
    <div class="alert alert-info"> {{Session::get('message')}} </div> 
@endif

@stop