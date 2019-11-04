

		 {!! Form::open(array('url'=>'travellersfiles/savepublic', 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}

	@if(Session::has('messagetext'))

		   {!! Session::get('messagetext') !!}

	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>


<div class="col-md-12">
						<fieldset><legend> Travellers Files</legend>
				{!! Form::hidden('fileID', $row['fileID']) !!}{!! Form::hidden('travellerID', $row['travellerID']) !!}
									  <div class="form-group  " >
										<label for="File Type" class=" control-label col-md-4 text-left"> File Type <span class="asterix"> * </span></label>
										<div class="col-md-6">

					<label class='radio radio-inline'>
					<input type='radio' name='file_type' value ='1' required @if($row['file_type'] == '1') checked="checked" @endif > Passport </label>
					<label class='radio radio-inline'>
					<input type='radio' name='file_type' value ='2' required @if($row['file_type'] == '2') checked="checked" @endif > ID Card </label>
					<label class='radio radio-inline'>
					<input type='radio' name='file_type' value ='3' required @if($row['file_type'] == '3') checked="checked" @endif > Photo </label>
					<label class='radio radio-inline'>
					<input type='radio' name='file_type' value ='4' required @if($row['file_type'] == '4') checked="checked" @endif > Other Documents </label>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="File" class=" control-label col-md-4 text-left"> File </label>
										<div class="col-md-6">
										  <input  type='file' name='file' id='file' @if($row['file'] =='') class='required' @endif style='width:150px !important;'  />
					 	<div >
						{!! \App\Library\SiteHelpers::showUploadedFile($row['file'],'/uploads/images/') !!}

						</div>

										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Remarks" class=" control-label col-md-4 text-left"> Remarks </label>
										<div class="col-md-6">
										  <textarea name='remarks' rows='5' id='remarks' class='form-control '
				           >{{ $row['remarks'] }}</textarea>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div> {!! Form::hidden('created_at', $row['created_at']) !!}{!! Form::hidden('updated_at', $row['updated_at']) !!}</fieldset>
			</div>



			<div style="clear:both"></div>


				  <div class="form-group">
					<label class="col-sm-4 text-right">&nbsp;</label>
					<div class="col-sm-8">
					<button type="submit" name="apply" class="btn btn-info btn-sm" ><i class="fa  fa-check-circle"></i> {{ Lang::get('core.sb_apply') }}</button>
					<button type="submit" name="submit" class="btn btn-primary btn-sm" ><i class="fa  fa-save "></i> {{ Lang::get('core.sb_save') }}</button>
				  </div>

		</div>

		 {!! Form::close() !!}

   <script type="text/javascript">
	$(document).ready(function() {



		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();
			return false;
		});

	});
	</script>
