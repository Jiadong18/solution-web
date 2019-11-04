
@if($setting['form-method'] =='native')
<div class="box box-primary">
	<div class="box-header with-border">
			<div class="box-header-tools pull-right " >
				<a href="javascript:void(0)" class="collapse-close pull-right btn btn-xs btn-default" onclick="ajaxViewClose('#{{ $pageModule }}')"><i class="fa fa fa-times"></i></a>
			</div>
	</div>

	<div class="box-body">
@endif
        @if ( \DB::table('invoice')->where('travellerID','=',app('request')->input('travellerID'))->count() ==0 && app('request')->input('travellerID') !='' )
        <div class="alert alert-danger alert-dismissible text-center">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="fa fa-warning fa-2x"></i>  {{ Lang::get('core.alert') }}</h4>
                        {{ Lang::get('core.alertbooking') }}
        </div>
        @endif
			{!! Form::open(array('url'=>'payments/save/'.\App\Library\SiteHelpers::encryptID($row['invoicePaymentID']), 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ','id'=> 'paymentsFormAjax')) !!}
			<div class="col-md-12">
				{!! Form::hidden('invoicePaymentID', $row['invoicePaymentID']) !!}
									  <div class="form-group  " >
										<label for="Traveller" class=" control-label col-md-4 text-left"> {{ Lang::get('core.traveller') }} </label>
										<div class="col-md-6">
								        @if ( app('request')->input('travellerID') =='')
                                        <select name='travellerID' rows='5' id='travellerID' class='select2 ' ></select>
                                        @else
                                    	<label for="Traveller" class=" control-label text-left">
            {{ \App\Library\SiteHelpers::formatLookUp( app('request')->input('travellerID'),'travellerID','1:travellers:travellerID:nameandsurname') }}                                       </label>
                                        {!! Form::hidden('travellerID', app('request')->input('travellerID') ) !!}
										 @endif
                                          </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Invoice NO" class=" control-label col-md-4 text-left"> {{ Lang::get('core.invoiceno') }}<span class="asterix"> * </span></label>
										<div class="col-md-3">
										  <select name='invoiceID' rows='5' id='invoiceID' class='select2 ' required  ></select>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Amount" class=" control-label col-md-4 text-left"> {{ Lang::get('core.amount') }} <span class="asterix"> * </span></label>
										<div class="col-md-3">
										  <input  type='text' name='amount' id='amount' value='@if (app('request')->input('maxamount') !='') {{ app('request')->input('maxamount') }} @else {{ $row['amount'] }} @endif'
						required     class='form-control ' />
										 </div>
                                            <div class="col-md-3">
										  <select name='currency' rows='5' id='currency' class='select2 ' required  ></select>
										 </div>

									  </div>
									  <div class="form-group  " >
										<label for="Payment Type" class=" control-label col-md-4 text-left"> {{ Lang::get('core.paymenttype') }}<span class="asterix"> * </span></label>
										<div class="col-md-3">
										  <select name='payment_type' rows='5' id='payment_type' class='select2 ' required  ></select>
										 </div>
										 <div class="col-md-3">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Payment Date" class=" control-label col-md-4 text-left">{{ Lang::get('core.paymentdate') }} <span class="asterix"> * </span></label>
										<div class="col-md-6">

				<div class="input-group m-b" style="width:150px !important;">
					{!! Form::text('payment_date', $row['payment_date'],array('class'=>'form-control date')) !!}
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
                <div class="form-group  " >
										<label for="Received" class=" control-label col-md-4 text-left"> {{Lang::get('core.received')}}</label>
										<div class="col-md-6">
										  <?php $received = explode(",",$row['received']); ?>
					 <label class='checked checkbox-inline'>
					<input type='checkbox' name='received[]' value ='1'   class=''
					@if(in_array('1',$received))checked @endif
					 /></label>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Notes" class=" control-label col-md-4 text-left"> {{ Lang::get('core.notes') }} </label>
										<div class="col-md-6">
										  <textarea name='notes' rows='5' id='notes' class='form-control '
				           >{{ $row['notes'] }}</textarea>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
			</div>




			<div style="clear:both"></div>

			<div class="form-group">
				<label class="col-sm-4 text-right">&nbsp;</label>
				<div class="col-sm-8">
					<button type="submit" class="btn btn-success btn-sm ">  {{ Lang::get('core.sb_save') }} </button>
					<button type="button" onclick="ajaxViewClose('#{{ $pageModule }}')" class="btn btn-danger btn-sm">  {{ Lang::get('core.sb_cancel') }} </button>
				</div>
			</div>
			{!! Form::close() !!}


@if($setting['form-method'] =='native')
	</div>
</div>
@endif


</div>

<script type="text/javascript">
$(document).ready(function() {

		$("#travellerID").jCombo("{!! url('payments/comboselect?filter=travellers:travellerID:nameandsurname') !!}",
        {  selected_value : '{{ $row["travellerID"] }}' });

		$("#invoiceID").jCombo("{!! url('payments/comboselect?filter=invoice:invoiceID:invoiceID') !!}&@if (app('request')->input('travellerID') !='' ) limit=WHERE:travellerID:=:{{ app('request')->input('travellerID') }} @else parent=travellerID: @endif",
		{  parent: '#travellerID', selected_value : '{{ $row["invoiceID"] }}' });

		$("#currency").jCombo("{!! url('payments/comboselect?filter=def_currency:currencyID:currency_sym|symbol&limit=WHERE:status:=:1') !!}",
		{  selected_value : '{{ $row["currency"] }}' });

		$("#payment_type").jCombo("{!! url('payments/comboselect?filter=def_payment_types:paymenttypeID:payment_type&limit=WHERE:status:=:1|icon') !!}",
		{  selected_value : '{{ $row["payment_type"] }}' });


	$('.editor').summernote();
	$('.tips').tooltip();
	$(".select2").select2({ width:"100%" , dropdownParent: $('#mmb-modal-content')});
	$('.date').datetimepicker({format: 'yyyy-mm-dd', autoclose:true , minView:2 , startView:2 , todayBtn:true });
	$('.datetime').datetimepicker({format: 'yyyy-mm-dd hh:ii:ss'});
	$('input[type="checkbox"],input[type="radio"]').iCheck({
		checkboxClass: 'icheckbox_square-red',
		radioClass: 'iradio_square-red',
	});
		$('.removeMultiFiles').on('click',function(){
			var removeUrl = '{{ url("payments/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();
			return false;
		});

	var form = $('#paymentsFormAjax');
	form.parsley();
	form.submit(function(){

		if(form.parsley('isValid') == true){
			var options = {
				dataType:      'json',
				beforeSubmit :  showRequest,
				success:       showResponse
			}
			$(this).ajaxSubmit(options);
			return false;

		} else {
			return false;
		}

	});

});

function showRequest()
{
	$('.ajaxLoading').show();
}
function showResponse(data)  {

	if(data.status == 'success')
	{
		ajaxViewClose('#{{ $pageModule }}');
		ajaxFilter('#{{ $pageModule }}','{{ $pageUrl }}/data');
		notyMessage(data.message);
		$('#mmb-modal').modal('hide');
	} else {
		notyMessageError(data.message);
		$('.ajaxLoading').hide();
		return false;
	}
}

</script>
<script>
    $("input[name='amount']").TouchSpin(
@if (app('request')->input('maxamount') !='')
    { max:{{ app('request')->input('maxamount') }}
    }
@endif
    );
</script>
