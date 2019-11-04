
@if($setting['form-method'] =='native')
<div class="box box-primary">
	<div class="box-header with-border">
			<div class="box-header-tools pull-right " >
				<a href="javascript:void(0)" class="collapse-close pull-right btn btn-xs btn-default" onclick="ajaxViewClose('#{{ $pageModule }}')"><i class="fa fa fa-times"></i></a>
			</div>
	</div>

	<div class="box-body">
@endif
			{!! Form::open(array('url'=>'vehicletypes/save/'.\App\Library\SiteHelpers::encryptID($row['vehicleID']), 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ','id'=> 'vehicletypesFormAjax')) !!}
			<div class="col-md-12">
						<fieldset><legend>{{Lang::get('core.vehicletypes')}}</legend>
				{!! Form::hidden('vehicleID', $row['vehicleID']) !!}
									  <div class="form-group  " >
										<label for="Vehicle Name" class=" control-label col-md-4 text-left"> {{Lang::get('core.vehiclename')}} <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <input  type='text' name='vehicle_name' id='vehicle_name' value='{{ $row['vehicle_name'] }}'
						required     class='form-control ' />
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Capacity" class=" control-label col-md-4 text-left"> {{Lang::get('core.capacity')}} <span class="asterix"> * </span></label>
										<div class="col-md-3">
										  <input  type='text' name='capacity' id='capacity' value='{{ $row['capacity'] }}'
						required     class='form-control ' />
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Supplier Name" class=" control-label col-md-4 text-left"> {{Lang::get('core.suppliername')}} <span class="asterix"> * </span></label>
										<div class="col-md-3">
										  <select name='supplier_id' rows='5' id='supplier_id' class='select2 ' required  ></select>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Cost" class=" control-label col-md-4 text-left"> {{Lang::get('core.cost')}} <span class="asterix"> * </span></label>
										<div class="col-md-3">
										  <input  type='text' name='cost' id='cost' value='{{ $row['cost'] }}'
						required     class='form-control ' />
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Currency" class=" control-label col-md-4 text-left"> {{Lang::get('core.currency')}} <span class="asterix"> * </span></label>
										<div class="col-md-3">
										  <select name='currencyID' rows='5' id='currencyID' class='select2 ' required  ></select>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Notes" class=" control-label col-md-4 text-left"> {{Lang::get('core.notes')}} </label>
										<div class="col-md-6">
										  <textarea name='notes' rows='5' id='notes' class='form-control '
				           >{{ $row['notes'] }}</textarea>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Status" class=" control-label col-md-4 text-left"> {{Lang::get('core.status')}} <span class="asterix"> * </span></label>
										<div class="col-md-6">

					<label class='radio radio-inline'>
					<input type='radio' name='status' value ='0' required @if($row['status'] == '0') checked="checked" @endif > {{Lang::get('core.fr_minactive')}} </label>
					<label class='radio radio-inline'>
					<input type='radio' name='status' value ='1' required @if($row['status'] == '1') checked="checked" @endif > {{Lang::get('core.fr_mactive')}} </label>
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

		$("#supplier_id").jCombo("{!! url('vehicletypes/comboselect?filter=def_supplier:supplierID:name&limit=WHERE:status:=:1') !!}",
		{  selected_value : '{{ $row["supplier_id"] }}' });

		$("#currencyID").jCombo("{!! url('vehicletypes/comboselect?filter=def_currency:currencyID:currency_sym|symbol&limit=WHERE:status:=:1') !!}",
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
			var removeUrl = '{{ url("vehicletypes/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();
			return false;
		});

	var form = $('#vehicletypesFormAjax');
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
    $("input[name='capacity'],input[name='cost']").TouchSpin();
</script>
