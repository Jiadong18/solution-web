

		 {!! Form::open(array('url'=>'visaapplication/savepublic', 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}

	@if(Session::has('messagetext'))
	  
		   {!! Session::get('messagetext') !!}
	   
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>		


<div class="col-md-12">
						<fieldset><legend> Visa Application</legend>
				{!! Form::hidden('applicationID', $row['applicationID']) !!}					
									  <div class="form-group  " >
										<label for="TravellersID" class=" control-label col-md-4 text-left"> TravellersID <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <select name='travellersID[]' multiple rows='5' id='travellersID' class='select2 ' required  ></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="CountryID" class=" control-label col-md-4 text-left"> CountryID <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <select name='countryID' rows='5' id='countryID' class='select2 ' required  ></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Duration" class=" control-label col-md-4 text-left"> Duration <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <input  type='text' name='duration' id='duration' value='{{ $row['duration'] }}' 
						required     class='form-control ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Duration2" class=" control-label col-md-4 text-left"> Duration2 <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  
					<?php $duration2 = explode(',',$row['duration2']);
					$duration2_opt = array( '1' => 'Days' ,  '2' => 'Weeks' ,  '3' => 'Months' ,  '4' => 'Years' , ); ?>
					<select name='duration2' rows='5' required  class='select2 '  > 
						<?php 
						foreach($duration2_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['duration2'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Applicationdate" class=" control-label col-md-4 text-left"> Applicationdate </label>
										<div class="col-md-6">
										  
				<div class="input-group m-b" style="width:150px !important;">
					{!! Form::text('applicationdate', $row['applicationdate'],array('class'=>'form-control date')) !!}
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Processintime" class=" control-label col-md-4 text-left"> Processintime </label>
										<div class="col-md-6">
										  <input  type='text' name='processintime' id='processintime' value='{{ $row['processintime'] }}' 
						     class='form-control ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Payment" class=" control-label col-md-4 text-left"> Payment </label>
										<div class="col-md-6">
										  <input  type='text' name='payment' id='payment' value='{{ $row['payment'] }}' 
						     class='form-control ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="CurrencyID" class=" control-label col-md-4 text-left"> CurrencyID </label>
										<div class="col-md-6">
										  <select name='currencyID' rows='5' id='currencyID' class='select2 '   ></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="PaymenttypeID" class=" control-label col-md-4 text-left"> PaymenttypeID </label>
										<div class="col-md-6">
										  <select name='paymenttypeID' rows='5' id='paymenttypeID' class='select2 '   ></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Applicationfee" class=" control-label col-md-4 text-left"> Applicationfee </label>
										<div class="col-md-6">
										  <input  type='text' name='applicationfee' id='applicationfee' value='{{ $row['applicationfee'] }}' 
						     class='form-control ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="CurrencyID2" class=" control-label col-md-4 text-left"> CurrencyID2 </label>
										<div class="col-md-6">
										  <select name='currencyID2' rows='5' id='currencyID2' class='select2 '   ></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Documents" class=" control-label col-md-4 text-left"> Documents </label>
										<div class="col-md-6">
										  
					<a href="javascript:void(0)" class="btn btn-xs btn-primary pull-right" onclick="addMoreFiles('documents')"><i class="fa fa-plus-square"></i></a>
					<div class="documentsUpl">	
					 	<input  type='file' name='documents[]'  />			
					</div>
					<ul class="uploadedLists " >
					<?php $cr= 0; 
					$row['documents'] = explode(",",$row['documents']);
					?>
					@foreach($row['documents'] as $files)
						@if(file_exists('./uploads/images/'.$files) && $files !='')
						<li id="cr-<?php echo $cr;?>" class="">							
							<a href="{{ url('/uploads/images/'.$files) }}" target="_blank" >{{ $files }}</a> 
							<span class="pull-right removeMultiFiles" rel="cr-<?php echo $cr;?>" url="/uploads/images/{{$files}}">
							<i class="fa fa-trash-o fa-2x"></i></span>
							<input type="hidden" name="currdocuments[]" value="{{ $files }}"/>
							<?php ++$cr;?>
						</li>
						@endif
					
					@endforeach
					</ul>
					 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Status" class=" control-label col-md-4 text-left"> Status </label>
										<div class="col-md-6">
										  
					<label class='radio radio-inline'>
					<input type='radio' name='status' value ='0'  @if($row['status'] == '0') checked="checked" @endif > Rejected </label>
					<label class='radio radio-inline'>
					<input type='radio' name='status' value ='1'  @if($row['status'] == '1') checked="checked" @endif > New </label>
					<label class='radio radio-inline'>
					<input type='radio' name='status' value ='2'  @if($row['status'] == '2') checked="checked" @endif > Pending </label>
					<label class='radio radio-inline'>
					<input type='radio' name='status' value ='3'  @if($row['status'] == '3') checked="checked" @endif > Approved </label> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Visaexpirydate" class=" control-label col-md-4 text-left"> Visaexpirydate </label>
										<div class="col-md-6">
										  
				<div class="input-group m-b" style="width:150px !important;">
					{!! Form::text('visaexpirydate', $row['visaexpirydate'],array('class'=>'form-control date')) !!}
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Rejectreason" class=" control-label col-md-4 text-left"> Rejectreason </label>
										<div class="col-md-6">
										  <textarea name='rejectreason' rows='5' id='rejectreason' class='form-control '  
				           >{{ $row['rejectreason'] }}</textarea> 
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
		
		
		$("#travellersID").jCombo("{!! url('visaapplication/comboselect?filter=travellers:travellerID:nameandsurname') !!}",
		{  selected_value : '{{ $row["travellersID"] }}' });
		
		$("#countryID").jCombo("{!! url('visaapplication/comboselect?filter=def_country:countryID:country_name') !!}",
		{  selected_value : '{{ $row["countryID"] }}' });
		
		$("#currencyID").jCombo("{!! url('visaapplication/comboselect?filter=def_currency:currencyID:currency_name') !!}",
		{  selected_value : '{{ $row["currencyID"] }}' });
		
		$("#paymenttypeID").jCombo("{!! url('visaapplication/comboselect?filter=def_payment_types:paymenttypeID:payment_type') !!}",
		{  selected_value : '{{ $row["paymenttypeID"] }}' });
		
		$("#currencyID2").jCombo("{!! url('visaapplication/comboselect?filter=def_currency:currencyID:currency_name') !!}",
		{  selected_value : '{{ $row["currencyID2"] }}' });
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
