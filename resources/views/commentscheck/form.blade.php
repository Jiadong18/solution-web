
@if($setting['form-method'] =='native')
<div class="box box-primary">
	<div class="box-header with-border">
			<div class="box-header-tools pull-right " >
				<a href="javascript:void(0)" class="collapse-close pull-right btn btn-xs btn-default" onclick="ajaxViewClose('#{{ $pageModule }}')"><i class="fa fa fa-times"></i></a>
			</div>
	</div>

	<div class="box-body">
@endif
			{!! Form::open(array('url'=>'commentscheck/save/'.\App\Library\SiteHelpers::encryptID($row['commentID']), 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ','id'=> 'commentscheckFormAjax')) !!}
			<div class="col-md-12">
						<fieldset><legend>{{Lang::get('core.blogcommentcheck')}}</legend>
				{!! Form::hidden('commentID', $row['commentID']) !!}
									  <div class="form-group  " >
										<label for="PageID" class=" control-label col-md-4 text-left"> {{Lang::get('core.pageID')}}</label>
										<div class="col-md-6">
										  <select name='pageID' rows='5' id='pageID' class='select2 '   ></select>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="UserID" class=" control-label col-md-4 text-left"> {{Lang::get('core.namesurname')}}" </label>
										<div class="col-md-6">
										  <select name='userID' rows='5' id='userID' class='select2 '   ></select>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Comments" class=" control-label col-md-4 text-left"> {{Lang::get('core.comment')}} </label>
										<div class="col-md-6">
										  <textarea name='comments' rows='5' id='comments' class='form-control '
				         required  >{{ $row['comments'] }}</textarea>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Posted" class=" control-label col-md-4 text-left"> {{Lang::get('core.created')}} </label>
										<div class="col-md-6">

				<div class="input-group m-b" style="width:150px !important;">
					{!! Form::text('posted', $row['posted'],array('class'=>'form-control datetime', 'style'=>'width:150px !important;')) !!}
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div>

										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Approved" class=" control-label col-md-4 text-left"> {{Lang::get('core.approved')}}</label>
										<div class="col-md-6">
										  <?php $approved = explode(",",$row['approved']); ?>
					 <label class='checked checkbox-inline'>
					<input type='checkbox' name='approved[]' value ='1'   class=''
					@if(in_array('1',$approved))checked @endif
					 /></label>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div> </fieldset>
			</div>




			<div style="clear:both"></div>

			<div class="form-group">
				<label class="col-sm-4 text-right">&nbsp;</label>
				<div class="col-sm-8">
					<button type="submit" class="btn btn-primary btn-sm "> {{ Lang::get('core.sb_save') }} </button>
					<button type="button" onclick="ajaxViewClose('#{{ $pageModule }}')" class="btn btn-danger btn-sm"> {{ Lang::get('core.sb_cancel') }} </button>
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

		$("#pageID").jCombo("{!! url('commentscheck/comboselect?filter=tb_pages:pageID:title') !!}",
		{  selected_value : '{{ $row["pageID"] }}' });

		$("#userID").jCombo("{!! url('commentscheck/comboselect?filter=tb_users:id:username') !!}",
		{  selected_value : '{{ $row["userID"] }}' });


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
			var removeUrl = '{{ url("commentscheck/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();
			return false;
		});

	var form = $('#commentscheckFormAjax');
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
