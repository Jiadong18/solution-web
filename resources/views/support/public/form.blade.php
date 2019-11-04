

		 {!! Form::open(array('url'=>'support/savepublic', 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}

	@if(Session::has('messagetext'))
	  
		   {!! Session::get('messagetext') !!}
	   
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>		


<div class="col-md-12">
						<fieldset><legend> Support</legend>
				{!! Form::hidden('TicketID', $row['TicketID']) !!}{!! Form::hidden('UserID', $row['UserID']) !!}					
									  <div class="form-group  " >
										<label for="Title" class=" control-label col-md-4 text-left"> Title <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <input  type='text' name='Title' id='Title' value='{{ $row['Title'] }}' 
						required     class='form-control ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Category" class=" control-label col-md-4 text-left"> Category <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <select name='Category' rows='5' id='Category' class='select2 ' required  ></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Priority" class=" control-label col-md-4 text-left"> Priority <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  
					<?php $Priority = explode(',',$row['Priority']);
					$Priority_opt = array( '0' => 'Low' ,  '1' => 'Normal' ,  '2' => 'Critical' , ); ?>
					<select name='Priority' rows='5' required  class='select2 '  > 
						<?php 
						foreach($Priority_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['Priority'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Description" class=" control-label col-md-4 text-left"> Description <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <textarea name='Description' rows='5' id='editor' class='form-control editor '  
						required >{{ $row['Description'] }}</textarea> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Department" class=" control-label col-md-4 text-left"> Department <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  
					<label class='radio radio-inline'>
					<input type='radio' name='Assignments' value ='1' required @if($row['Assignments'] == '1') checked="checked" @endif > Tour </label>
					<label class='radio radio-inline'>
					<input type='radio' name='Assignments' value ='2' required @if($row['Assignments'] == '2') checked="checked" @endif > Hotel </label>
					<label class='radio radio-inline'>
					<input type='radio' name='Assignments' value ='3' required @if($row['Assignments'] == '3') checked="checked" @endif > Flight </label>
					<label class='radio radio-inline'>
					<input type='radio' name='Assignments' value ='4' required @if($row['Assignments'] == '4') checked="checked" @endif > Rent a Car </label>
					<label class='radio radio-inline'>
					<input type='radio' name='Assignments' value ='5' required @if($row['Assignments'] == '5') checked="checked" @endif > Extra Services </label> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Status" class=" control-label col-md-4 text-left"> Status <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  
					<?php $Status = explode(',',$row['Status']);
					$Status_opt = array( 'New' => 'New' ,  'Processed' => 'Processed' ,  'Pending' => 'Pending' ,  'Completed' => 'Completed' , ); ?>
					<select name='Status' rows='5' required  class='select2 '  > 
						<?php 
						foreach($Status_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['Status'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Image" class=" control-label col-md-4 text-left"> Image </label>
										<div class="col-md-6">
										  
					<a href="javascript:void(0)" class="btn btn-xs btn-primary pull-right" onclick="addMoreFiles('Image')"><i class="fa fa-plus-square-o fa-2x"></i></a>
					<div class="ImageUpl">	
					 	<input  type='file' name='Image[]'  />			
					</div>
					<ul class="uploadedLists " >
					<?php $cr= 0; 
					$row['Image'] = explode(",",$row['Image']);
					?>
					@foreach($row['Image'] as $files)
						@if(file_exists('./uploads/images/'.$files) && $files !='')
						<li id="cr-<?php echo $cr;?>" class="">							
							<a href="{{ url('/uploads/images/'.$files) }}" target="_blank" >{{ $files }}</a> 
							<span class="pull-right removeMultiFiles" rel="cr-<?php echo $cr;?>" url="/uploads/images/{{$files}}">
							<i class="fa fa-trash-o  btn btn-xs btn-danger"></i></span>
							<input type="hidden" name="currImage[]" value="{{ $files }}"/>
							<?php ++$cr;?>
						</li>
						@endif
					
					@endforeach
					</ul>
					 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> {!! Form::hidden('createdOn', $row['createdOn']) !!}{!! Form::hidden('updatedOn', $row['updatedOn']) !!}</fieldset>
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
		
		
		$("#Category").jCombo("{!! url('support/comboselect?filter=tbl_ticket_category:ticket_category_ID:ticket_category') !!}",
		{  selected_value : '{{ $row["Category"] }}' });
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
