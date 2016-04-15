@extends('master')

{{-- The next section only serves to 
    let know master blade that the countries 
    menu option needs to be highligted--}}

@section('aux_tables_active')
class="active"
@stop

@section('main')

<h1> Edit contact </h1>

<div class='container-fluid'>
    {{ Form::model($contact, array('method'=>'PATCH', 'route'=> array('contacts.update', $contact->id)))  }}
        @include('contacts.form')
    {{ Form::close() }}
</div>

@stop