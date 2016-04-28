{{--This stub is a form for both editing and creating contacts, see usages in
    views contacts.create and contacts.edit --}}

<script type='text/javascript'>
    /*Shows a datepicker widget for
     * the purchase_date text input control
     */
    $(function () {
        $("#approval_date").datepicker({
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
        <li><a href="#tab2" data-toggle="tab">Details</a></li>
        <li><a href="#tab3" data-toggle="tab">Other Info</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab1">
            <p>
            <div class="form-group">
                {{ Form::label('borrower', Lang::get('loans.borrower').':') }}
                {{ Form::select('borrower_id', $contacts,null,array('class'=>"form-control")) }}
            </div>
            <div class="form-group">
                {{ Form::label('approval_date', 'Approval date:') }}
                {{ Form::text('approval_date',null,array('class'=>'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('principal', 'Principal:') }}
                {{ Form::text('principal',null,array('class'=>'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('term', Lang::get('loans.term.days').':') }}
                {{ Form::text('term',null,array('class'=>'form-control')) }}
            </div>
        </div>
        <div class="tab-pane" id="tab2">
            <p>
            <div class="form-group @if ($errors->has('loan_rate')) has-error @endif">
                {{ Form::label('loan_rate', 'Loan rate:') }}
                {{ Form::text('loan_rate',null,array('class'=>'form-control','id'=>'loan_rate')) }}
                @if ($errors->has('loan_rate')) 
                <div class="small">
                    {{ $errors->first('loan_rate', ':message') }} 
                </div>
                @endif
            </div>
            <div class="form-group @if ($errors->has('late_fee')) has-error @endif">
                {{ Form::label('late_fee', 'Late fee') }}
                {{ Form::text('late_fee',null,array('class'=>'form-control','id'=>'late_fee')) }}
                @if ($errors->has('late_fee')) 
                <div class="small">
                    {{ $errors->first('late_fee', ':message') }} 
                </div>
                @endif
            </div>
            <div class="form-group @if ($errors->has('guarantor_id')) has-error @endif">
                {{ Form::label('guarantor_id', Lang::get('loans.guarantor.singular').':') }}
                {{ Form::select('guarantor_id', $contacts,null,array('class'=>"form-control")) }}
                @if ($errors->has('guarantor_id')) 
                <div class="small">
                    {{ $errors->first('guarantor_id', ':message') }} 
                </div>
                @endif
            </div>
            <div class="form-group @if ($errors->has('loan_status_id')) has-error @endif">
                {{ Form::label('loan_status_id', Lang::get('loans.status').':') }}
                {{ Form::select('loan_status_id', $contacts,null,array('class'=>"form-control")) }}
                @if ($errors->has('loan_status_id')) 
                <div class="small">
                    {{ $errors->first('loan_status_id', ':message') }} 
                </div>
                @endif
            </div>
        </div>
        <div class="tab-pane" id="tab3">
            <p>
            <div class="form-group @if ($errors->has('agent_id')) has-error @endif">
                {{ Form::label('agent_id', Lang::get('loans.agent.singular').':') }}
                {{ Form::select('agent_id', $contacts,null,array('class'=>"form-control")) }}
                @if ($errors->has('agent_id')) 
                <div class="small">
                    {{ $errors->first('agent_id', ':message') }} 
                </div>
                @endif
            </div>
            <div class="form-group">
                {{ Form::label('fund_id', 'Fund:') }}
                {{ Form::text('fund_id',null,array('class'=>'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::label('loan_category_id', Lang::get('loans.category').':') }}
                {{ Form::text('loan_category_id',null,array('class'=>"form-control")) }}
            </div>
            <div class="form-group">
                {{ Form::label('contract_URL', 'Contract URL:') }}
                {{ Form::text('contract_URL',null,array('class'=>'form-control','id'=>'contract_URL')) }}
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