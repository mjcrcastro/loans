@extends('master')

@section('contacts_active')
active
@stop

@section('form_search')

{{ Form::open(array('class'=>'navbar-form navbar-left','method'=>'get','role'=>'search','route'=>'contacts.index')) }}
{{ Form::submit('Search', array('class'=>'btn btn-default')) }} 
{{ Form::close() }}

@stop

@section('main')
<div class="container-fluid">
    <h1> All contacts </h1>
    <p> {{ link_to_route('contacts.create', Lang::get('contacts.create')) }} </p>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    
    @if (session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif
    @if ($contacts->count())
    <table class="table table-striped table-ordered table-condensed">
        <thead>
            <tr>
                <th>Name</th>
                <th>{{ Lang::get('municipalities.singular') }}</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
            <tr>
                <td> 
                   {{ $contact->name . ' ' . $contact->first_lastname . ' ' .  $contact->second_lastname }} 
                </td>
                <td> 
                   {{ $contact->municipality->country_department_municipality }} 
                </td>
                <td> 
                    {{ link_to_route('contacts.edit', 'Edit', array($contact->id), array('class'=>'btn btn-info '.Config::get('global/default.button_size'))) }} 
                </td>
                <td>
                    {{ Form::open(array('method'=>'DELETE', 'route'=>array('contacts.destroy', $contact->id))) }}
                    {{ Form::submit('Delete', array('class'=>'btn btn-danger '.Config::get('global/default.button_size'), 'onclick'=>"if(!confirm('Are you sure to delete this item?')){return false;};")) }} 
                    {{ Form::close() }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{!! $contacts->links() !!}
@else
 There are no contacts
@endif
@stop