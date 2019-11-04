
@if($setting['form-method'] =='native')
<div class="box box-primary">
	<div class="box-header with-border">
			<div class="box-header-tools pull-right " >
				<a href="javascript:void(0)" class="collapse-close pull-right btn btn-xs btn-default" onclick="ajaxViewClose('#{{ $pageModule }}')"><i class="fa fa fa-times"></i></a>
			</div>
	</div>

	<div class="box-body">
@endif
			{!! Form::open(array('url'=>'suppliers/save/'.\App\Library\SiteHelpers::encryptID($row['supplierID']), 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ','id'=> 'suppliersFormAjax')) !!}
			<div class="col-md-12">
						<fieldset><legend> {{ Lang::get('core.suppliers') }}</legend>
				{!! Form::hidden('supplierID', $row['supplierID']) !!}
									  <div class="form-group  " >
										<label for="Supplier type" class=" control-label col-md-4 text-left">{{ Lang::get('core.suppliertype') }}<span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <select name='suppliertypeID' rows='5' id='suppliertypeID' class='select2 ' required  ></select>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Supplier Name" class=" control-label col-md-4 text-left"> {{ Lang::get('core.suppliername') }} <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <input  type='text' name='name' id='name' value='{{ $row['name'] }}'
						required     class='form-control ' />
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Email" class=" control-label col-md-4 text-left"> {{ Lang::get('core.email') }} <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <input  type='text' name='email' id='email' value='{{ $row['email'] }}'
						required     class='form-control ' />
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Phone" class=" control-label col-md-4 text-left"> {{ Lang::get('core.phone') }} </label>
										<div class="col-md-6">
										  <input  type='text' name='phone' id='phone' value='{{ $row['phone'] }}'
						     class='form-control ' />
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Address" class=" control-label col-md-4 text-left"> {{ Lang::get('core.address') }} </label>
										<div class="col-md-6">
										  <textarea name='address' rows='5' id='address' class='form-control '
				           >{{ $row['address'] }}</textarea>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Country" class=" control-label col-md-4 text-left"> {{ Lang::get('core.country') }} <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <select name='countryID' rows='5' id='countryID' class='select2 ' required  ></select>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="City" class=" control-label col-md-4 text-left"> {{ Lang::get('core.city') }} <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <select name='cityID' rows='5' id='cityID' class='select2 ' required  ></select>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Status" class=" control-label col-md-4 text-left"> {{ Lang::get('core.status') }} <span class="asterix"> * </span></label>
										<div class="col-md-6">

					<label class='radio radio-inline'>
					<input type='radio' name='status' value ='0' required @if($row['status'] == '0') checked="checked" @endif > {{ Lang::get('core.fr_minactive') }} </label>
					<label class='radio radio-inline'>
					<input type='radio' name='status' value ='1' required @if($row['status'] == '1') checked="checked" @endif > {{ Lang::get('core.fr_mactive') }} </label>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div> </fieldset>
			</div>




			<div style="clear:both"></div>

			<div class="form-group">
				<label class="col-sm-4 text-right">&nbsp;</label>
				<div class="col-sm-8">
					<button type="submit" class="btn btn-primary btn-sm "><i class="fa fa-play-circle"></i>  {{ Lang::get('core.sb_save') }} </button>
					<button type="button" onclick="ajaxViewClose('#{{ $pageModule }}')" class="btn btn-danger btn-sm"><i class="fa fa-remove "></i>  {{ Lang::get('core.sb_cancel') }} </button>
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

		$("#suppliertypeID").jCombo("{!! url('suppliers/comboselect?filter=def_supplier_type:suppliertypeID:supplier_type') !!}",
		{  selected_value : '{{ $row["suppliertypeID"] }}' });

		$("#countryID").jCombo("{!! url('suppliers/comboselect?filter=def_country:countryID:country_name') !!}",
		{  selected_value : '{{ $row["countryID"] }}' });

		$("#cityID").jCombo("{!! url('suppliers/comboselect?filter=def_city:cityID:city_name') !!}&parent=countryID:",
		{  parent: '#countryID', selected_value : '{{ $row["cityID"] }}' });


	$('.editor').summernote();
	$('.tips').tooltip();
	$(".select2").select2({ width:"98%" , dropdownParent: $('#mmb-modal-content')});
	$('.date').datepicker({format:'yyyy-mm-dd',autoClose:true})
	$('.datetime').datetimepicker({format: 'yyyy-mm-dd hh:ii'});
	$('input[type="checkbox"],input[type="radio"]').iCheck({
		checkboxClass: 'icheckbox_square-red',
		radioClass: 'iradio_square-red',
	});
		$('.removeMultiFiles').on('click',function(){
			var removeUrl = '{{ url("suppliers/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();
			return false;
		});

	var form = $('#suppliersFormAjax');
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
