
@if($setting['form-method'] =='native')
<div class="box box-primary">
	<div class="box-header with-border">
			<div class="box-header-tools pull-right " >
				<a href="javascript:void(0)" class="collapse-close pull-right btn btn-xs btn-default" onclick="ajaxViewClose('#{{ $pageModule }}')"><i class="fa fa fa-times"></i></a>
			</div>
	</div>

	<div class="box-body">
@endif
			{!! Form::open(array('url'=>'groupsales/save/'.\App\Library\SiteHelpers::encryptID($row['saleID']), 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ','id'=> 'groupsalesFormAjax')) !!}
			<div class="col-md-12">
						<fieldset><legend> {{ Lang::get('core.groupsales') }}</legend>
				{!! Form::hidden('saleID', $row['saleID']) !!}
									  <div class="form-group  " >
										<label for="Tour Name" class=" control-label col-md-4 text-left"> {{ Lang::get('core.tourname') }} <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <select name='tourID' rows='5' id='tourID' class='select2 ' required  ></select>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Tour Date" class=" control-label col-md-4 text-left"> {{ Lang::get('core.tourdate') }} </label>
										<div class="col-md-4">
										  <select name='tourdateID' rows='5' id='tourdateID' class='select2 '   ></select>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Shopping Date" class=" control-label col-md-4 text-left"> {{ Lang::get('core.shoppingdate') }} <span class="asterix"> * </span></label>
										<div class="col-md-6">

				<div class="input-group m-b" style="width:150px !important;">
					{!! Form::text('shopping_date', $row['shopping_date'],array('class'=>'form-control date')) !!}
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Supplier Name" class=" control-label col-md-4 text-left"> {{ Lang::get('core.suppliername') }} <span class="asterix"> * </span></label>
										<div class="col-md-4">
										  <select name='supplierID' rows='5' id='supplierID' class='select2 ' required  ></select>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Amount" class=" control-label col-md-4 text-left"> {{ Lang::get('core.amount') }} <span class="asterix"> * </span></label>
										<div class="col-md-4">
										  <input  type='text' name='amount' id='amount' value='{{ $row['amount'] }}'
						required     class='form-control ' />
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Currency" class=" control-label col-md-4 text-left"> {{ Lang::get('core.currency') }} <span class="asterix"> * </span></label>
										<div class="col-md-4">
										  <select name='currencyID' rows='5' id='currencyID' class='select2 ' required  ></select>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Note" class=" control-label col-md-4 text-left"> {{ Lang::get('core.note') }} </label>
										<div class="col-md-6">
										  <textarea name='note' rows='4' id='note' class='form-control '
				           >{{ $row['note'] }}</textarea>
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

		$("#tourID").jCombo("{!! url('groupsales/comboselect?filter=tours:tourID:tour_name') !!}",
		{  selected_value : '{{ $row["tourID"] }}' });

		$("#tourdateID").jCombo("{!! url('groupsales/comboselect?filter=tour_date:tourdateID:start&limit=WHERE:status:!=:2') !!}&parent=tourID:",
		{  parent: '#tourID', selected_value : '{{ $row["tourdateID"] }}' });

		$("#supplierID").jCombo("{!! url('groupsales/comboselect?filter=def_supplier:supplierID:name&limit=WHERE:status:=:1') !!}",
		{  selected_value : '{{ $row["supplierID"] }}' });

		$("#currencyID").jCombo("{!! url('groupsales/comboselect?filter=def_currency:currencyID:currency_sym|symbol&limit=WHERE:status:=:1') !!}",
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
			var removeUrl = '{{ url("groupsales/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();
			return false;
		});

	var form = $('#groupsalesFormAjax');
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
    $("input[name='amount']").TouchSpin();
</script>
