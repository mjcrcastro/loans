{{--This stub is a form for both editing and creating municipalities, see usages in
    views municipalities.create and municipalities.edit --}}

<div class="form-group @if ($errors->has('department_id')) has-error @endif">
    {{ Form::label('department', 'Department:') }}
    {{ Form::select('department_id', $departments,null,array('class'=>"form-control")) }}
     @if ($errors->has('department_id')) 
    <div class="small">
        {{ $errors->first('department_id', ':message') }} 
    </div>
    @endif
</div>

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
        {{ link_to_route('municipalities.index', 'Cancel', [],array('class'=>'btn btn-default col-xs-6')) }}
    </div>
</div>