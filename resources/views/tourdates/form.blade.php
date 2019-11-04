@extends('layouts.app')

@section('content')
<?php 
use Carbon\Carbon;
?>
    <section class="content-header">
      <h1> {{ Lang::get('core.tourdates') }}</h1>
    </section>

  <div class="content"> 

<div class="box box-primary">
	<div class="box-header with-border">

		<div class="box-header-tools pull-left" >
			<a href="{{ url($pageModule.'?return='.$return) }}" class="tips"  title="{{ Lang::get('core.btn_back') }}" ><i class="fa  fa-arrow-left fa-2x"></i></a> 
		</div>
	</div>
    @if( $row['start']> Carbon::today() or $row['start'] ==NULL )
	<div class="box-body"> 	

		<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>


		 {!! Form::open(array('url'=>'tourdates/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
        
            				{!! Form::hidden('tourdateID', $row['tourdateID']) !!}					
                            <div class="form-group  " >
                                <label for="Tour Category" class=" control-label col-md-5 text-left"> {{ Lang::get('core.tourcategory') }} <span class="asterix"> * </span></label>
										<div class="col-md-4">
										  <select name='tourcategoriesID' rows='5' id='tourcategoriesID' class='select2 ' required  ></select> 
										 </div> 
									  </div> 	
                            
                            
									  <div class="form-group  " >
										<label for="Tour Name" class=" control-label col-md-5 text-left"> {{ Lang::get('core.tourname') }} <span class="asterix"> * </span></label>
										<div class="col-md-4">
										  <select name='tourID' rows='5' id='tourID' class='select2 ' required  ></select> 
										 </div> 
									  </div> 					
									  <div class="form-group  " >
										<label for="Tour Code" class=" control-label col-md-5 text-left"> {{ Lang::get('core.tourcode') }} <span class="asterix"> * </span></label>
										<div class="col-md-4">
										  <input  type='text' name='tour_code' id='tour_code' value='{{ $row['tour_code'] }}' 
						required     class='form-control ' /> 
										 </div> 
									  </div> 
									  <div class="form-group  " >
										<label for="Start Date" class=" control-label col-md-5 text-left"> {{ Lang::get('core.start') }} <span class="asterix"> * </span></label>
										<div class="col-md-7">

				<div class="input-group m-b" style="width:150px !important;" id="dpd1">
					{!! Form::text('start', $row['start'],array('class'=>'form-control date')) !!}
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div> 
										 </div> 
									  </div> 					
									  <div class="form-group  " >
										<label for="End Date" class=" control-label col-md-5 text-left"> {{ Lang::get('core.end') }} <span class="asterix"> * </span></label>
										<div class="col-md-7">
										  
				<div class="input-group m-b" style="width:150px !important;" id="dpd2">
					{!! Form::text('end', $row['end'],array('class'=>'form-control date')) !!}

					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div> 
										 </div> 
									  </div> 
                <div class="form-group  " >
										<label for="Group Size" class=" control-label col-md-5 text-left"> {{ Lang::get('core.groupsize') }} <span class="asterix"> * </span></label>
										<div class="col-md-2">
										  <input  type='text' name='total_capacity' id='total_capacity' value='{{ $row['total_capacity'] }}' 
						required     class='form-control ' /> 
										 </div> 
									  </div>
                <div class="form-group  " >
										<label for="Featured" class=" control-label col-md-5 text-left"> {{ Lang::get('core.featured') }} </label>
										<div class="col-md-7">
										  <?php $featured = explode(",",$row['featured']); ?>
					 <label class='checked checkbox-inline'>   
					<input type='checkbox' name='featured[]' value ='1'   class='' 
					@if(in_array('1',$featured))checked @endif 
					 />  </label>  
										 </div> 
									  </div> 					
									  <div class="form-group  " >
										<label for="Definite Departure" class=" control-label col-md-5 text-left"> {{ Lang::get('core.definitedeparture') }} </label>
										<div class="col-md-7">
										  <?php $definite_departure = explode(",",$row['definite_departure']); ?>
					 <label class='checked checkbox-inline'>   
					<input type='checkbox' name='definite_departure[]' value ='2'   class='' 
					@if(in_array('2',$definite_departure))checked @endif 
					 /> </label>  
										 </div> 
									  </div>
    <fieldset><legend>{{ Lang::get('core.tourfeatures') }}</legend>
            <div class="form-group  " >
										<label for="Guide" class=" control-label col-md-5 text-left"> {{ Lang::get('core.guide') }} </label>
										<div class="col-md-5">
										  <select name='guideID' rows='5' id='guideID' class='select2 '   ></select> 
										 </div> 
									  </div> 														  
        <div class="form-group  " >
										<label for="Currency" class=" control-label col-md-5 text-left"> {{ Lang::get('core.currency') }} </label>
										<div class="col-md-4">
										  <select name='currencyID' rows='5' id='currencyID' class='select2 '   ></select> 
										 </div> 
									  </div> 					
									  <div class="form-group  " >
										<label for="Tour Cost for Single room" class=" control-label col-md-5 text-left"> {{ Lang::get('core.tourcostsingle') }} </label>
										<div class="col-md-2">
										  <input  type='text' name='cost_single' id='cost_single' value='{{ $row['cost_single'] }}' 
						     class='form-control ' /> 
										 </div> 
									  </div> 					
									  <div class="form-group  " >
										<label for="Tour Cost for Double Room " class=" control-label col-md-5 text-left"> {{ Lang::get('core.tourcostdouble') }}  </label>
										<div class="col-md-2">
										  <input  type='text' name='cost_double' id='cost_double' value='{{ $row['cost_double'] }}' 
						     class='form-control ' /> 
										 </div> 
									  </div> 					
									  <div class="form-group  " >
										<label for="Tour Cost for Triple Room" class=" control-label col-md-5 text-left"> {{ Lang::get('core.tourcosttriple') }} </label>
										<div class="col-md-2">
										  <input  type='text' name='cost_triple' id='cost_triple' value='{{ $row['cost_triple'] }}' 
						     class='form-control ' /> 
										 </div> 
									  </div> 					
									  <div class="form-group  " >
										<label for="Tour Cost for a Child" class=" control-label col-md-5 text-left"> {{ Lang::get('core.tourcostchild') }} </label>
										<div class="col-md-2">
										  <input  type='text' name='cost_child' id='cost_child' value='{{ $row['cost_child'] }}' 
						     class='form-control ' /> 
										 </div> 
									  </div>
        
        <div class="form-group  " >
										<label for="Remarks" class=" control-label col-md-5 text-left"> {{ Lang::get('core.remarks') }}</label>
										<div class="col-md-6">
										  <textarea name='remarks' rows='5' id='remarks' class='form-control'  
				         required  >{{ $row['remarks'] }}</textarea> 
										 </div> 
									  </div>
    <div class="form-group  " >
            <label for="Color" class=" control-label col-md-2 text-left"> {{ Lang::get('core.tourcolor') }}</label>
				<div class="col-md-10">
					<label class='radio radio-inline'>
					<input type='radio' name='color' value ='#4cc0c1' @if($row['color'] == '#4cc0c1') checked="checked" @endif > <a class="text-aqua" href="#"><i class="fa fa-square fa-lg"></i></a> </label>
					<label class='radio radio-inline'>
					<input type='radio' name='color' value ='#0073b7' @if($row['color'] == '#0073b7') checked="checked" @endif > <a class="text-blue" href="#"><i class="fa fa-square fa-lg"></i></a> </label>
					<label class='radio radio-inline'>
					<input type='radio' name='color' value ='#55ACEE' @if($row['color'] == '#55ACEE') checked="checked" @endif > <a class="text-light-blue" href="#"><i class="fa fa-square fa-lg"></i></a> </label>
					<label class='radio radio-inline'>
					<input type='radio' name='color' value ='#39cccc'  @if($row['color'] == '#39cccc') checked="checked" @endif > <a class="text-teal" href="#"><i class="fa fa-square fa-lg"></i></a> </label>
					<label class='radio radio-inline'>
					<input type='radio' name='color' value ='#ffc333'  @if($row['color'] == '#ffc333') checked="checked" @endif > <a class="text-yellow" href="#"><i class="fa fa-square fa-lg"></i></a> </label>
					<label class='radio radio-inline'>
					<input type='radio' name='color' value ='#ff851b'  @if($row['color'] == '#ff851b') checked="checked" @endif > <a class="text-orange" href="#"><i class="fa fa-square fa-lg"></i></a> </label>
					<label class='radio radio-inline'>
					<input type='radio' name='color' value ='#65bd77'  @if($row['color'] == '#65bd77') checked="checked" @endif > <a class="text-green" href="#"><i class="fa fa-square fa-lg"></i></a> </label>
					<label class='radio radio-inline'>
					<input type='radio' name='color' value ='#fb6b5b'  @if($row['color'] == '#fb6b5b') checked="checked" @endif > <a class="text-red" href="#"><i class="fa fa-square fa-lg"></i></a> </label>
					<label class='radio radio-inline'>
					<input type='radio' name='color' value ='#605ca8'  @if($row['color'] == '#605ca8') checked="checked" @endif > <a class="text-purple" href="#"><i class="fa fa-square fa-lg"></i></a> </label>
					<label class='radio radio-inline'>
					<input type='radio' name='color' value ='#999'  @if($row['color'] == '#999') checked="checked" @endif > <a class="text-muted" href="#"><i class="fa fa-square fa-lg"></i></a> </label>
					<label class='radio radio-inline'>
					<input type='radio' name='color' value ='#001f3f'  @if($row['color'] == '#001f3f') checked="checked" @endif > <a class="text-navy" href="#"><i class="fa fa-square fa-lg"></i></a> </label>					 
            </div> 							 
        </div>
        
        
        <div class="form-group  " >
										<label for="Status" class=" control-label col-md-5 text-left"> {{ Lang::get('core.status') }} <span class="asterix"> * </span></label>
										<div class="col-md-7">
										  
					<label class='radio radio-inline'>
					<input type='radio' name='status' value ='0' required @if($row['status'] == '0') checked="checked" @endif > {{ Lang::get('core.fr_minactive') }} </label>
					<label class='radio radio-inline'>
					<input type='radio' name='status' value ='1' required @if($row['status'] == '1') checked="checked" @endif > {{ Lang::get('core.fr_mactive') }} </label> 
					<label class='radio radio-inline'>
					<input type='radio' name='status' value ='2' required @if($row['status'] == '2') checked="checked" @endif > {{ Lang::get('core.cancelled') }} </label> 
										 </div> 
									  </div>
            
</fieldset>
			<div style="clear:both"></div>	
				
				  <div class="form-group">
					<label class="col-sm-4 text-right">&nbsp;</label>
					<div class="col-sm-8">	
					<button type="submit" name="apply" class="btn btn-info btn-sm" > {{ Lang::get('core.sb_apply') }}</button>
					<button type="submit" name="submit" class="btn btn-primary btn-sm" > {{ Lang::get('core.sb_save') }}</button>
					<button type="button" onclick="location.href='{{ URL::to('tourdates?return='.$return) }}' " class="btn btn-danger btn-sm ">  {{ Lang::get('core.sb_cancel') }} </button>
					</div>	  
			
				  </div> 
		 
		 {!! Form::close() !!}
	</div>
    @else
    
    <H1>{{ Lang::get('core.youcanteditthistour') }}</H1>

    @endif

</div>		 
</div>	
   <script type="text/javascript">
	$(document).ready(function() { 
		
		
		$("#tourcategoriesID").jCombo("{!! url('tourdates/comboselect?filter=def_tour_categories:tourcategoriesID:tourcategoryname&limit=WHERE:status:=:1') !!}",
		{  selected_value : '{{ $row["tourcategoriesID"] }}' });
		
		$("#tourID").jCombo("{!! url('tourdates/comboselect?filter=tours:tourID:tour_name&limit=WHERE:departs:=:3') !!}&parent=tourcategoriesID:",
		{  parent: '#tourcategoriesID', selected_value : '{{ $row["tourID"] }}' });
		
		$("#guideID").jCombo("{!! url('tourdates/comboselect?filter=guides:guideID:name&limit=WHERE:status:=:1') !!}",
		{  selected_value : '{{ $row["guideID"] }}' });
		
		$("#currencyID").jCombo("{!! url('tourdates/comboselect?filter=def_currency:currencyID:currency_sym|symbol&limit=WHERE:status:=:1') !!}",
		{  selected_value : '{{ $row["currencyID"] }}' });
		

		$('.removeMultiFiles').on('click',function(){
			var removeUrl = '{{ url("tourdates/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
	});       
    $(".date").datetimepicker({
        format: 'yyyy-mm-dd', 
        startDate: '{{ Carbon::today()->format('Y-m-d') }}',
        autoclose:true , 
        minView:2 , 
        startView:2 , 
        todayBtn:true
    });
    $("input[name='total_capacity'], input[name='cost_single'], input[name='cost_double'], input[name='cost_triple'], input[name='cost_child']").TouchSpin();
</script>


@stop