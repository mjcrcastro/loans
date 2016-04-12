@extends('master')

@section('aux_tables_active')
    class="active"
@stop

@section('form_search')

{{ Form::open(array('class'=>'navbar-form navbar-left','method'=>'get','role'=>'search','route'=>'departments.index')) }}
{{ Form::submit('Search', array('class'=>'btn btn-default')) }} 
{{ Form::close() }}

@stop

@section('main')
<div class="container-fluid">
    <h1> All departments </h1>
    <p> {{ link_to_route('departments.create', Lang::get('departments.create')) }} </p>
    
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    
    @if ($departments->count())
    <table class="table table-striped table-ordered table-condensed">
        <thead>
            <tr>
                <th>Description</th>
                <th>Country</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($departments as $department)
            <tr>
                <td> 
                   {{ $department->description }} 
                </td>
                <td> 
                   {{ $department->country->description }} 
                </td>
                <td> 
                    {{ link_to_route('departments.edit', 'Edit', array($department->id), array('class'=>'btn btn-info '.Config::get('global/default.button_size'))) }} 
                </td>
                <td>
                    {{ Form::open(array('method'=>'DELETE', 'route'=>array('departments.destroy', $department->id))) }}
                    {{ Form::submit('Delete', array('class'=>'btn btn-danger '.Config::get('global/default.button_size'), 'onclick'=>"if(!confirm('Are you sure to delete this item?')){return false;};")) }} 
                    {{ Form::close() }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{!! $departments->links() !!}
@else
 There are no departments
@endif
@stop