 {!! Form::open(array('url'=>'core/config/addtranslation/', 'class'=>'form-horizontal ','parsley-validate'=>'','novalidate'=>' ')) !!}
 <div class="">
    <div class="form-group">
      <label for="ipt" class=" control-label col-md-4"> {{ Lang::get('core.language') }} </label>
    	<div class="col-md-8">
    	<input name="name" type="text" id="name" class="form-control input-sm" value="" required="true" /> 
    	</div> 
    </div>   	
   
    <div class="form-group">
      <label for="ipt" class=" control-label col-md-4"> {{ Lang::get('core.foldername') }}</label>
  	<div class="col-md-8">
  	<input name="folder" type="text" id="folder" class="form-control input-sm" value="" required /> 
  	 </div> 
    </div>   	
    
     <div class="form-group">
      <label for="ipt" class=" control-label col-md-4"> {{ Lang::get('core.author') }} </label>
  	<div class="col-md-8">
  	<input name="author" type="text" id="author" class="form-control input-sm" value="" required /> 
  	 </div> 
    </div>   	
    
    <div class="form-group">
      <label for="ipt" class=" control-label col-md-4">  </label>
    	<div class="col-md-8">
    		<button type="submit" name="submit" class="btn btn-info"> {{ Lang::get('core.addnewlanguage') }}</button>
    	</div> 
    </div>  
  </div> 	
<div class="callout callout-warning">{{ Lang::get('core.translationwarning') }} - <a href="http://en.wikipedia.org/wiki/ISO_3166-1_alpha-2" target="_blank"><b>{{ Lang::get('core.countrycodelist') }}</b></a></div>


 
 {!! Form::close() !!}