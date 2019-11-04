
@if($setting['form-method'] =='native')
<div class="box box-primary">
	<div class="box-header with-border">
			<div class="box-header-tools pull-right " >
				<a href="javascript:void(0)" class="collapse-close pull-right btn btn-xs btn-default" onclick="ajaxViewClose('#{{ $pageModule }}')"><i class="fa fa fa-times"></i></a>
			</div>
	</div>

	<div class="box-body">
@endif
			{!! Form::open(array('url'=>'travellersfiles/save/'.\App\Library\SiteHelpers::encryptID($row['fileID']), 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ','id'=> 'travellersfilesFormAjax')) !!}
			<div class="col-md-12">
				{!! Form::hidden('fileID', $row['fileID']) !!}
                {!! Form::hidden('travellerID', app('request')->input('travellerID') ) !!}
									  <div class="form-group  " >
										<label for="File Type" class=" control-label col-md-4 text-left">{{Lang::get('core.filetype')}}<span class="asterix"> * </span></label>
										<div class="col-md-6">

					<label class='radio radio-inline'>
					<input type='radio' name='file_type' value ='1' required @if($row['file_type'] == '1') checked="checked" @endif > {{Lang::get('core.passport')}} </label><br>
					<label class='radio radio-inline'>
					<input type='radio' name='file_type' value ='2' required @if($row['file_type'] == '2') checked="checked" @endif > {{Lang::get('core.IDcard')}} </label><br>
					<label class='radio radio-inline'>
					<input type='radio' name='file_type' value ='3' required @if($row['file_type'] == '3') checked="checked" @endif > {{Lang::get('core.photo')}} </label><br>
					<label class='radio radio-inline'>
					<input type='radio' name='file_type' value ='4' required @if($row['file_type'] == '4') checked="checked" @endif > {{Lang::get('core.otherdocuments')}} </label>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="File" class=" control-label col-md-4 text-left"> {{Lang::get('core.m_files')}} </label>
										<div class="col-md-6">
										  <input  type='file' name='file' id='file' @if($row['file'] =='') class='required' @endif style='width:150px !important;'  />
					 	<div >
                            @if(file_exists('./uploads/files/'.$row['file']) && $row['file'] !='')
                            <span class="pull-left removeMultiFiles "  url="/uploads/files/{{$row['file']}}">
				            <i class="fa fa-trash-o fa-2x text-red " data-toggle="confirmation" data-title="{{Lang::get('core.rusure')}}" data-content="{{ Lang::get('core.youwanttodeletethis') }}" title="{{ Lang::get('core.deletethisimage') }}" ></i></span>
                            {!! \App\Library\SiteHelpers::showUploadedFile($row['file'],'/uploads/files/') !!}
                        @endif

						</div>

										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Remarks" class=" control-label col-md-4 text-left"> {{Lang::get('core.remarks')}} </label>
										<div class="col-md-6">
										  <textarea name='remarks' required rows='5' id='remarks' class='form-control '
				           >{{ $row['remarks'] }}</textarea>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div> {!! Form::hidden('created_at', $row['created_at']) !!}{!! Form::hidden('updated_at', $row['updated_at']) !!}
			</div>




			<div style="clear:both"></div>

			<div class="form-group">
				<label class="col-sm-4 text-right">&nbsp;</label>
				<div class="col-sm-8">
					<button type="submit" class="btn btn-primary btn-sm ">  {{ Lang::get('core.sb_save') }} </button>
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

    $('[data-toggle=confirmation]').confirmation({
    rootSelector: '[data-toggle=confirmation]',
    container: 'body'
    });

	$('.editor').summernote();
	$('.tips').tooltip();
	$(".select2").select2({ width:"98%"});
	$('.date').datepicker({format:'yyyy-mm-dd',autoClose:true})
	$('.datetime').datetimepicker({format: 'yyyy-mm-dd hh:ii'});
	$('input[type="checkbox"],input[type="radio"]').iCheck({
		checkboxClass: 'icheckbox_square-red',
		radioClass: 'iradio_square-red',
	});
		$('.removeMultiFiles').on('click',function(){
			var removeUrl = '{{ url("travellersfiles/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();
			return false;
		});

	var form = $('#travellersfilesFormAjax');
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
