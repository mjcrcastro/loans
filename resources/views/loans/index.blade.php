@extends('master')

@section("loans_active")
    class="active"
@stop

@section('form_search')

{{ Form::open(array('class'=>'navbar-form navbar-left','method'=>'get','role'=>'search','route'=>'loans.index')) }}
{{ Form::submit('Search', array('class'=>'btn btn-default')) }} 
{{ Form::close() }}

@stop

@section('main')
<div class="container-fluid">
    <h1> All loans </h1>
    <p> {{ link_to_route('loans.create', Lang::get('loans.create')) }} </p>
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
    @if ($loans->count())
    <table class="table table-striped table-ordered table-condensed">
        <thead>
            <tr>
                <th>Customer</th>
                <th>Loan date</th>
                <th>Principal</th>
                <th>Agent</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loans as $loan)
            <tr>
                <td> 
                   {{ $loan->loanBorrower->full_name }} 
                </td>
                <td>
                    {{-- //TODO DISPLAY DISBURSMENT --}}
                </td>
                <td> 
                   {{ $loan->principal }} 
                </td>
                <td> 
                   {{ $loan->loanAgent->full_name }} 
                </td>
                <td> 
                    {{ link_to_route('loans.edit', 'Edit', array($loan->id), array('class'=>'btn btn-info '.Config::get('global/default.button_size'))) }} 
                </td>
                <td>
                    {{ Form::open(array('method'=>'DELETE', 'route'=>array('loans.destroy', $loan->id))) }}
                    {{ Form::submit('Delete', array('class'=>'btn btn-danger '.Config::get('global/default.button_size'), 'onclick'=>"if(!confirm('Are you sure to delete this item?')){return false;};")) }} 
                    {{ Form::close() }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{!! $loans->links() !!}
@else
 There are no loans
@endif
@stop