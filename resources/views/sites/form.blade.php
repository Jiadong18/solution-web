@extends('layouts.app')

@section('content')

    <section class="content-header">
  <h1> {{ Lang::get('core.touristicsites') }}</h1>
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

		 {!! Form::open(array('url'=>'sites/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
<div class="col-md-12">
				{!! Form::hidden('siteID', $row['siteID']) !!}					
									  <div class="form-group  " >
										<label for="Site Name" class=" control-label col-md-4 text-left"> {{ Lang::get('core.touristicsites') }} <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <input  type='text' name='site_name' id='site_name' value='{{ $row['site_name'] }}' 
						required     class='form-control ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Country" class=" control-label col-md-4 text-left"> {{ Lang::get('core.country') }} <span class="asterix"> * </span></label>
										<div class="col-md-3">
										  <select name='countryID' rows='5' id='countryID' class='select2 ' required  ></select> 
										 </div> 
                                          <label for="City" class=" control-label col-md-1 text-left"> {{ Lang::get('core.city') }} <span class="asterix"> * </span></label>
										<div class="col-md-2">
										  <select name='cityID' rows='5' id='cityID' class='select2 ' required  ></select> 
										 </div> 
									  </div> 					
									  <div class="form-group  " >
										<label for="Image" class=" control-label col-md-4 text-left"> {{ Lang::get('core.image') }} </label>
										<div class="col-md-6">
										  
					<a href="javascript:void(0)" class="btn btn-xs btn-primary pull-right" onclick="addMoreFiles('image')"><i class="fa fa-plus fa-lg"></i></a>
					<div class="imageUpl">	
					 	<input  type='file' name='image[]'  />			
					</div>
					<ul class="uploadedLists " >
					<?php $cr= 0; 
					$row['image'] = explode(",",$row['image']);
					?>
					@foreach($row['image'] as $files)
						@if(file_exists('./uploads/images/'.$files) && $files !='')
						<li id="cr-<?php echo $cr;?>" class="">							
							<a href="{{ url('/uploads/images//'.$files) }}" target="_blank" >{{ $files }}</a> 
							<span class="pull-right removeMultiFiles" rel="cr-<?php echo $cr;?>" url="/uploads/images/{{$files}}">
							<i class="fa fa-trash-o fa-2x"></i></span>
							<input type="hidden" name="currimage[]" value="{{ $files }}"/>
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
										<label for="Featured" class=" control-label col-md-4 text-left"> {{ Lang::get('core.featured') }} </label>
										<div class="col-md-6">
										  <?php $featured = explode(",",$row['featured']); ?>
					 <label class='checked checkbox-inline'>   
					<input type='checkbox' name='featured[]' value ='1'   class='' 
					@if(in_array('1',$featured))checked @endif 
					 /></label>  
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Site Description" class=" control-label col-md-4 text-left">{{ Lang::get('core.description') }} <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <textarea name='description' rows='5' id='description' class='form-control '  
				         required  >{{ $row['description'] }}</textarea> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Status" class=" control-label col-md-4 text-left"> {{ Lang::get('core.status') }} <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  
					<label class='radio radio-inline'>
					<input type='radio' name='status' value ='0' required @if($row['status'] == '0') checked="checked" @endif > {{ Lang::get('core.fr_minactive') }} </label>
					<label class='radio radio-inline'>
					<input type='radio' name='status' value ='1' required @if($row['status'] == '1') checked="checked" @endif > {{ Lang::get('core.active') }} </label> 
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
					<button type="button" onclick="location.href='{{ URL::to('sites?return='.$return) }}' " class="btn btn-danger btn-sm ">  {{ Lang::get('core.sb_cancel') }} </button>
					</div>	  
				  </div> 
		 
		 {!! Form::close() !!}
	</div>
</div>		 
</div>	
		 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		
		$("#countryID").jCombo("{!! url('sites/comboselect?filter=def_country:countryID:country_name') !!}",
		{  selected_value : '{{ $row["countryID"] }}' });
		
		$("#cityID").jCombo("{!! url('sites/comboselect?filter=def_city:cityID:city_name') !!}&parent=countryID:",
		{  parent: '#countryID', selected_value : '{{ $row["cityID"] }}' });
		 

		$('.removeMultiFiles').on('click',function(){
			var removeUrl = '{{ url("sites/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
@stop