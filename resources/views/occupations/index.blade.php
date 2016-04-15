@extends('master')

@section('aux_tables_active')
    class="active"
@stop

@section('form_search')

{{ Form::open(array('class'=>'navbar-form navbar-left','method'=>'get','role'=>'search','route'=>'countries.index')) }}
{{ Form::submit('Search', array('class'=>'btn btn-default')) }} 
{{ Form::close() }}

@stop

@section('main')
<div class="container-fluid">
    <h1> All occupations </h1>
    <p> {{ link_to_route('occupations.create', Lang::get('occupations.create')) }} </p>
    
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
    
    @if ($occupations->count())
    <table class="table table-striped table-ordered table-condensed">
        <thead>
            <tr>
                <th>Description</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($occupations as $occupation)
            <tr>
                <td> 
                   {{ $occupation->description }} 
                </td>
                <td> 
                    {{ link_to_route('occupations.edit', 'Edit', array($occupation->id), array('class'=>'btn btn-info '.Config::get('global/default.button_size'))) }} 
                </td>
                <td>
                    {{ Form::open(array('method'=>'DELETE', 'route'=>array('occupations.destroy', $occupation->id))) }}
                    {{ Form::submit('Delete', array('class'=>'btn btn-danger '.Config::get('global/default.button_size'), 'onclick'=>"if(!confirm('Are you sure to delete this item?')){return false;};")) }} 
                    {{ Form::close() }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{!! $occupations->links() !!}
@else
    There are no occupations
@endif
@stop