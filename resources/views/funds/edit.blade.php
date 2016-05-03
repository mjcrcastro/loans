@extends('master')

{{-- The next section only serves to 
    let know master blade that the countries 
    menu option needs to be highligted--}}

@section('aux_tables_active')
class="active"
@stop

@section('main')

<h1> Edit fund </h1>

<div class='container-fluid'>
    {{ Form::model($fund, array('method'=>'PATCH', 'route'=> array('funds.update', $fund->id)))  }}
        @include('funds.form')
    {{ Form::close() }}
</div>

@stop