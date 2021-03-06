@extends('master')

{{-- The next section only serves to 
    let know master blade that the countries 
    menu option needs to be highligted--}}

@section('aux_tables_active')
    class="active"
@stop

@section('main')

<h1> Edit department </h1>

<div class='container-fluid'>
    {{ Form::model($department, array('method'=>'PATCH', 'route'=> array('departments.update', $department->id)))  }}
        @include('departments.form')
    {{ Form::close() }}
</div>

@stop