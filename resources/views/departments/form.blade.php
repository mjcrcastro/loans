{{--This stub is a form for both editing and creating departments, see usages in
    views departments.create and departments.edit --}}

<div class="form-group @if ($errors->has('country_id')) has-error @endif">
    {{ Form::label('country', 'Country:') }}
    {{ Form::select('country_id', $countries,null,array('class'=>"form-control")) }}
     @if ($errors->has('country_id')) 
    <div class="small">
        {{ $errors->first('country_id', ':message') }} 
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
        {{ link_to_route('departments.index', 'Cancel', [],array('class'=>'btn btn-default col-xs-6')) }}
    </div>
</div>