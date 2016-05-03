@extends('master')

@section('aux_tables_active')
    class="active"
@stop

@section('form_search')

{{ Form::open(array('class'=>'navbar-form navbar-left','method'=>'get','role'=>'search','route'=>'loan_categories.index')) }}
{{ Form::submit('Search', array('class'=>'btn btn-default')) }} 
{{ Form::close() }}

@stop

@section('main')
<div class="container-fluid">
    <h1> All loan categories </h1>
    <p> {{ link_to_route('loan_categories.create', Lang::get('loan_categories.create')) }} </p>
    
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
    
    @if ($loan_categories->count())
    <table class="table table-striped table-ordered table-condensed">
        <thead>
            <tr>
                <th>Description</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loan_categories as $loan_category)
            <tr>
                <td> 
                   {{ $loan_category->description }} 
                </td>
                <td> 
                    {{ link_to_route('loan_categories.edit', 'Edit', array($loan_category->id), array('class'=>'btn btn-info '.Config::get('global/default.button_size'))) }} 
                </td>
                <td>
                    {{ Form::open(array('method'=>'DELETE', 'route'=>array('loan_categories.destroy', $loan_category->id))) }}
                    {{ Form::submit('Delete', array('class'=>'btn btn-danger '.Config::get('global/default.button_size'), 'onclick'=>"if(!confirm('Are you sure to delete this item?')){return false;};")) }} 
                    {{ Form::close() }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{!! $loan_categories->links() !!}
@else
 There are no {{ Lang::get('loan_categories.plural') }}
@endif
@stop