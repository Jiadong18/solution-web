{!! Form::open(array('url'=>'home/proccess/4', 'id'=>'formconfiguration','class'=>'form-vertical' ,'files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
@if(Session::has('message'))	  
		{!! Session::get('message') !!}
@endif	
	
<ul class="parsley-error-list">
	@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
	@endforeach
</ul>

<div class="form-group  col-md-12" >
					<label for="ipt" class="  "> Name&Surname  </label>
				{!! Form::text('name','',array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) !!}
		</div>

		<div class="form-group  col-md-12" >
					<label for="ipt" class="  "> E-mail  </label>
				{!! Form::text('eposta','',array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true', 'parsley-type'=>'email'   )) !!}
		</div>

		<div class="form-group  col-md-12" >
					<label for="ipt" class="  "> Country  </label>
				<select name='country' rows='5' id='country' class='form-control '   ></select>
		</div>

		<div class="form-group  col-md-12" >
					<label for="ipt" class="  "> Subject  </label>
				{!! Form::text('subject','',array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) !!}
		</div>

		<div class="form-group  col-md-12" >
					<label for="ipt" class="  "> Message  </label>
				<textarea name='message' rows='5' id='message' class='form-control '  
				         required  ></textarea>
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