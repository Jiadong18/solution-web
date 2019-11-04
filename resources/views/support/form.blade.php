@extends('layouts.app')

@section('content')

    <section class="content-header">
      <h1> {{ Lang::get('core.support') }}</h1>
    </section>

  <div class="content"> 
      <div class="box box-primary">
	<div class="box-header with-border">
		<div class="box-header-tools pull-left" >
			<a href="{{ url($pageModule.'?return='.$return) }}" class="tips"  title="{{ Lang::get('core.btn_back') }}" ><i class="fa  fa-arrow-left fa-2x"></i></a> 
		</div>
	</div>
	<div class="box-body"> 	
		<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>	

		 {!! Form::open(array('url'=>'support/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
<div class="col-md-12">
				{!! Form::hidden('TicketID', $row['TicketID']) !!}
                {!! Form::hidden('UserID', Session::get('uid')) !!}					
									  <div class="form-group  " >
										<label for="Title" class=" control-label col-md-4 text-left"> {{ Lang::get('core.title') }} <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <input  type='text' name='Title' id='Title' value='{{ $row['Title'] }}' 
						required     class='form-control ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									   					
									  <div class="form-group  " >
										<label for="Priority" class=" control-label col-md-4 text-left"> {{ Lang::get('core.priority') }} <span class="asterix"> * </span></label>
										<div class="col-md-2">
										  
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
										<label for="Description" class=" control-label col-md-4 text-left"> {{ Lang::get('core.description') }} <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <textarea name='Description' rows='5' id='editor' class='form-control editor '  
						required >{{ $row['Description'] }}</textarea> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Department" class=" control-label col-md-4 text-left"> {{ Lang::get('core.department') }} <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  
					<label class='radio radio-inline'>
					<input type='radio' name='Category' value ='1' required @if($row['Category'] == '1') checked="checked" @endif > {{ Lang::get('core.tour') }} </label>
					<label class='radio radio-inline'>
					<input type='radio' name='Category' value ='2' required @if($row['Category'] == '2') checked="checked" @endif > {{ Lang::get('core.hotel') }} </label>
					<label class='radio radio-inline'>
					<input type='radio' name='Category' value ='3' required @if($row['Category'] == '3') checked="checked" @endif > {{ Lang::get('core.flight') }} </label>
					<label class='radio radio-inline'>
					<input type='radio' name='Category' value ='4' required @if($row['Category'] == '4') checked="checked" @endif > {{ Lang::get('core.rentacar') }} </label>
					<label class='radio radio-inline'>
					<input type='radio' name='Category' value ='5' required @if($row['Category'] == '5') checked="checked" @endif > {{ Lang::get('core.extraservice') }} </label> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Status" class=" control-label col-md-4 text-left"> {{ Lang::get('core.status') }} <span class="asterix"> * </span></label>
										<div class="col-md-2">
										  
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
										<label for="Image" class=" control-label col-md-4 text-left"> {{ Lang::get('core.image') }} </label>
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
									  </div> {!! Form::hidden('createdOn', $row['createdOn']) !!}{!! Form::hidden('updatedOn', $row['updatedOn']) !!}
			</div>
			
			

		
			<div style="clear:both"></div>	
				  <div class="form-group">
					<label class="col-sm-4 text-right">&nbsp;</label>
					<div class="col-sm-8">	
					<button type="submit" name="apply" class="btn btn-info btn-sm" >{{ Lang::get('core.sb_apply') }}</button>
					<button type="submit" name="submit" class="btn btn-primary btn-sm" > {{ Lang::get('core.sb_save') }}</button>
					<button type="button" onclick="location.href='{{ URL::to('support?return='.$return) }}' " class="btn btn-danger btn-sm "> {{ Lang::get('core.sb_cancel') }} </button>
					</div>	  
				  </div> 
		 
		 {!! Form::close() !!}
	</div>
</div>		 
</div>	
		 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		
		$("#Category").jCombo("{!! url('support/comboselect?filter=tbl_ticket_category:ticket_category_ID:ticket_category') !!}",
		{  selected_value : '{{ $row["Category"] }}' });
		 

		$('.removeMultiFiles').on('click',function(){
			var removeUrl = '{{ url("support/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
@stop