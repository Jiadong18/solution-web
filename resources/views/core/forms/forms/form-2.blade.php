{!! Form::open(array('url'=>'home/proccess/2', 'id'=>'formconfiguration','class'=>'form-vertical' ,'files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
@if(Session::has('message'))	  
		{!! Session::get('message') !!}
@endif	
	
<ul class="parsley-error-list">
	@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
	@endforeach
</ul>

<div class="form-group  col-md-6" style="display:none">
					<label for="ipt" class="  "> TestimonialID  </label>
				{!! Form::hidden('testimonialid', '') !!}
		</div>

		<div class="form-group  col-md-6" >
					<label for="ipt" class="  "> Name&Surname  </label>
				{!! Form::text('namesurname','',array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) !!}
		</div>

		<div class="form-group  col-md-6" >
					<label for="ipt" class="  "> E-mail  </label>
				{!! Form::text('email','',array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true', 'parsley-type'=>'email'   )) !!}
		</div>

		<div class="form-group  col-md-6" >
					<label for="ipt" class="  "> Country  </label>
				<select name='country' rows='5' id='country' class='form-control '   ></select>
		</div>

		<div class="form-group  col-md-6" >
					<label for="ipt" class="  "> Service  </label>
				{!! Form::text('tour_name','',array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) !!}
		</div>

		<div class="form-group  col-md-6" >
					<label for="ipt" class="  "> Date  </label>
				
				<div class="input-group m-b" style="width:150px !important;">
					{!! Form::text('tour_date', '',array('class'=>'form-control date')) !!}
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div>
		</div>

		<div class="form-group  col-md-6" >
					<label for="ipt" class="  "> Image  </label>
				<input  type='file' name='image' id='image' style='width:150px !important;'  />
		</div>

		<div class="form-group  col-md-6" >
					<label for="ipt" class="  "> Testimonial  </label>
				<textarea name='testimonial' rows='5' id='testimonial' class='form-control '  
				         required  ></textarea>
		</div>

		<div class="form-group  col-md-6" style="display:none">
					<label for="ipt" class="  "> Status  </label>
				{!! Form::hidden('status', '') !!}
		</div>

		<div class="form-group  col-md-6" style="display:none">
					<label for="ipt" class="  "> Created At  </label>
				{!! Form::hidden('created_at', '') !!}
		</div>

		<div class="form-group  col-md-6" style="display:none">
					<label for="ipt" class="  "> Updated At  </label>
				{!! Form::hidden('updated_at', '') !!}
		</div>

		
		<div class="form-group  " >					
				<button type="submit" name="submit" class="btn btn-primary"> Submit </button>
		</div>

{!! Form::close() !!}

<script type="text/javascript">
	
		$("#country").jCombo("{!! url('post/comboselect?filter=def_country:countryID:country_name') !!}",
		{  selected_value : '' });
		
</script>