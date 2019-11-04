
@if($setting['form-method'] =='native')
<div class="box box-primary">
	<div class="box-header with-border">
			<div class="box-header-tools pull-right " >
				<a href="javascript:void(0)" class="collapse-close pull-right btn btn-xs btn-default" onclick="ajaxViewClose('#{{ $pageModule }}')"><i class="fa fa fa-times"></i></a>
			</div>
	</div>

	<div class="box-body">
@endif
			{!! Form::open(array('url'=>'travelagentnote/save/'.\App\Library\SiteHelpers::encryptID($row['travelagentnoteID']), 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ','id'=> 'travelagentnoteFormAjax')) !!}
			<div class="col-md-12">
						<fieldset><legend> {{ Lang::get('core.travelagentnote') }}</legend>
				{!! Form::hidden('travelagentnoteID', $row['travelagentnoteID']) !!}
				{!! Form::hidden('travelagentID', app('request')->input('travelagentID')) !!}
									  <div class="form-group  " >
										<label for="Title" class=" control-label col-md-4 text-left"> {{ Lang::get('core.title') }} <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <input  type='text' name='title' id='title' value='{{ $row['title'] }}'
						required     class='form-control ' />
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Note" class=" control-label col-md-4 text-left"> {{ Lang::get('core.note') }} <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <textarea name='note' rows='5' id='note' class='form-control '
				         required  >{{ $row['note'] }}</textarea>
										 </div>
									  </div>
									  <div class="form-group  " >
										<div class="col-md-10 text-center">

<label class='radio radio-inline'>
<input type='radio' name='style' value ='muted'  @if($row['style'] == 'muted') checked="checked" @endif >                   <a class="text-muted tips" title="{{ Lang::get('core.default') }}" href="#"><i class="fa fa-square fa-2x"></i></a>
 </label>
<label class='radio radio-inline'>
<input type='radio' name='style' value ='info'  @if($row['style'] == 'info') checked="checked" @endif >
<a class="text-aqua tips" title="{{ Lang::get('core.info') }}" href="#"><i class="fa fa-square fa-2x"></i></a>
</label>
<label class='radio radio-inline'>
<input type='radio' name='style' value ='success'  @if($row['style'] == 'success') checked="checked" @endif >
<a class="text-green tips" title="{{ Lang::get('core.success') }}" href="#"><i class="fa fa-square fa-2x"></i></a>
</label>
<label class='radio radio-inline'>
<input type='radio' name='style' value ='warning'  @if($row['style'] == 'warning') checked="checked" @endif >                 <a class="text-yellow tips" title="{{ Lang::get('core.warning') }}" href="#"><i class="fa fa-square fa-2x"></i></a>
</label>
<label class='radio radio-inline'>
<input type='radio' name='style' value ='danger'  @if($row['style'] == 'danger') checked="checked" @endif >
<a class="text-red tips" title="{{ Lang::get('core.danger') }}" href="#"><i class="fa fa-square fa-2x"></i></a>
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

		$("#travelagentID").jCombo("{!! url('travelagentnote/comboselect?filter=travel_agent:travelagentID:agency_name&limit=WHERE:status:=:1') !!}",
		{  selected_value : '{{ $row["travelagentID"] }}' });


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
			var removeUrl = '{{ url("travelagentnote/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();
			return false;
		});

	var form = $('#travelagentnoteFormAjax');
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
