   {!! Form::open(array('url'=>'faqs/item', 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ' ,'id'=>'formpost'
  )) !!}

    <div class="form-group" >
      <label for="Topic" class="col-md-3 control-label text-right"> {{ Lang::get('core.section') }}  </label>
              <div class="col-md-8">
<select name="sectionID" required="true" class="form-control">
      		<option value="">{{ Lang::get('core.selectsection') }} </option>
      		@foreach($section as $sec)
      		<option value="{{ $sec->sectionID }}" @if($sec->sectionID == $row->sectionID) selected @endif >{{ $sec->title }}</option>
      		@endforeach
      </select>
    </div> 
    </div> 
    <div class="form-group  " >
      <label for="Topic" class="col-md-3  control-label text-right"> {{ Lang::get('core.question') }}  </label>
        <div class="col-md-8">
      {!! Form::text('question', $row->question ,array('class'=>'form-control', 'placeholder'=>' ','required'=>'true'   )) !!} 
    </div> 
    </div> 
    <div class="form-group  " >
      <label for="Topic" class="col-md-3  control-label text-right"> {{ Lang::get('core.answer') }}  </label>              
        <div class="col-md-8">
       <textarea name="answer" rows="10 " class="form-control editor" required="true">{{  $row->answer }}</textarea>
    </div>
    </div>
    <div class="form-group  " >
      <label for="Topic" class="col-md-3  control-label text-right"> {{ Lang::get('core.grid_order') }}  </label>              
        <div class="col-md-8">
      {!! Form::text('ordering', $row->ordering ,array('class'=>'form-control', 'placeholder'=>' ','required'=>'true'   )) !!} 
    </div> 
    </div>   
    <div class="form-group  " >
        
        <div class="col-md-6 pull-right">
      <button class="btn btn-primary"> {{ Lang::get('core.submit') }}</button>
       <button class="btn btn-danger closeItem" type="button"> {{ Lang::get('core.sb_cancel') }} </button>
    </div>  
    </div>  
  <input type="hidden" name="faqID" value="{{ $row->faqID }}">
  <input type="hidden" name="id" value="{{ $row->id }}">
  {!! Form::close() !!}
	 		<div class="clr clear"></div>


    <script language="javascript">
    jQuery(document).ready(function($)  {
    
       $('#formpost').parsley();
       $('.editor').summernote();
    });
    </script>    
