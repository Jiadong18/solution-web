@extends('layouts.app')

@section('content')
    <section class="content-header">
      <h1> {{ Lang::get('core.m_blastemail') }}  </h1>
    </section>
	<ul class="parsley-error-list">
	</ul>	
 <div class="content">            
    	@include('mmb.config.tab')	
<div class="col-md-9">
<div class="box box-primary ">
  <div class="box-body"> 
  @if(Session::has('message'))    
       {{ Session::get('message') }}
  @endif  
{!! Form::open(array('url'=>'core/users/doblast/', 'class'=>'form-horizontal ')) !!}
              <ul class="parsley-error-list">
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>                
<div class="col-sm-6">
          <div class="form-group  " >
          <label for="ipt" class=" control-label col-md-4"> {{ Lang::get('core.fr_emailsendto') }}   </label>
          <div class="col-md-8">
           @foreach($groups as $row)
            <label class="checkbox">
              <input type="checkbox"   name="groups[]" value="{{ $row->group_id}}" /> {{ $row->name }}
            </label>
           @endforeach
           </div> 
          </div>  
</div>
<div class="col-sm-6">
          <div class="form-group  " >
          <label for="ipt" class=" control-label col-md-4">  {{ Lang::get('core.status') }}    </label>
          <div class="col-md-8">          
            <label class="radio">
              <input type="radio"   name="uStatus" value="all" > {{ Lang::get('core.allstatus') }} 
            </label>
            <label class="radio">
              <input type="radio"  name="uStatus" value="1" > {{ Lang::get('core.active') }}  
            </label>  
            <label class="radio">
              <input type="radio"  name="uStatus" value="0" > {{ Lang::get('core.pending') }} 
            </label>
            <label class="radio">
              <input type="radio"  name="uStatus" value="2"> {{ Lang::get('core.blocked') }} 
            </label>                                
           </div> 
          </div>  
</div>
 <div class="col-sm-12">
     <div class="form-group  " >
               <label for="ipt" class=" control-label col-md-2">  {{ Lang::get('core.fr_emailsubject') }}   </label>
          <div class="col-md-8">
               {!! Form::text('subject',null,array('class'=>'form-control', 'placeholder'=>'','required'=>'true')) !!} 
           </div> 
          </div>
      </div>
 <div class="col-sm-12">
     
          <div class="form-group "  >
		   <label for="ipt" class=" control-label col-md-2"> {{ Lang::get('core.fr_emailmessage') }} </label>
                     <div class="col-md-10">
<textarea class="form-control editor" rows="5"   name="message"></textarea> 
          </div> 
          </div> 
          <div class="form-group" >
          <label for="ipt" class=" control-label col-md-2"> </label>
          <div class="col-md-8">
              <button type="submit" name="submit" class="btn btn-primary">{{ Lang::get('core.sendmail') }} </button>
           </div> 
          </div> 
	</div>	                   
     {!! Form::close() !!}
</div>
</div>
     </div>  
     </div>  

<style type="text/css" >
  .note-editable { min-height: 200px;}
</style>
                  			<div style="clear: both;"></div>



@stop