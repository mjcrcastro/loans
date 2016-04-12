{{--This stub is a form for both editing and creating contacts, see usages in
    views contacts.create and contacts.edit --}}

<div class="tabbable"> <!-- Only required for left/right tabs -->
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab1" data-toggle="tab">General Info</a></li>
        <li><a href="#tab2" data-toggle="tab">Contact Info</a></li>
        <li><a href="#tab3" data-toggle="tab">Other Info</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab1">
            <p>
            <div class="form-group">
                {{ Form::label('name', 'Name:') }}
                {{ Form::text('name',null,array('class'=>'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('first_lastname', 'First Last Name:') }}
                {{ Form::text('first_lastname',null,array('class'=>'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('second_lastname', 'Second Last Name:') }}
                {{ Form::text('second_lastname',null,array('class'=>'form-control')) }}
            </div>
            <div class="form-group @if ($errors->has('identification')) has-error @endif">
                {{ Form::label('identification', 'Identification:') }}
                {{ Form::text('identification',null,array('class'=>"form-control")) }}
                @if ($errors->has('identification')) 
                <div class="small">
                    {{ $errors->first('identification', ':message') }} 
                </div>
                @endif
            </div> 
            <div class="form-group">
                {{ Form::label('birthdate', 'Birthdate:') }}
                {{ Form::text('birthdate',null,array('class'=>'form-control')) }}
            </div>
        </div>
        <div class="tab-pane" id="tab2">
            <p>
            <div class="form-group">
                {{ Form::label('country', 'Country:') }}
                {{ Form::text('country',null,array('class'=>'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('city', 'City:') }}
                {{ Form::text('city',null,array('class'=>'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('address', 'Address:') }}
                {{ Form::text('address',null,array('class'=>'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('phones', 'Phones:') }}
                {{ Form::text('phones',null,array('class'=>'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('email', 'E-mail:') }}
                {{ Form::text('email',null,array('class'=>'form-control')) }}
            </div>
        </div>
        <div class="tab-pane" id="tab3">
            <p>
            <div class="form-group">
                {{ Form::label('picture', 'Picture:') }}
                {{ Form::text('picture',null,array('class'=>'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('occupation', 'Occupation:') }}
                {{ Form::text('occupation',null,array('class'=>'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('employer_id', 'Employer:') }}
                {{ Form::select('employer_id',array("1"=>"Employer #1"),1,
                            array('class'=>'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('notes', 'Notes:') }}
                {{ Form::textarea('notes',null,array('class'=>'form-control','rows'=>5)) }}
            </div>
        </div>
    </div>
</div>

<div class="row-fluid">
    <div class="form-group">    
        {{ Form::submit('Submit', array('class'=>'btn  btn-primary col-xs-6')) }}
        {{ link_to_route('contacts.index', 'Cancel', [],array('class'=>'btn btn-default col-xs-6')) }}
    </div>
</div>