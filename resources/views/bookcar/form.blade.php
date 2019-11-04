
@if($setting['form-method'] =='native')
<div class="box box-primary">
	<div class="box-header with-border">
			<div class="box-header-tools pull-right " >
				<a href="javascript:void(0)" class="collapse-close pull-right btn btn-xs btn-default" onclick="ajaxViewClose('#{{ $pageModule }}')"><i class="fa fa fa-times"></i></a>
			</div>
	</div>

	<div class="box-body">
@endif
			{!! Form::open(array('url'=>'bookcar/save/'.\App\Library\SiteHelpers::encryptID($row['bookcarID']), 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ','id'=> 'bookcarFormAjax')) !!}
			<div class="col-md-12">
						<fieldset><legend>{{ Lang::get('core.bookcar') }}</legend>
				{!! Form::hidden('bookcarID', $row['bookcarID']) !!}
                {!! Form::hidden('bookingID', app('request')->input('bookingID') ) !!}
									  <div class="form-group  " >
										<label for="Brand" class=" control-label col-md-4 text-left"> {{ Lang::get('core.brand') }} <span class="asterix"> * </span></label>
										<div class="col-md-4">
										  <select name='carbrandID' rows='5' id='carbrandID' class='select2 ' required  ></select>
										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Model" class=" control-label col-md-4 text-left"> {{ Lang::get('core.model') }} <span class="asterix"> * </span></label>
										<div class="col-md-4">
										  <select name='carsID' rows='5' id='carsID' class='select2 ' required  ></select>
										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Start" class=" control-label col-md-4 text-left"> {{ Lang::get('core.start') }} <span class="asterix"> * </span></label>
										<div class="col-md-7">

				<div class="input-group m-b" style="width:150px !important;">
					{!! Form::text('start', $row['start'],array('class'=>'form-control date')) !!}
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div>
										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="End" class=" control-label col-md-4 text-left"> {{ Lang::get('core.end') }} <span class="asterix"> * </span></label>
										<div class="col-md-7">

				<div class="input-group m-b" style="width:150px !important;">
					{!! Form::text('end', $row['end'],array('class'=>'form-control date')) !!}
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div>
										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Pickup" class=" control-label col-md-4 text-left"> {{ Lang::get('core.pickup') }} </label>
										<div class="col-md-4">
										  <input  type='text' name='pickup' id='pickup' value='{{ $row['pickup'] }}'
						     class='form-control ' />
										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Dropoff" class=" control-label col-md-4 text-left"> {{ Lang::get('core.dropoff') }} </label>
										<div class="col-md-4">
										  <input  type='text' name='dropoff' id='dropoff' value='{{ $row['dropoff'] }}'
						     class='form-control ' />
										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Rate" class=" control-label col-md-4 text-left"> {{ Lang::get('core.rate') }} <span class="asterix"> * </span></label>
										<div class="col-md-3">

					<?php $rate = explode(',',$row['rate']);
					$rate_opt = array( '1' => Lang::get('core.dailyrate') ,  '2' => Lang::get('core.weeklyrate') ,  '3' => Lang::get('core.monthlyrate') , ); ?>
					<select name='rate' rows='5' required  class='select2 '  >
						<?php
						foreach($rate_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['rate'] == $key ? " selected='selected' " : '' ).">$val</option>";
						}
						?></select>
										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Status" class=" control-label col-md-4 text-left"> {{ Lang::get('core.status') }} <span class="asterix"> * </span></label>
										<div class="col-md-8">
					<label class='radio radio-inline'>
					<input type='radio' name='status' value ='2' required @if($row['status'] == '2') checked="checked" @endif > {{ Lang::get('core.fr_pending') }} </label>
					<label class='radio radio-inline'>
					<input type='radio' name='status' value ='1' required @if($row['status'] == '1') checked="checked" @endif > {{ Lang::get('core.confirmed') }} </label>
					<label class='radio radio-inline'>
					<input type='radio' name='status' value ='0' required @if($row['status'] == '0') checked="checked" @endif > {{ Lang::get('core.cancelled') }} </label>
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

		$("#carbrandID").jCombo("{!! url('bookcar/comboselect?filter=def_car_brands:carbrandID:brand&limit=WHERE:status:=:1') !!}",
		{  selected_value : '{{ $row["carbrandID"] }}' });

		$("#carsID").jCombo("{!! url('bookcar/comboselect?filter=cars:carsID:model&limit=WHERE:status:=:1') !!}&parent=carbrandID:",
		{  parent: '#carbrandID', selected_value : '{{ $row["carsID"] }}' });


	$('.editor').summernote();
	$('.tips').tooltip();
	$(".select2").select2({ width:"100%" , dropdownParent: $('#mmb-modal-content')});
	$('.date').datetimepicker({format: 'yyyy-mm-dd', autoclose:true , minView:2 , startView:2 , todayBtn:true });
	$('.datetime').datetimepicker({format: 'yyyy-mm-dd hh:ii'});
	$('input[type="checkbox"],input[type="radio"]').iCheck({
		checkboxClass: 'icheckbox_square-red',
		radioClass: 'iradio_square-red',
	});
		$('.removeMultiFiles').on('click',function(){
			var removeUrl = '{{ url("bookcar/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();
			return false;
		});

	var form = $('#bookcarFormAjax');
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
        setTimeout(location.reload.bind(location), 3000);
	} else {
		notyMessageError(data.message);
		$('.ajaxLoading').hide();
		return false;
	}
}

</script>
