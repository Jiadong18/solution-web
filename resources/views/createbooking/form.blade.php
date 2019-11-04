@extends('layouts.app')

@section('content')

    <section class="content-header">
      <h1> {{ Lang::get('core.createbooking') }}</h1>
    </section>

  <div class="content"> 
      <div class="box box-primary">
	<div class="box-header with-border">
		<div class="box-header-tools pull-left" >
			<a href="{{ url($pageModule.'?return='.$return) }}" class="tips"  title="{{ Lang::get('core.btn_back') }}" ><i class="fa  fa-arrow-left fa-2x"></i></a> 
		</div>
		<div class="box-header-tools " >
		</div> 
	</div>
	<div class="box-body"> 	
		<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>	

		 {!! Form::open(array('url'=>'createbooking/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
<div class="col-md-12">
                            <?php 
                            $bookingno1 = substr(str_shuffle(str_repeat("ABCDEFGHJKLMNPQRSTUVWYZ", 4)), 0, 4);
                            $bookingno2 = substr(str_shuffle(str_repeat("123456789", 6)), 0, 6);
                            ?>

				{!! Form::hidden('bookingsID', $row['bookingsID']) !!}	
    
    @if($row['bookingno'] == NULL)
				{!! Form::hidden('bookingno', $bookingno1.$bookingno2 )!!}	
    @else
                {!! Form::hidden('bookingno', $row['bookingno'] )!!}	
    @endif
									  <div class="form-group  " >
										<label for="TravellerID" class=" control-label col-md-5 text-left"> {{ Lang::get('core.namesurname') }} <span class="asterix"> * </span></label>
										<div class="col-md-5">
										  <select name='travellerID' rows='5' id='travellerID' class='select2 ' required  ></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
                                    <div class="col-md-1">
										 </div>

										<div class="col-md-2">
										  <?php $tour = explode(",",$row['tour']); ?>
					 <label class='checked checkbox-inline text-center'>  <a class="btn btn-app">
                <i class="fa fa-globe"></i> {{ Lang::get('core.tour') }}
              </a><br> 
					<input type='checkbox' name='tour[]' value ='1'   class='' 
					@if(in_array('1',$tour))checked  @endif 
					 />  </label>  
										 </div> 
										<div class="col-md-2">
										  <?php $hotel = explode(",",$row['hotel']); ?>
					 <label class='checked checkbox-inline text-center'><a class="btn btn-app">
                <i class="fa fa-bed"></i> {{ Lang::get('core.hotel') }}
              </a><br>   
					<input type='checkbox' name='hotel[]' value ='1'   class='' 
					@if(in_array('1',$hotel))checked  @endif 
					 />  </label>  
										 </div> 
										<div class="col-md-2">
										  <?php $flight = explode(",",$row['flight']); ?>
					 <label class='checked checkbox-inline text-center'><a class="btn btn-app">
                <i class="fa fa-plane"></i> {{ Lang::get('core.flight') }}
              </a><br>   
					<input type='checkbox'  name='flight[]' value ='1'   class='' 
					@if(in_array('1',$flight))checked  @endif 
					 />  </label>  
										 </div> 
										<div class="col-md-2">
										  <?php $car = explode(",",$row['car']); ?>
					 <label class='checked checkbox-inline text-center'>  <a class="btn btn-app">
                <i class="fa fa-car"></i> {{ Lang::get('core.car') }}
              </a><br> 
					<input type='checkbox' name='car[]' value ='1'   class='' 
					@if(in_array('1',$car))checked  @endif 
					 />  </label>  
										 </div> 
										<div class="col-md-2">
										  <?php $extraservices = explode(",",$row['extraservices']); ?>
					 <label class='checked checkbox-inline text-center'><a class="btn btn-app">
                <i class="fa fa-plus-square-o fa-2x"></i> {{ Lang::get('core.extra') }}
              </a><br>   
					<input type='checkbox' name='extraservices[]' value ='1'   class='' 
					@if(in_array('1',$extraservices))checked  @endif 
					 />  </label>  
										 </div> 
                        <div class="col-md-1">
										 	
										 </div>

									  </div>
			</div>
			
			

		
			<div style="clear:both"></div>	
				  <div class="form-group">
					<label class="col-sm-4 text-right">&nbsp;</label>
					<div class="col-sm-8">	
					<button type="submit" name="apply" class="btn btn-info btn-sm" > {{ Lang::get('core.sb_apply') }}</button>
					<button type="submit" name="submit" class="btn btn-primary btn-sm" > {{ Lang::get('core.sb_save') }}</button>
					<button type="button" onclick="location.href='{{ URL::to('createbooking?return='.$return) }}' " class="btn btn-danger"> {{ Lang::get('core.sb_cancel') }} </button>
					</div>	  
				  </div> 
		 
		 {!! Form::close() !!}
	</div>
</div>		 
</div>	
		 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		
		$("#travellerID").jCombo("{!! url('createbooking/comboselect?filter=travellers:travellerID:nameandsurname&limit=WHERE:status:=:1') !!}",
        {  selected_value : '@if ( app('request')->input('travellerID') != NULL ) {{app('request')->input('travellerID')}} @else {{ $row["travellerID"] }} @endif' });

		 
		$('.removeMultiFiles').on('click',function(){
			var removeUrl = '{{ url("createbooking/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
@stop