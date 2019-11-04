@if($setting['form-method'] =='native')
<div class="box box-primary">
	<div class="box-header with-border">
			<div class="box-header-tools pull-right " >
				<a href="javascript:void(0)" class="collapse-close pull-right btn btn-xs btn-default" onclick="ajaxViewClose('#{{ $pageModule }}')"><i class="fa fa fa-times"></i></a>
			</div>
	</div>

	<div class="box-body">
@endif
			{!! Form::open(array('url'=>'testimonials/save/'.\App\Library\SiteHelpers::encryptID($row['testimonialID']), 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ','id'=> 'testimonialsFormAjax')) !!}
			<div class="col-md-12">
				{!! Form::hidden('testimonialID', $row['testimonialID']) !!}
									  <div class="form-group  " >
										<label for="Name & Surname" class=" control-label col-md-4 text-left"> {{ Lang::get('core.namesurname') }} <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <input  type='text' name='namesurname' id='namesurname' value='{{ $row['namesurname'] }}'
						required     class='form-control ' />
										 </div>
										 <div class="col-md-2">
										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Email" class=" control-label col-md-4 text-left">  {{ Lang::get('core.email') }} <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <input  type='text' name='email' id='email' value='{{ $row['email'] }}'
						required     class='form-control ' />
										 </div>
										 <div class="col-md-2">
										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Country" class=" control-label col-md-4 text-left">  {{ Lang::get('core.country') }} <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <select name='country' rows='5' id='country' class='select2 ' required  ></select>
										 </div>
										 <div class="col-md-2">
										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Tour Name" class=" control-label col-md-4 text-left">  {{ Lang::get('core.tourname') }} <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <input  type='text' name='tour_name' id='tour_name' value='{{ $row['tour_name'] }}'
						required     class='form-control ' />
										 </div>
										 <div class="col-md-2">
										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Tour Date" class=" control-label col-md-4 text-left">  {{ Lang::get('core.tourdate') }} </label>
										<div class="col-md-6">

				<div class="input-group m-b" style="width:150px !important;">
					{!! Form::text('tour_date', $row['tour_date'],array('class'=>'form-control date')) !!}
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div>
										 </div>
										 <div class="col-md-2">
										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Image" class=" control-label col-md-4 text-left">  {{ Lang::get('core.image') }} </label>
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
										<label for="Testimonial" class=" control-label col-md-4 text-left">  {{ Lang::get('core.testimonial') }} <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <textarea name='testimonial' rows='5' id='testimonial' class='form-control '
				         required  >{{ $row['testimonial'] }}</textarea>
										 </div>
										 <div class="col-md-2">
										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Status" class=" control-label col-md-4 text-left">  {{ Lang::get('core.status') }} </label>
										<div class="col-md-6">

					<label class='radio radio-inline'>
					<input type='radio' name='status' value ='1'  @if($row['status'] == '1') checked="checked" @endif > {{ Lang::get('core.approved') }} </label>
					<label class='radio radio-inline'>
					<input type='radio' name='status' value ='0'  @if($row['status'] == '0') checked="checked" @endif > {{ Lang::get('core.new') }} </label>
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


<script type="text/javascript">
$(document).ready(function() {

		$("#country").jCombo("{!! url('testimonials/comboselect?filter=def_country:countryID:country_name') !!}",
		{  selected_value : '{{ $row["country"] }}' });

    $('[data-toggle=confirmation]').confirmation({
    rootSelector: '[data-toggle=confirmation]',
    container: 'body'
    });
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
			var removeUrl = '{{ url("testimonials/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();
			return false;
		});

	var form = $('#testimonialsFormAjax');
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
