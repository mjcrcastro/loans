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

    $('body').on('focus', ".payment_date", function () {
        $(this).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            minDate: null,
            yearRange: "c-120:c+0"
        });
    });
    $(document).on('click', '#Disbursments', function () { //show modal for disbursments
        //Show modal bootstrap
        $('#dModal').modal('show');
        //return
    });

    $(document).on('click', '#Payments', function () { //show modal for payments
        //first create a payment schedule

        //check for emtpy values in the whole table
        if (dataInTable()) { //if table is emtpy
            fn_recreate(); //recreate table content
        } else {
            //do nothing
        }
        $('#pModal').modal('show');//Show modal bootstrap
        //return

    });
    function fn_recreate() {
        //append data to the modal 
        $list = '';
        var $nPeriods = $('#payments_qty').val();
        $('#pTable').remove();
        //Add create table contents
        for (nCount = 1; nCount <= $nPeriods; nCount++) {
            $list = $list + ' ' +
                    '<tr>' +
                    '<td class="col-xs-1 payment_count"> ' + nCount + ' </td> ' +
                    '<td class="col-xs-3"> {{ Form::text("schedule_date[]",null,array("class"=>"form-control payment_date")) }} </td>' +
                    '<td class="col-xs-3"> {{ Form::text("p_value[]",null,array("class"=>"form-control p_value")) }} </td>' +
                    '<td class="col-xs-3"> {{ Form::text("i_value[]",null,array("class"=>"form-control i_value")) }} </td>' +
                    '</tr>'
        }
        ;

        //attach table details to table structure
        $('<table class="table" id = "pTable" cellspacing="0" width="100%">' +
                ' <thead>' +
                '<tr>' +
                '<th></th>' +
                '<th>Date</th>' +
                '<th>Principal</th>' +
                '<th>Interest</th>' +
                '</tr>' +
                '</thead>' +
                $list +
                '<tfoot>' +
                '<tr>' +
                '<th></th>' +
                '<th>Date</th>' +
                '<th>Principal</th>' +
                '<th>Interest</th>' +
                '</tr>' +
                '</tfoot>' +
                '</table>').appendTo('#pList');
    }

    function dataInTable() {
        var $tableEmpty = true;

        $('.payment_date').each(function () {
            if (this.value !== "") {
                $tableEmpty = false;
            }
        });

        $('.payment_value').each(function () {
            if (this.value !== "") {
                $tableEmpty = false;
            }
        });

        return $tableEmpty;
    }

</script>

@if ($errors->any())
<div class="alert alert-warning">
    Errors found please check all tabs
</div>
@endif

<div class="tabbable"> <!-- Only required for left/right tabs -->
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab1" data-toggle="tab">Basics</a></li>
        <li><a href="#tab2" data-toggle="tab">Conditions</a></li>
        <li><a href="#tab3" data-toggle="tab">Management</a></li>
        <li><a href="#tab4" data-toggle="tab">Other</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab1">
            <p>
            <div class="form-group @if ($errors->has('borrower_id')) has-error @endif">
                {{ Form::label('borrower_id', Lang::get('loans.borrower').':') }}
                {{ Form::select('borrower_id', $contacts,null,array('class'=>"form-control")) }}
                @if ($errors->has('borrower_id')) 
                <div class="small">
                    {{ $errors->first('borrower_id', ':message') }} 
                </div>
                @endif
            </div>
            <div class="form-group @if ($errors->has('principal')) has-error @endif">
                {{ Form::label('principal', 'Principal:') }}
                {{ Form::text('principal',null,array('class'=>'form-control')) }}
                @if ($errors->has('principal')) 
                <div class="small">
                    {{ $errors->first('principal', ':message') }} 
                </div>
                @endif
            </div>
            <div class="form-group @if ($errors->has('loan_rate')) has-error @endif">
                {{ Form::label('loan_rate', Lang::get('loans.loan.rate').':') }}
                {{ Form::text('loan_rate',null,array('class'=>'form-control','id'=>'loan_rate')) }}
                @if ($errors->has('loan_rate')) 
                <div class="small">
                    {{ $errors->first('loan_rate', ':message') }} 
                </div>
                @endif
            </div>
            <div class="form-group @if ($errors->has('late_fee')) has-error @endif">
                {{ Form::label('late_fee', Lang::get('loans.late.fee').':') }}
                {{ Form::text('late_fee',null,array('class'=>'form-control','id'=>'late_fee')) }}
                @if ($errors->has('late_fee')) 
                <div class="small">
                    {{ $errors->first('late_fee', ':message') }} 
                </div>
                @endif
            </div>
        </div>
        <div class="tab-pane" id="tab2">
            <p>
            <div class="form-group @if ($errors->has('term_value')) has-error @endif">
                {{ Form::label('term_value', Lang::get('loans.term.value').':') }}
                {{ Form::text('term_value',null,array('class'=>'form-control')) }}
                @if ($errors->has('term_value')) 
                <div class="small">
                    {{ $errors->first('term_value', ':message') }} 
                </div>
                @endif
            </div>
            <div class="form-group @if ($errors->has('term_id')) has-error @endif">
                {{ Form::label('term_id', Lang::get('loans.term.id').':') }}
                {{ Form::select('term_id', $terms, null,array('class'=>'form-control')) }}
                @if ($errors->has('term_id')) 
                <div class="small">
                    {{ $errors->first('term_id', ':message') }} 
                </div>
                @endif
            </div>
            <div class="form-group @if ($errors->has('disbursments_qty')) has-error @endif">
                {{ Form::label('disbursments_qty', Lang::get('loans.disbursments_qty').':') }}
                {{ Form::text('disbursments_qty',1,array('class'=>'form-control')) }}
                @if ($errors->has('disbursments_qty')) 
                <div class="small">
                    {{ $errors->first('disbursments_qty', ':message') }} 
                </div>
                @endif
            </div>
            <div class="form-group @if ($errors->has('payments_qty')) has-error @endif">
                {{ Form::label('payments_qty', Lang::get('loans.payments_qty').':') }}
                {{ Form::text('payments_qty',null,array('class'=>'form-control')) }}
                @if ($errors->has('payments_qty')) 
                <div class="small">
                    {{ $errors->first('payments_qty', ':message') }} 
                </div>
                @endif
            </div>
        </div>
        <div class="tab-pane" id="tab3">
            <p>
            <div class="form-group @if ($errors->has('approval_date')) has-error @endif">
                {{ Form::label('approval_date', 'Approval date:') }}
                {{ Form::text('approval_date',null,array('class'=>'form-control')) }}
                @if ($errors->has('approval_date')) 
                <div class="small">
                    {{ $errors->first('approval_date', ':message') }} 
                </div>
                @endif
            </div>
            <div class="form-group @if ($errors->has('loan_category_id')) has-error @endif">
                {{ Form::label('loan_category_id', Lang::get('loans.category').':') }}
                {{ Form::select('loan_category_id', $loan_categories,null,array('class'=>"form-control")) }}
                @if ($errors->has('loan_category_id')) 
                <div class="small">
                    {{ $errors->first('loan_category_id', ':message') }} 
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
            <div class="form-group @if ($errors->has('agent_id')) has-error @endif">
                {{ Form::label('agent_id', Lang::get('loans.agent.singular').':') }}
                {{ Form::select('agent_id', $contacts,null,array('class'=>"form-control")) }}
                @if ($errors->has('agent_id')) 
                <div class="small">
                    {{ $errors->first('agent_id', ':message') }} 
                </div>
                @endif
            </div>
        </div>
        <div class="tab-pane" id="tab4">
            <p>
            <div class="form-group @if ($errors->has('loan_status_id')) has-error @endif">
                {{ Form::label('loan_status_id', Lang::get('loans.status').':') }}
                {{ Form::select('loan_status_id', $loan_statuses,null,array('class'=>"form-control")) }}
                @if ($errors->has('loan_status_id')) 
                <div class="small">
                    {{ $errors->first('loan_status_id', ':message') }} 
                </div>
                @endif
            </div>
            <div class="form-group @if ($errors->has('fund_id')) has-error @endif">
                {{ Form::label('fund_id', 'Fund:') }}
                {{ Form::select('fund_id', $funds,null,array('class'=>"form-control")) }}
                @if ($errors->has('fund_id')) 
                <div class="small">
                    {{ $errors->first('fund_id', ':message') }} 
                </div>
                @endif
            </div>
            <div class="form-group @if ($errors->has('contract_URL')) has-error @endif">
                {{ Form::label('contract_URL', 'Contract URL:') }}
                {{ Form::text('contract_URL',null,array('class'=>'form-control','id'=>'contract_URL')) }}
                @if ($errors->has('contract_URL')) 
                <div class="small">
                    {{ $errors->first('contract_URL', ':message') }} 
                </div>
                @endif
            </div>
            <div class="container-fluid">
                {{ Form::label('Schedules', ' ') }}
                <div class="row">
                    {{ link_to('#', 'Disbursments',array('class'=>'btn btn-primary col-xs-6','id'=>'Disbursments')) }}
                    {{ link_to('#', 'Payments',array('class'=>'btn btn-primary col-xs-6','id'=>'Payments')) }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row-fluid">
    <div class="form-group">    
        {{ Form::submit('Submit', array('class'=>'btn  btn-primary col-xs-6')) }}
        {{ link_to_route('loans.index', 'Cancel', [],array('class'=>'btn btn-default col-xs-6')) }}
    </div>
</div>

{{-- bootstrap modal for disbursments--}}
<div class="modal fade" id="dModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Disbursments Schedule</h4>
            </div>
            <div class="modal-body">
                <table id="dList" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Date</th>
                            <th>Principal</th>
                            <th>Interest</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th></th>
                            <th>Date</th>
                            <th>Principal</th>
                            <th>Interest</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- bootstrap modal disbursments --}}

{{-- bootstrap modal for payments --}}
<div class="modal fade" id="pModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Payments Schedule</h4>
                <button type="button" class="btn btn-warning pull-left" data-dismiss="modal" aria-label="Recalculate"><span aria-hidden="true">Recalculate</span></button>
                <button type="button" class="btn btn-primary pull-right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Close</span></button>
            </div>
            <div class="modal-body">
                <div id="pList">
                    @if ($payments_schedule->count())
                    {{-- TODO create a more elegant way of showing payment schedules--}}    
                    <table class="table" id = "pTable" cellspacing="0" width="100%">' +
                        <thead>
                            <tr>
                                <th></th>
                                <th>Date</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        @foreach ($payments_schedule as $payments_item)
                        <tr>
                            <td class="col-xs-1 payment_count">  {{ $payments_item->id }}  </td> 
                            <td class="col-xs-3"> {{ Form::text("schedule_date[]",$payments_item->schedule_date,array("class"=>"form-control schedule_date")) }} </td>
                            <td class="col-xs-3"> {{ Form::text("p_value[]",$payments_item->p_value + $payments_item->p_value,array("class"=>"form-control p_value")) }} </td>
                            <td class="col-xs-3"> {{ Form::text("i_value[]",$payments_item->p_value + $payments_item->i_value,array("class"=>"form-control i_value")) }} </td>
                        </tr>
                        @endforeach
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Date</th>
                                <th>Value</th>
                            </tr>
                        </tfoot>
                    </table>
                    @else

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
{{-- bootstrap modal payments --}}