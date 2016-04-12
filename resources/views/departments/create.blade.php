@extends('master')

{{-- The next section only serves to 
    let know master blade that the shops 
    menu option needs to be highligted--}}

@section('config_active')
active
@stop

@section('main')

<div class='container-fluid'>
    <h1> Create department </h1>
    {{ Form::open(array('route'=>'departments.store')) }}
    @include('departments.form')
    {{ Form::close() }}
</div>

@if(Session::has('message')) 
    <div class="alert alert-info"> {{Session::get('message')}} </div> 
@endif

@stop