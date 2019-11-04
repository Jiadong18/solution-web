{!! Form::open(array('url'=>'home/proccess/3', 'id'=>'formconfiguration','class'=>'form-vertical' ,'files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
@if(Session::has('message'))	  
		{!! Session::get('message') !!}
@endif	
	
<ul class="parsley-error-list">
	@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
	@endforeach
</ul>

<div class="form-group  col-md-6" >
					<label for="ipt" class="  "> Name&Surname  </label>
				{!! Form::text('name','',array('class'=>'form-control', 'placeholder'=>'',   )) !!}
		</div>

		<div class="form-group  col-md-6" >
					<label for="ipt" class="  "> Email  </label>
				{!! Form::text('email','',array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true', 'parsley-type'=>'email'   )) !!}
		</div>

		<div class="form-group  col-md-6" >
					<label for="ipt" class="  "> Country  </label>
				<select name='country' rows='5' id='country' class='form-control ' required  ></select>
		</div>

		<div class="form-group  col-md-6" >
					<label for="ipt" class="  "> Arrival Date  </label>
				
				<div class="input-group m-b" style="width:150px !important;">
					{!! Form::text('arrivaldate', '',array('class'=>'form-control date')) !!}
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div>
		</div>

		<div class="form-group  col-md-6" >
					<label for="ipt" class="  "> Duration Of Stay  </label>
				{!! Form::text('durationofstay','',array('class'=>'form-control', 'placeholder'=>'',   )) !!}
		</div>

		<div class="form-group  col-md-6" >
					<label for="ipt" class="  "> Message  </label>
				<textarea name='message' rows='5' id='message' class='form-control '  
				           ></textarea>
		</div>

		
		<div class="form-group col-md-12" >					
				<button type="submit" name="submit" class="btn btn-primary"> Submit </button>
		</div>

{!! Form::close() !!}

<div style="clear: both;"></div>
<script type="text/javascript">
	
		$("#country").jCombo("{!! url('post/comboselect?filter=def_country:country_name:country_name') !!}",
		{  selected_value : '' });
		
</script>