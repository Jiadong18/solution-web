
@if($setting['form-method'] =='native')
<div class="box box-primary">
	<div class="box-header with-border">
			<div class="box-header-tools pull-right " >
				<a href="javascript:void(0)" class="collapse-close pull-right btn btn-xs btn-default" onclick="ajaxViewClose('#{{ $pageModule }}')"><i class="fa fa fa-times"></i></a>
			</div>
	</div>

	<div class="box-body">
@endif
			{!! Form::open(array('url'=>'tourdetail/save/'.\App\Library\SiteHelpers::encryptID($row['tourdetailID']), 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ','id'=> 'tourdetailFormAjax')) !!}
			<div class="col-md-12">
				{!! Form::hidden('tourdetailID', $row['tourdetailID']) !!}
                {!! Form::hidden('tourID', app('request')->input('tourID') ) !!}
									  <div class="form-group  " >
										<label for="Day" class=" control-label col-md-4 text-left"> {{ Lang::get('core.day') }} <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <input  type='text' name='day' id='day' value='{{ $row['day'] }}'
						required     class='form-control ' />
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Title" class=" control-label col-md-4 text-left"> {{ Lang::get('core.title') }} <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <input  type='text' name='title' id='title' value='{{ $row['title'] }}'
						required     class='form-control ' />
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
                            @if (app('request')->input('country') !='')

                            {!! Form::hidden('countryID', app('request')->input('country') ) !!}
                            <div class="form-group  " >
										<label for="Country" class=" control-label col-md-4 text-left">{{ Lang::get('core.country') }}</label>
										<div class="col-md-6">
										<label for="Country" class=" control-label">{{ \App\Library\SiteHelpers::formatLookUp( app('request')->input('country'),'countryID','1:def_country:countryID:country_name') }}</label>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
                            @else
									  <div class="form-group  " >
										<label for="Country" class=" control-label col-md-4 text-left"><a href="javascript:void(0)" onclick="MmbModal('{{ url('countries/update/') }}','Add New Country')" class="tips" title="Add New Country"> <i class="fa fa-plus-circle fa-lg"></i></a>{{ Lang::get('core.country') }} <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <select name='countryID' rows='5' id='countryID' class='select2 ' required  ></select>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
                            @endif
									  <div class="form-group  " >
										<label for="City" class=" control-label col-md-4 text-left"><a href="javascript:void(0)" onclick="MmbModal('{{ url('cities/update/') }}','Add New Country')" class="tips" title="Add New Country"> <i class="fa fa-plus-circle fa-lg"></i></a> {{ Lang::get('core.city') }} <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <select name='cityID' rows='5' id='cityID' class='select2 ' required  ></select>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Hotel" class=" control-label col-md-4 text-left"> <a href="{{ url('hotels/update/') }}" class="tips" title="Add New Hotel"> <i class="fa fa-plus-circle fa-lg"></i></a>{{ Lang::get('core.hotel') }} </label>
										<div class="col-md-6">
										  <select name='hotelID' rows='5' id='hotelID' class='select2 '   ></select>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Sites" class=" control-label col-md-4 text-left"><a href="javascript:void(0)" onclick="MmbModal('{{ url('sites/update/') }}','Add New Country')" class="tips" title="Add New Country"> <i class="fa fa-plus-circle fa-lg"></i></a> {{ Lang::get('core.sites') }} </label>
										<div class="col-md-6">
										  <select name='siteID[]' multiple rows='5' id='siteID' class='select2 '   ></select>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Meal" class=" control-label col-md-4 text-left"> {{ Lang::get('core.includedmeals') }} </label>
										<div class="col-md-6">
										  <?php $meal = explode(",",$row['meal']); ?>
					 <label class='checked checkbox-inline'>
					<input type='checkbox' name='meal[]' value ='B'   class=''
					@if(in_array('B',$meal))checked @endif
					 /> {{ Lang::get('core.breakfast') }} </label>
					 <label class='checked checkbox-inline'>
					<input type='checkbox' name='meal[]' value ='L'   class=''
					@if(in_array('L',$meal))checked @endif
					 /> {{ Lang::get('core.lunch') }} </label>
					 <label class='checked checkbox-inline'>
					<input type='checkbox' name='meal[]' value ='D'   class=''
					@if(in_array('D',$meal))checked @endif
					 /> {{ Lang::get('core.dinner') }} </label>
										 </div>
										 <div class="col-md-2">
										 	<a href="#" data-toggle="tooltip" placement="left" class="tips" title="B: {{ Lang::get('core.breakfast') }} L: {{ Lang::get('core.lunch') }} D: {{ Lang::get('core.dinner') }}"><i class="icon-question2"></i></a>
										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Optional Tours" class=" control-label col-md-4 text-left"> {{ Lang::get('core.optionaltours') }} </label>
										<div class="col-md-6">
										  <select name='optionaltourID[]' multiple rows='5' id='optionaltourID' class='select2 '   ></select>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Description" class=" control-label col-md-2 text-left"> {{ Lang::get('core.description') }} <span class="asterix"> * </span></label>
										<div class="col-md-9">
										  <textarea name='description' rows='7' id='description' class='form-control '
				         required  >{{ $row['description'] }}</textarea>
										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Image" class=" control-label col-md-4 text-left"> {{ Lang::get('core.image') }} </label>
										<div class="col-md-6">
										  <input  type='file' name='image' id='image' @if($row['image'] =='') class='required' @endif style='width:150px !important;'  />
					 	<div >
                        @if(file_exists('./uploads/images/'.$row['image']) && $row['image'] !='')

                        <span class="pull-left removeMultiFiles "  url="/uploads/images/{{$row['image']}}">
							<i class="fa fa-trash-o fa-2x text-red "
                               data-toggle="confirmation"
                               data-title="{{Lang::get('core.rusure')}}"
                               data-content="{{ Lang::get('core.youwanttodeletethis') }}" >
                            </i></span>
                            {!! \App\Library\SiteHelpers::showUploadedFile($row['image'],'/uploads/images/') !!}
                        @endif
						</div>

										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Icon" class=" control-label col-md-4 text-left"> {{ Lang::get('core.icon') }} </label>
										<div class="col-md-6">
										  <input  type='text' name='icon' id='icon' value='{{ $row['icon'] }}'
						     class='form-control ' />
										 </div>
										 <div class="col-md-2">
										 </div>
									  </div>
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

		$("#countryID").jCombo("{!! url('tourdetail/comboselect?filter=def_country:countryID:country_name') !!}",
		{  selected_value : '{{ $row["countryID"] }}' });

		$("#cityID").jCombo("{!! url('tourdetail/comboselect?filter=def_city:cityID:city_name') !!}&@if (app('request')->input('country') !='' ) limit=WHERE:countryID:=:{{ app('request')->input('country') }} @else parent=countryID: @endif",
		{  parent: '#countryID', selected_value : '{{ $row["cityID"] }}' });

		$("#hotelID").jCombo("{!! url('tourdetail/comboselect?filter=hotels:hotelID:hotel_name') !!}&parent=cityID:",
		{  parent: '#cityID', selected_value : '{{ $row["hotelID"] }}' });

		$("#siteID").jCombo("{!! url('tourdetail/comboselect?filter=def_sites:siteID:site_name') !!}&parent=cityID:",
		{  parent: '#cityID', selected_value : '{{ $row["siteID"] }}' });

		$("#optionaltourID").jCombo("{!! url('tourdetail/comboselect?filter=def_optional_tours:optionaltourID:optional_tour') !!}",
		{  selected_value : '{{ $row["optionaltourID"] }}' });

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
			var removeUrl = '{{ url("tourdetail/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();
			return false;
		});

	var form = $('#tourdetailFormAjax');
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
