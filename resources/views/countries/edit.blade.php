@extends('master')

{{-- The next section only serves to 
    let know master blade that the countries 
    menu option needs to be highligted--}}

@section('aux_tables_active')
class="active"
@stop

@section('main')

<h1> Edit country </h1>

<div class='container-fluid'>
    {{ Form::model($country, array('method'=>'PATCH', 'route'=> array('countries.update', $country->id)))  }}
        @include('countries.form')
    {{ Form::close() }}
</div>

@stop