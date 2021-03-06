@extends('master')

{{-- The next section only serves to 
    let know master blade that the countries 
    menu option needs to be highligted--}}

@section('aux_tables_active')
class="active"
@stop

@section('main')

<h1> {{ Lang::get('occupations.edit') }} </h1>

<div class='container-fluid'>
    {{ Form::model($occupation, array('method'=>'PATCH', 'route'=> array('occupations.update', $occupation->id)))  }}
        @include('occupations.form')
    {{ Form::close() }}
</div>

@stop