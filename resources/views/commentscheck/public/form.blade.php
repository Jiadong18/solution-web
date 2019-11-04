

		 {!! Form::open(array('url'=>'commentscheck/savepublic', 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}

	@if(Session::has('messagetext'))
	  
		   {!! Session::get('messagetext') !!}
	   
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>		


<div class="col-md-12">
						<fieldset><legend> Comments Check</legend>
				{!! Form::hidden('commentID', $row['commentID']) !!}					
									  <div class="form-group  " >
										<label for="PageID" class=" control-label col-md-4 text-left"> PageID </label>
										<div class="col-md-6">
										  <select name='pageID' rows='5' id='pageID' class='select2 '   ></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="UserID" class=" control-label col-md-4 text-left"> UserID </label>
										<div class="col-md-6">
										  <select name='userID' rows='5' id='userID' class='select2 '   ></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Comments" class=" control-label col-md-4 text-left"> Comments </label>
										<div class="col-md-6">
										  <input  type='text' name='comments' id='comments' value='{{ $row['comments'] }}' 
						     class='form-control ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Posted" class=" control-label col-md-4 text-left"> Posted </label>
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
										<label for="Approved" class=" control-label col-md-4 text-left"> Approved </label>
										<div class="col-md-6">
										  <?php $approved = explode(",",$row['approved']); ?>
					 <label class='checked checkbox-inline'>   
					<input type='checkbox' name='approved[]' value ='1'   class='' 
					@if(in_array('1',$approved))checked @endif 
					 /> Approve </label>  
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
		
		
		$("#pageID").jCombo("{!! url('commentscheck/comboselect?filter=tb_pages:pageID:title') !!}",
		{  selected_value : '{{ $row["pageID"] }}' });
		
		$("#userID").jCombo("{!! url('commentscheck/comboselect?filter=tb_users:id:username') !!}",
		{  selected_value : '{{ $row["userID"] }}' });
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
