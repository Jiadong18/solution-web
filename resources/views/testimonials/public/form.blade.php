

		 {!! Form::open(array('url'=>'testimonials/savepublic', 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}

	@if(Session::has('messagetext'))

		   {!! Session::get('messagetext') !!}

	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>


<div class="col-md-12">
						<fieldset><legend> Testimonials</legend>
				{!! Form::hidden('testimonialID', $row['testimonialID']) !!}
									  <div class="form-group  " >
										<label for="Name & Surname" class=" control-label col-md-4 text-left"> Name & Surname <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <input  type='text' name='namesurname' id='namesurname' value='{{ $row['namesurname'] }}'
						required     class='form-control ' />
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Email" class=" control-label col-md-4 text-left"> Email <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <input  type='text' name='email' id='email' value='{{ $row['email'] }}'
						required     class='form-control ' />
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Country" class=" control-label col-md-4 text-left"> Country <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <select name='country' rows='5' id='country' class='select2 ' required  ></select>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Tour Name" class=" control-label col-md-4 text-left"> Tour Name <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <input  type='text' name='tour_name' id='tour_name' value='{{ $row['tour_name'] }}'
						required     class='form-control ' />
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Tour Date" class=" control-label col-md-4 text-left"> Tour Date </label>
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
										<label for="Image" class=" control-label col-md-4 text-left"> Image </label>
										<div class="col-md-6">
										  <input  type='file' name='image' id='image' @if($row['image'] =='') class='required' @endif style='width:150px !important;'  />
					 	<div >
						{!! \App\Library\SiteHelpers::showUploadedFile($row['image'],'/uploads/images/') !!}

						</div>

										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Testimonial" class=" control-label col-md-4 text-left"> Testimonial <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <textarea name='testimonial' rows='5' id='testimonial' class='form-control '
				         required  >{{ $row['testimonial'] }}</textarea>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Status" class=" control-label col-md-4 text-left"> Status </label>
										<div class="col-md-6">

					<label class='radio radio-inline'>
					<input type='radio' name='status' value ='1'  @if($row['status'] == '1') checked="checked" @endif > Approved </label>
					<label class='radio radio-inline'>
					<input type='radio' name='status' value ='0'  @if($row['status'] == '0') checked="checked" @endif > New </label>
										 </div>
										 <div class="col-md-2">

										 </div>
									  </div> </fieldset>
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

		$("#country").jCombo("{!! url('testimonials/comboselect?filter=def_country:countryID:country_name') !!}",
		{  selected_value : '{{ $row["country"] }}' });
	});
	</script>
