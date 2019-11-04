       {!! Form::open(array('url'=>'faqs/section', 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ' ,'id'=>'formpost'
      )) !!}

        <div class="form-group  " >
          <label for="Topic" class="col-md-3 control-label text-right">{{ Lang::get('core.title') }}</label>
        <div class="col-md-7">
          {!! Form::text('title', $row->title ,array('class'=>'form-control', 'placeholder'=>' ','required'=>'true'   )) !!} 
        </div> 
        </div>
        <div class="form-group" >
          <label for="Topic" class="col-md-3 control-label text-right">{{ Lang::get('core.grid_order') }} </label>
            <div class="col-md-7">
           {!! Form::text('orderID', $row->orderID ,array('class'=>'form-control', 'placeholder'=>' ','required'=>'true'   )) !!}
            </div>   
        </div>
        <div class="form-group" >
                        <div class="col-md-6">
          <button class="btn btn-primary pull-right"> {{ Lang::get('core.sb_save') }}</button>
        </div>  
        </div>  
      <input type="hidden" name="sectionID" value="{{ $row->sectionID }}">
      <input type="hidden" name="faqID" value="{{ $row->faqID }}">
      {!! Form::close() !!}
	 		<div class="clr clear"></div>
    <script language="javascript">
    jQuery(document).ready(function($)  {
    
       $('#formpost').parsley();
    });
    </script>     