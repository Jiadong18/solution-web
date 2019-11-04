@extends('layouts.app')

@section('content')

    <section class="content-header">
      <h1> {{ Lang::get('core.visaapplication') }}</h1>
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

		 {!! Form::open(array('url'=>'visaapplication/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
<div class="col-md-12">
				{!! Form::hidden('applicationID', $row['applicationID']) !!}					
									  <div class="form-group  " >
										<label for="TravellersID" class=" control-label col-md-4 text-left"> Travellers<span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <select name='travellersID[]' multiple rows='5' id='travellersID' class='select2 ' required  ></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="CountryID" class=" control-label col-md-4 text-left"> Visa Application Country<span class="asterix"> * </span></label>
										<div class="col-md-4">
										  <select name='countryID' rows='5' id='countryID' class='select2 ' required  ></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Duration" class=" control-label col-md-4 text-left"> Visa Duration <span class="asterix"> * </span></label>
										<div class="col-md-1">
										  <input  type='text' name='duration' id='duration' value='{{ $row['duration'] }}' 
						required     class='form-control ' /> 
										 </div> 
                                          <div class="col-md-2">
										  
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
										<label for="Applicationdate" class=" control-label col-md-4 text-left"> Application Date </label>
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
										<label for="Processintime" class=" control-label col-md-4 text-left"> Processing Time </label>
										<div class="col-md-1">
										  <input  type='text' name='processintime' id='processintime' value='{{ $row['processintime'] }}' 
						     class='form-control ' /> 
										 </div> 
										<label for="Processintime" class=" control-label col-md-1 text-center">Days</label>
									  </div> 					
									  <div class="form-group  " >
										<label for="Payment" class=" control-label col-md-4 text-left"> Down Payment </label>
										<div class="col-md-2">
										  <input  type='text' name='payment' id='payment' value='{{ $row['payment'] }}' 
						     class='form-control ' /> 
										 </div> 
                                          <div class="col-md-2">
										  <select name='currencyID' rows='5' id='currencyID' class='select2 '   ></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="PaymenttypeID" class=" control-label col-md-4 text-left"> Payment Type </label>
										<div class="col-md-4">
										  <select name='paymenttypeID' rows='5' id='paymenttypeID' class='select2 '   ></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Applicationfee" class=" control-label col-md-4 text-left"> Application Fee </label>
										<div class="col-md-2">
										  <input  type='text' name='applicationfee' id='applicationfee' value='{{ $row['applicationfee'] }}' 
						     class='form-control ' /> 
										 </div> 
                                        <div class="col-md-2">
										  <select name='currencyID2' rows='5' id='currencyID2' class='select2 '   ></select> 
										 </div> 

										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Documents" class=" control-label col-md-4 text-left"> Documents </label>
										<div class="col-md-4">
										  
					<a href="javascript:void(0)" class="btn btn-xs btn-primary pull-right" onclick="addMoreFiles('documents')"><i class="fa fa-plus-square fa-2x"></i></a>
					<div class="documentsUpl">	
					 	<input  type='file' name='documents[]'  />			
					</div>
					<ul class="uploadedLists " >
					<?php $cr= 0; 
					$row['documents'] = explode(",",$row['documents']);
					?>
					@foreach($row['documents'] as $files)
						@if(file_exists('./uploads/files/'.$files) && $files !='')
                            <li id="cr-<?php echo $cr;?>" class=" text-muted well well-sm no-shadow" style="margin-top: 10px;">							
							<a href="{{ url('/uploads/files/'.$files) }}" target="_blank" >{{ $files }}</a> 
							<span class="pull-right removeMultiFiles" rel="cr-<?php echo $cr;?>" url="/uploads/files/{{$files}}">
							<i class="fa fa-trash-o fa-2x"
                               data-toggle="confirmation" 
                               data-title="{{Lang::get('core.rusure')}}" 
                               data-content="{{ Lang::get('core.youwanttodeletethis') }}" 
                               ></i></span>
							<input type="hidden" name="currdocuments[]" value="{{ $files }}"/>
							<?php ++$cr;?>
						</li>
                        
						@endif
					
					@endforeach
					</ul>
					 
										 </div> 
									  </div> 					
									  <div class="form-group  " >
										<label for="Status" class=" control-label col-md-4 text-left"> Status </label>
										<div class="col-md-6 status">
										  
					<label class='radio radio-inline'>
					<input type='radio' name='status' value ='1'  @if($row['status'] == '1') checked="checked" @endif > New </label>
					<label class='radio radio-inline'>
					<input type='radio' name='status' value ='2'  @if($row['status'] == '2') checked="checked" @endif > Pending </label>
					<label class='radio radio-inline'>
					<input type='radio' name='status' value ='3'  @if($row['status'] == '3') checked="checked" @endif > Approved </label> 
                    <label class='radio radio-inline'>
					<input type='radio' name='status' value ='0'  @if($row['status'] == '0') checked="checked" @endif > Rejected </label>

										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  visa-expiry-date" >
										<label for="Visaexpirydate" class=" control-label col-md-4 text-left"> Visa Expiry Date </label>
										<div class="col-md-6">
										  
				<div class="input-group m-b" style="width:150px !important;">
					{!! Form::text('visaexpirydate', $row['visaexpirydate'],array('class'=>'form-control date')) !!}
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  reject-reason" >
										<label for="Rejectreason" class=" control-label col-md-4 text-left"> Reject Reason </label>
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
									  </div>
			</div>
			
			

		
			<div style="clear:both"></div>	
				  <div class="form-group">
					<label class="col-sm-4 text-right">&nbsp;</label>
					<div class="col-sm-8">	
					<button type="submit" name="apply" class="btn btn-info btn-sm" > {{ Lang::get('core.sb_apply') }}</button>
					<button type="submit" name="submit" class="btn btn-primary btn-sm" > {{ Lang::get('core.sb_save') }}</button>
					<button type="button" onclick="location.href='{{ URL::to('visaapplication?return='.$return) }}' " class="btn btn-danger btn-sm ">{{ Lang::get('core.sb_cancel') }} </button>
					</div>	  
				  </div> 
		 
		 {!! Form::close() !!}
	</div>
</div>		 
</div>	
		 
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
		 

		$('.removeMultiFiles').on('click',function(){
			var removeUrl = '{{ url("visaapplication/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
        
    $('[data-toggle=confirmation]').confirmation({
    rootSelector: '[data-toggle=confirmation]',
    container: 'body'
    });
		

		

    $('.visa-expiry-date').hide(); 
    $('.reject-reason').hide(); 

	$('.status input:radio').on('ifClicked', function() {
	 	 val = $(this).val();
  			mType(val);
	  
	});
	
	mType('<?php echo $row['status'] ?>'); 
	
			
});	

function mType( val )
{
		if(val == '1') {
			$('.visa-expiry-date').hide(); 
			$('.reject-reason').hide();
		} 
		if(val == '2') {
			$('.visa-expiry-date').hide(); 
			$('.reject-reason').hide();
		} 
		if(val == '3') {
			$('.visa-expiry-date').show(); 
			$('.reject-reason').hide();
		} 
        if (val == '0'){
			$('.visa-expiry-date').hide(); 
			$('.reject-reason').show();
		}	
}

</script>	
@stop