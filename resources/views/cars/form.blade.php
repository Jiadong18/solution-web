
@if($setting['form-method'] =='native')
<div class="box box-primary">
	<div class="box-header with-border">
			<div class="box-header-tools pull-right " >
				<a href="javascript:void(0)" class="collapse-close pull-right btn btn-xs btn-default" onclick="ajaxViewClose('#{{ $pageModule }}')"><i class="fa fa fa-times"></i></a>
			</div>
	</div>

	<div class="box-body">
@endif
			{!! Form::open(array('url'=>'cars/save/'.\App\Library\SiteHelpers::encryptID($row['carsID']), 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ','id'=> 'carsFormAjax')) !!}
			<div class="col-md-12">
						<fieldset><legend> {{Lang::get('core.cars')}}</legend>
				{!! Form::hidden('carsID', $row['carsID']) !!}
									  <div class="form-group  " >
										<label for="Car Brand" class=" control-label col-md-4 text-left"> {{Lang::get('core.brand')}}<span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <select name='carbrandID' rows='5' id='carbrandID' class='select2 ' required  ></select>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Model" class=" control-label col-md-4 text-left"> {{Lang::get('core.model')}} <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <input  type='text' name='model' id='model' value='{{ $row['model'] }}'
						required     class='form-control ' />
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Description" class=" control-label col-md-4 text-left"> {{Lang::get('core.description')}} <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <textarea name='description' rows='5' id='description' class='form-control '
				         required  >{{ $row['description'] }}</textarea>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Passengers" class=" control-label col-md-4 text-left"> {{Lang::get('core.passengers')}} <span class="asterix"> * </span></label>
										<div class="col-md-6">

					<?php $passengers = explode(',',$row['passengers']);
					$passengers_opt = array( '2' => '2' ,  '3' => '3' ,  '4' => '4' ,  '5' => '5' ,  '6' => '6' , ); ?>
					<select name='passengers' rows='5' required  class='select2 '  >
						<?php
						foreach($passengers_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['passengers'] == $key ? " selected='selected' " : '' ).">$val</option>";
						}
						?></select>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Car Doors" class=" control-label col-md-4 text-left"> {{Lang::get('core.cardoors')}} <span class="asterix"> * </span></label>
										<div class="col-md-6">

					<?php $cardoors = explode(',',$row['cardoors']);
					$cardoors_opt = array( '2' => '2' ,  '3' => '3' ,  '4' => '4' ,  '5' => '5' , ); ?>
					<select name='cardoors' rows='5' required  class='select2 '  >
						<?php
						foreach($cardoors_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['cardoors'] == $key ? " selected='selected' " : '' ).">$val</option>";
						}
						?></select>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Transmission" class=" control-label col-md-4 text-left"> {{Lang::get('core.transmission')}} <span class="asterix"> * </span></label>
										<div class="col-md-6">

					<?php $transmission = explode(',',$row['transmission']);
					$transmission_opt = array( '1' => 'Auto' ,  '2' => 'Manual' ,  '0' => 'Other' , ); ?>
					<select name='transmission' rows='5' required  class='select2 '  >
						<?php
						foreach($transmission_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['transmission'] == $key ? " selected='selected' " : '' ).">$val</option>";
						}
						?></select>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Baggage" class=" control-label col-md-4 text-left"> {{Lang::get('core.baggage')}} <span class="asterix"> * </span></label>
										<div class="col-md-6">

					<?php $baggage = explode(',',$row['baggage']);
					$baggage_opt = array( 'X1' => 'X1' ,  'X2' => 'X2' ,  'X3' => 'X3' ,  'X4' => 'X4' ,  'X5' => 'X5' ,  'X6' => 'X6' , ); ?>
					<select name='baggage' rows='5' required  class='select2 '  >
						<?php
						foreach($baggage_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['baggage'] == $key ? " selected='selected' " : '' ).">$val</option>";
						}
						?></select>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Type" class=" control-label col-md-4 text-left"> {{Lang::get('core.type')}} <span class="asterix"> * </span></label>
										<div class="col-md-6">

					<?php $type = explode(',',$row['type']);
					$type_opt = array( '1' => 'Van' ,  '2' => 'Luxury' ,  '3' => 'Fullsize' ,  '4' => 'Standart' ,  '5' => 'Compact' ,  '6' => 'Economy' ,  '7' => 'Mini' , ); ?>
					<select name='type' rows='5' required  class='select2 '  >
						<?php
						foreach($type_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['type'] == $key ? " selected='selected' " : '' ).">$val</option>";
						}
						?></select>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Featured" class=" control-label col-md-4 text-left"> {{Lang::get('core.featured')}} </label>
										<div class="col-md-6">
										  <?php $featured = explode(",",$row['featured']); ?>
					 <label class='checked checkbox-inline'>
					<input type='checkbox' name='featured[]' value ='1'   class=''
					@if(in_array('1',$featured))checked @endif
					 />  </label>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Daily Rate" class=" control-label col-md-4 text-left"> {{Lang::get('core.dailyrate')}} </label>
										<div class="col-md-6">
										  <input  type='text' name='dayrate' id='dayrate' value='{{ $row['dayrate'] }}'
						     class='form-control ' />
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Weekly Rate" class=" control-label col-md-4 text-left"> {{Lang::get('core.weeklyrate')}} </label>
										<div class="col-md-6">
										  <input  type='text' name='weekrate' id='weekrate' value='{{ $row['weekrate'] }}'
						     class='form-control ' />
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Monthly Rate" class=" control-label col-md-4 text-left"> {{Lang::get('core.monthlyrate')}}</label>
										<div class="col-md-6">
										  <input  type='text' name='monthrate' id='monthrate' value='{{ $row['monthrate'] }}'
						     class='form-control ' />
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Currency" class=" control-label col-md-4 text-left"> {{Lang::get('core.currency')}} </label>
										<div class="col-md-6">
										  <select name='currencyID' rows='5' id='currencyID' class='select2 '   ></select>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Images" class=" control-label col-md-4 text-left"> {{Lang::get('core.images')}}</label>
										<div class="col-md-6">

					<a href="javascript:void(0)" class="btn btn-xs btn-primary pull-right tips" title="Add More Images" onclick="addMoreFiles('images')"><i class="fa fa-plus-square-o fa-2x"></i></a>
					<div class="imagesUpl">
					 	<input  type='file' name='images[]'  />
					</div>
					<ul class="uploadedLists " >
					<?php $cr= 0;
					$row['images'] = explode(",",$row['images']);
					?>
					@foreach($row['images'] as $files)

                        @if(file_exists('./uploads/images/'.$files) && $files !='')
						<li id="cr-<?php echo $cr;?>" class="list-group-item">
                        <span class="pull-left removeMultiFiles " rel="cr-<?php echo $cr;?>" url="/uploads/images/{{$files}}">
							<i class="fa fa-trash-o fa-2x text-red tips" data-toggle="confirmation"
                               data-title="{{Lang::get('core.rusure')}}"
                               data-content="{{ Lang::get('core.youwanttodeletethis') }}" ></i></span>

                            {!! \App\Library\SiteHelpers::showUploadedFile($files,'/uploads/images/') !!}
							<input type="hidden" name="currimages[]" value="{{ $files }}"/>
							<?php ++$cr;?>
						</li>
						@endif


					@endforeach
					</ul>

										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Airport Pickup" class=" control-label col-md-4 text-left"> {{Lang::get('core.airportpickup')}} </label>
										<div class="col-md-6">
										  <?php $airportpickup = explode(",",$row['airportpickup']); ?>
					 <label class='checked checkbox-inline'>
					<input type='checkbox' name='airportpickup[]' value ='1'   class=''
					@if(in_array('1',$airportpickup))checked @endif
					 /> </label>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Available Extras" class=" control-label col-md-4 text-left"> {{Lang::get('core.availableextras')}} </label>
										<div class="col-md-6">
										  <select name='availableextras[]' multiple rows='5' id='availableextras' class='select2 '   ></select>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Status" class=" control-label col-md-4 text-left"> {{Lang::get('core.status')}} <span class="asterix"> * </span></label>
										<div class="col-md-6">

					<label class='radio radio-inline'>
					<input type='radio' name='status' value ='1' required @if($row['status'] == '1') checked="checked" @endif > {{Lang::get('core.fr_mactive')}} </label>
					<label class='radio radio-inline'>
					<input type='radio' name='status' value ='0' required @if($row['status'] == '0') checked="checked" @endif > {{Lang::get('core.fr_minactive')}} </label>
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

		$("#carbrandID").jCombo("{!! url('cars/comboselect?filter=def_car_brands:carbrandID:brand') !!}",
		{  selected_value : '{{ $row["carbrandID"] }}' });

		$("#currencyID").jCombo("{!! url('cars/comboselect?filter=def_currency:currencyID:currency_sym|symbol') !!}",
		{  selected_value : '{{ $row["currencyID"] }}' });

		$("#availableextras").jCombo("{!! url('cars/comboselect?filter=def_car_extras:carsextrasID:name') !!}",
		{  selected_value : '{{ $row["availableextras"] }}' });

    $('[data-toggle=confirmation]').confirmation({
    rootSelector: '[data-toggle=confirmation]',
    container: 'body'
    });
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
        if(confirm('{{Lang::get('core.newtranslation')}} Are you sure you want to delete this image ?'))
		{
			var removeUrl = '{{ url("cars/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();
			return false;

        } else {
			return false;
		}
		return false;

		});


	var form = $('#carsFormAjax');
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
