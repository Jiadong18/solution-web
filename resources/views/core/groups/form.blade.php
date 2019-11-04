@extends('layouts.app')

@section('content')

    <section class="content-header">
      <h1>{{ Lang::get('core.m_groups') }} 
        <small>{{ $pageNote }}</small>
      </h1>
    </section>
 <div class="content">
		<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	@include('mmb.config.tab')	
<div class="col-md-9">
<div class="box box-primary ">
	<div class="box-header with-border"> 
		<div class="box-header-tools pull-left" >
			<a href="{{ url('core/groups?return='.$return) }}" class="tips"  title="{{ Lang::get('core.btn_back') }}" ><i class="fa  fa-arrow-left fa-2x"></i></a> 
		</div>
	</div>
	<div class="box-body"> 	

		 {!! Form::open(array('url'=>'core/groups/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}

									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Group Id" class=" control-label col-md-4 text-left"> 				{{Lang::get('core.groupid')}}</label>
									<div class="col-md-6">
									  {!! Form::text('group_id', $row['group_id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Name" class=" control-label col-md-4 text-left"> {{ Lang::get('core.groupname') }} <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  {!! Form::text('name', $row['name'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Description" class=" control-label col-md-4 text-left"> {{ Lang::get('core.description') }} </label>
									<div class="col-md-6">
									  <textarea name='description' rows='2' id='description' class='form-control '  
				           >{{ $row['description'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Level" class=" control-label col-md-4 text-left"> {{ Lang::get('core.level') }} <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  {!! Form::text('level', $row['level'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) !!} 
                                     <div class="callout callout-danger">{{ Lang::get('core.grouplevelwarning') }}</div>

									 </div> 
									 <div class="col-md-2">
									 </div>
                                      
								  </div> 
			
			
			<div style="clear:both"></div>	
				
					
				  <div class="form-group">
					<label class="col-sm-4 text-right">&nbsp;</label>
					<div class="col-sm-8">	
					<button type="submit" name="apply" class="btn btn-info btn-sm" > {{ Lang::get('core.sb_apply') }}</button>
					<button type="submit" name="submit" class="btn btn-primary btn-sm" ><i class="fa  fa-save "></i> {{ Lang::get('core.sb_save') }}</button>
					<button type="button" onclick="location.href='{{ URL::to('core/groups?return='.$return) }}' " class="btn btn-success btn-sm ">  {{ Lang::get('core.sb_cancel') }} </button>
					</div>	  
			
				  </div> 
		 
		 {!! Form::close() !!}
	</div>
</div>		 
</div>		 
</div>	
		                  			<div style="clear: both;"></div>
 
   <script type="text/javascript">
	$(document).ready(function() { 
		 
	});
	</script>		 
@stop