@extends('master')

@section('aux_tables_active')
    class="active"
@stop

@section('form_search')

{{ Form::open(array('class'=>'navbar-form navbar-left','method'=>'get','role'=>'search','route'=>'municipalities.index')) }}
{{ Form::submit('Search', array('class'=>'btn btn-default')) }} 
{{ Form::close() }}

@stop

@section('main')
<div class="container-fluid">
    <h1> All municipalities </h1>
    <p> {{ link_to_route('municipalities.create', Lang::get('municipalities.create')) }} </p>
    
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    
    @if ($municipalities->count())
    <table class="table table-striped table-ordered table-condensed">
        <thead>
            <tr>
                <th>Description</th>
                <th>Municipality</th>
                <th>Country</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($municipalities as $municipality)
            <tr>
                <td> 
                   {{ $municipality->description }} 
                </td>
                   {{ $municipality->department->description }} 
                </td><td> 
                   {{ $municipality->department->country->description }} 
                </td>
                <td> 
                    {{ link_to_route('municipalities.edit', 'Edit', array($municipality->id), array('class'=>'btn btn-info '.Config::get('global/default.button_size'))) }} 
                </td>
                <td>
                    {{ Form::open(array('method'=>'DELETE', 'route'=>array('municipalities.destroy', $municipality->id))) }}
                    {{ Form::submit('Delete', array('class'=>'btn btn-danger '.Config::get('global/default.button_size'), 'onclick'=>"if(!confirm('Are you sure to delete this item?')){return false;};")) }} 
                    {{ Form::close() }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{!! $municipalities->links() !!}
@else
 There are no municipalities
@endif
@stop