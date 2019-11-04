
@if($setting['form-method'] =='native')
<div class="box box-primary">
	<div class="box-header with-border">
			<div class="box-header-tools pull-right " >
				<a href="javascript:void(0)" class="collapse-close pull-right btn btn-xs btn-default" onclick="ajaxViewClose('#{{ $pageModule }}')"><i class="fa fa fa-times fa-2x"></i></a>
			</div>
	</div>

	<div class="box-body">
@endif
			{!! Form::open(array('url'=>'hotelrates/save/'.\App\Library\SiteHelpers::encryptID($row['hotelrateid']), 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ','id'=> 'hotelratesFormAjax')) !!}
			<div class="col-md-12">
						<fieldset><legend>{{Lang::get('core.hotelrate')}}</legend>
				{!! Form::hidden('hotelrateid', $row['hotelrateid']) !!}
            {!! Form::hidden('hotelID', app('request')->input('hotelID') ) !!}

									  <div class="form-group  " >
										<label for="Room Type" class=" control-label col-md-4 text-left"> {{Lang::get('core.roomtype')}} <span class="asterix"> * </span></label>
										<div class="col-md-4">
										  <select name='roomtypeID' rows='5' id='roomtypeID' class='select2 ' required  ></select>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Season" class=" control-label col-md-4 text-left"> {{Lang::get('core.season')}} <span class="asterix"> * </span></label>
										<div class="col-md-6">

					<label class='radio radio-inline'>
					<input type='radio' name='season' value ='0' required @if($row['season'] == '0') checked="checked" @endif > {{Lang::get('core.lowseason')}}</label>
					<label class='radio radio-inline'>
					<input type='radio' name='season' value ='1' required @if($row['season'] == '1') checked="checked" @endif > {{Lang::get('core.highseason')}}</label>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Rate" class=" control-label col-md-4 text-left"> {{Lang::get('core.rate')}} <span class="asterix"> * </span></label>
										<div class="col-md-3">
										  <input  type='text' name='rate' id='rate' value='{{ $row['rate'] }}'
						required     class='form-control ' />
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Currency" class=" control-label col-md-4 text-left"> {{Lang::get('core.currency')}} <span class="asterix"> * </span></label>
										<div class="col-md-4">
										  <select name='currency' rows='5' id='currency' class='select2 ' required  ></select>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Room Pictures" class=" control-label col-md-4 text-left"> {{Lang::get('core.roompictures')}} </label>
										<div class="col-md-6">

					<a href="javascript:void(0)" title="{{Lang::get('core.addimage')}}" class="btn btn-xs btn-primary pull-right tips" onclick="addMoreFiles('images')"><i class="fa fa-plus-square fa-2x"  ></i></a>
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
							<i class="fa fa-trash-o fa-2x text-red" data-toggle="confirmation" data-title="{{Lang::get('core.rusure')}}" data-content="{{ Lang::get('core.youwanttodeletethis') }}" title="{{ Lang::get('core.deletethisimage') }}"  ></i></span>
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


<script type="text/javascript">
$(document).ready(function() {

		$("#hotelID").jCombo("{!! url('hotelrates/comboselect?filter=hotels:hotelID:hotel_name&limit=WHERE:status:=:1') !!}",
		{  selected_value : '{{ $row["hotelID"] }}' });

		$("#roomtypeID").jCombo("{!! url('hotelrates/comboselect?filter=def_room_types:roomtypeID:room_type&limit=WHERE:status:=:1') !!}",
		{  selected_value : '{{ $row["roomtypeID"] }}' });

		$("#currency").jCombo("{!! url('hotelrates/comboselect?filter=def_currency:currencyID:symbol|country|currency_name&limit=WHERE:status:=:1') !!}",
		{  selected_value : '{{ $row["currency"] }}' });
    $('[data-toggle=confirmation]').confirmation({
    rootSelector: '[data-toggle=confirmation]',
    container: 'body'
    });

    $("input[name='rate']").TouchSpin();
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
			var removeUrl = '{{ url("hotelrates/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();
			return false;
		});

	var form = $('#hotelratesFormAjax');
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
