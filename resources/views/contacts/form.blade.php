{{--This stub is a form for both editing and creating contacts, see usages in
    views contacts.create and contacts.edit --}}

<script type='text/javascript'>
    /*Shows a datepicker widget for
     * the purchase_date text input control
     */
    $(function () {
        $("#birthdate").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            minDate: null,
            yearRange: "c-120:c+0"
        });
    });
</script>

@if ($errors->any())
    <div class="alert alert-warning">
        Errors found please check all tabs
    </div>
@endif

<div class="tabbable"> <!-- Only required for left/right tabs -->
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab1" data-toggle="tab">General Info</a></li>
        <li><a href="#tab2" data-toggle="tab">Contact Info</a></li>
        <li><a href="#tab3" data-toggle="tab">Other Info</a></li>
        <li><a href="#tab4" data-toggle="tab">Picture/Notes</a></li>
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
        </div>
        <div class="tab-pane" id="tab2">
            <p>
            <div class="form-group @if ($errors->has('municipality_id')) has-error @endif">
                {{ Form::label('municipality', Lang::get('municipalities.singular').':') }}
                {{ Form::select('municipality_id', $municipalities,null,array('class'=>"form-control")) }}
                @if ($errors->has('municipality_id')) 
                <div class="small">
                    {{ $errors->first('municipality_id', ':message') }} 
                </div>
                @endif
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
                {{ Form::label('taxid', Lang::get('contacts.taxid').':') }}
                {{ Form::text('taxid',null,array('class'=>'form-control')) }}
            </div>
            <div class="form-group @if ($errors->has('birthdate')) has-error @endif">
                {{ Form::label('birthdate', 'Birthdate:') }}
                {{ Form::text('birthdate',null,array('class'=>'form-control','id'=>'birthdate')) }}
                @if ($errors->has('birthdate')) 
                <div class="small">
                    {{ $errors->first('birthdate', ':message') }} 
                </div>
                @endif
            </div>
            <div class="form-group @if ($errors->has('occupation_id')) has-error @endif">
                {{ Form::label('occupation', Lang::get('occupations.singular').':') }}
                {{ Form::select('occupation_id', $occupations,null,array('class'=>"form-control")) }}
                @if ($errors->has('occupation_id')) 
                <div class="small">
                    {{ $errors->first('occupation_id', ':message') }} 
                </div>
                @endif
            </div>
            <div class="form-group">
                {{ Form::label('employer_id', 'Employer:') }}
                {{ Form::select('employer_id', array_merge(['0' => 'Self Employed'], $employers->toArray()),null,array('class'=>'form-control')) }}
            </div>
        </div>
        <div class="tab-pane" id="tab4">
            <p>
            <div class="form-group">
                {{ Form::label('picture', 'Picture:') }}
                {{ Form::text('picture',null,array('class'=>'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('notes', 'Notes:') }}
                {{ Form::textarea('notes',null,array('class'=>'form-control','rows'=>8)) }}
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