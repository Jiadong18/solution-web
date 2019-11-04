
@if($setting['form-method'] =='native')
<div class="box box-primary">
	<div class="box-header with-border">
			<div class="box-header-tools pull-right " >
				<a href="javascript:void(0)" class="collapse-close pull-right btn btn-xs btn-default" onclick="ajaxViewClose('#{{ $pageModule }}')"><i class="fa fa fa-times"></i></a>
			</div>
	</div>

	<div class="box-body">
@endif
			{!! Form::open(array('url'=>'parkingandadmissionfees/save/'.\App\Library\SiteHelpers::encryptID($row['siteID']), 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ','id'=> 'parkingandadmissionfeesFormAjax')) !!}
			<div class="col-md-12">
						<fieldset><legend> {{Lang::get('core.parkingadmission')}}</legend>
				{!! Form::hidden('siteID', $row['siteID']) !!}
									  <div class="form-group  " >
										<label for="Admission Fee" class=" control-label col-md-4 text-left"> {{Lang::get('core.admissionfee')}} </label>
										<div class="col-md-3">
										  <input  type='text' name='admissionfee' id='admissionfee' value='{{ $row['admissionfee'] }}'
						     class='form-control ' />
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Car Parking" class=" control-label col-md-4 text-left"> {{Lang::get('core.carparking')}}</label>
										<div class="col-md-3">
										  <input  type='text' name='parkingfee_car' id='parkingfee_car' value='{{ $row['parkingfee_car'] }}'
						     class='form-control ' />
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Minibus Parking" class=" control-label col-md-4 text-left"> {{Lang::get('core.minibusparking')}}</label>
										<div class="col-md-3">
										  <input  type='text' name='parkingfee_minibus' id='parkingfee_minibus' value='{{ $row['parkingfee_minibus'] }}'
						     class='form-control ' />
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Bus Parking" class=" control-label col-md-4 text-left"> {{Lang::get('core.busparking')}} </label>
										<div class="col-md-3">
										  <input  type='text' name='parkingfee_bus' id='parkingfee_bus' value='{{ $row['parkingfee_bus'] }}'
						     class='form-control ' />
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Currency" class=" control-label col-md-4 text-left"> {{Lang::get('core.currency')}} </label>
										<div class="col-md-3">
										  <select name='currencyID' rows='5' id='currencyID' class='select2 '   ></select>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div> </fieldset>
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

		$("#currencyID").jCombo("{!! url('parkingandadmissionfees/comboselect?filter=def_currency:currencyID:currency_sym|symbol&limit=WHERE:status:=:1') !!}",
		{  selected_value : '{{ $row["currencyID"] }}' });


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
			var removeUrl = '{{ url("parkingandadmissionfees/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();
			return false;
		});

	var form = $('#parkingandadmissionfeesFormAjax');
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
$("input[name='admissionfee'],input[name='parkingfee_car'],input[name='parkingfee_minibus'],input[name='parkingfee_bus']").TouchSpin();
</script>
