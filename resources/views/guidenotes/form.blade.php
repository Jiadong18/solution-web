@if($setting['form-method'] =='native')
<div class="box box-primary">
	<div class="box-header with-border">
			<div class="box-header-tools pull-right " >
				<a href="javascript:void(0)" class="collapse-close pull-right btn btn-xs btn-default" onclick="ajaxViewClose('#{{ $pageModule }}')"><i class="fa fa fa-times"></i></a>
			</div>
	</div>

	<div class="box-body">
@endif
			{!! Form::open(array('url'=>'guidenotes/save/'.\App\Library\SiteHelpers::encryptID($row['guidenotesID']), 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ','id'=> 'guidenotesFormAjax')) !!}
			<div class="col-md-12">
						<fieldset><legend>{{Lang::get('core.noteforguide')}}</legend>
				{!! Form::hidden('guidenotesID', $row['guidenotesID']) !!}
                {!! Form::hidden('guideID', app('request')->input('guideID')) !!}

									  <div class="form-group  " >
										<label for="Title" class=" control-label col-md-2 text-left"> {{Lang::get('core.title')}} <span class="asterix"> * </span></label>
										<div class="col-md-9">
										  <input  type='text' name='title' id='title' value='{{ $row['title'] }}'
						required     class='form-control ' />
										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Note" class=" control-label col-md-2 text-left"> {{Lang::get('core.note')}} <span class="asterix"> * </span></label>
										<div class="col-md-9">
										  <textarea name='note' rows='5' id='note' class='form-control '
				         required  >{{ $row['note'] }}</textarea>
										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Style" class=" control-label col-md-2 text-left"> {{Lang::get('core.notecolor')}} </label>
										<div class="col-md-12 text-center">

<label class='radio radio-inline'>
<input type='radio' name='style' value ='muted'  @if($row['style'] == 'muted') checked="checked" @endif >                   <a class="text-muted tips" title="{{Lang::get('core.ntdefault')}}" href="#"><i class="fa fa-square fa-2x"></i></a>
 </label>
<label class='radio radio-inline'>
<input type='radio' name='style' value ='info'  @if($row['style'] == 'info') checked="checked" @endif >
<a class="text-aqua tips" title="{{Lang::get('core.ntinfo')}}" href="#"><i class="fa fa-square fa-2x"></i></a>
</label>
<label class='radio radio-inline'>
<input type='radio' name='style' value ='success'  @if($row['style'] == 'success') checked="checked" @endif >
<a class="text-green tips" title="{{Lang::get('core.ntsuccess')}}" href="#"><i class="fa fa-square fa-2x"></i></a>
</label>
<label class='radio radio-inline'>
<input type='radio' name='style' value ='warning'  @if($row['style'] == 'warning') checked="checked" @endif >                 <a class="text-yellow tips" title="{{Lang::get('core.ntwarning')}}" href="#"><i class="fa fa-square fa-2x"></i></a>
</label>
<label class='radio radio-inline'>
<input type='radio' name='style' value ='danger'  @if($row['style'] == 'danger') checked="checked" @endif >
<a class="text-red tips" title="{{Lang::get('core.ntdanger')}}" href="#"><i class="fa fa-square fa-2x"></i></a>
</label>
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

		$("#guideID").jCombo("{!! url('guidenotes/comboselect?filter=guides:guideID:name&limit=WHERE:status:=:1') !!}",
		{  selected_value : '{{ $row["guideID"] }}' });


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
			var removeUrl = '{{ url("guidenotes/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();
			return false;
		});

	var form = $('#guidenotesFormAjax');
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
