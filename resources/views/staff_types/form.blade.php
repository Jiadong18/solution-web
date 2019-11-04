<form method="POST" id="editForm"
	  accept-charset="UTF-8" class="form-horizontal" parsley-validate="" novalidate=" "
	  enctype="multipart/form-data" action="{{route('stafftypes.update',$staff->stafftypeID)}}">
	@csrf
	<div class="col-md-12">
		<fieldset>
			<legend> Staff Types</legend>
			<div class="form-group  ">
				<label for="staff type Name"
					   class=" control-label col-md-4 text-left"> {{ Lang::get('core.stafftype') }}
					<span class="asterix"> * </span></label>
				<div class="col-md-6">
					<input type='text' name='staff_type' id='staff_type' value='{{$staff->staff_type}}'
						   required class='form-control '/>
				</div>

			</div>
			<div class="form-group  ">
				<label for="Status"
					   class=" control-label col-md-4 text-left"> {{ Lang::get('core.status') }} <span
							class="asterix"> * </span></label>
				<div class="col-md-6">

					<label class='radio radio-inline'>
						<input type='radio' name='status' value='0' required
							   @if($staff['status'] == 0) checked="checked" @endif > {{ Lang::get('core.fr_minactive') }}
					</label>
					<label class='radio radio-inline'>
						<input type='radio' name='status' value='1' required
							   @if($staff['status'] == 1) checked="checked" @endif > {{ Lang::get('core.fr_mactive') }}
					</label>
				</div>
				<div class="col-md-2">

				</div>
			</div>
		</fieldset>
	</div>


	<div style="clear:both"></div>

	<div class="form-group">
		<label class="col-sm-4 text-right">&nbsp;</label>
		<div class="col-sm-8">
			<button type="submit" id="storeBtn" class="btn btn-primary btn-sm "><i
						class="fa fa-play-circle"></i> {{ Lang::get('core.sb_save') }} </button>
			<button type="button" onclick="modalClose('edit')" class="btn btn-danger btn-sm"><i
						class="fa fa-remove "></i> {{ Lang::get('core.sb_cancel') }} </button>
		</div>
	</div>
</form>

<script>
	$('.select2').select2();
</script>