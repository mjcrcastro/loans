{{--This stub is a form for both editing and creating loan statuses, see usages in
    views loan_statuses.create and loan_statuses.edit --}}

<div class="form-group @if ($errors->has('description')) has-error @endif">
    {{ Form::label('description', 'Description:') }}
    {{ Form::text('description',null,array('class'=>"form-control")) }}
    @if ($errors->has('description')) 
    <div class="small">
        {{ $errors->first('description', ':message') }} 
    </div>
    @endif
</div> 
<div class="row-fluid">
    <div class="form-group">    
        {{ Form::submit('Submit', array('class'=>'btn  btn-primary col-xs-6')) }}
        {{ link_to_route('loan_statuses.index', 'Cancel', [],array('class'=>'btn btn-default col-xs-6')) }}
    </div>
</div>