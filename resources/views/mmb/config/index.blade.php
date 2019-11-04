@extends('layouts.app')
@section('content')
    <section class="content-header">
      <h1>{{ Lang::get('core.generalsettings') }}</h1>
    </section>
  <div class="content"> 
	@if(Session::has('message'))
		   {{ Session::get('message') }}
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>	
@include('mmb.config.tab')	
<div class="col-md-9">
<div class="box box-primary">
  <div class="box-body"> 
		 {!! Form::open(array('url'=>'core/config/save/', 'class'=>'form-horizontal row', 'files' => true)) !!}

		 <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4">{{ Lang::get('core.fr_comname') }} </label>
			<div class="col-md-6">
			<input name="cnf_comname" type="text" id="cnf_comname" class="form-control input-sm" value="{{ CNF_COMNAME }}" />  
			 </div> 
		  </div>  
            
            <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4">{{ Lang::get('core.address') }} </label>
<div class="col-md-6">
            <textarea rows="3" class="form-control input-sm" name="cnf_address">{{ CNF_ADDRESS }}</textarea>
			 </div> 
		  </div>
            
            <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4">{{ Lang::get('core.tel') }} </label>
<div class="col-md-6">
			<input name="cnf_tel" type="text" id="cnf_tel" class="form-control input-sm" value="{{ CNF_TEL }}" />  
			 </div> 
		  </div>
            
            <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4">{{ Lang::get('core.fr_emailsys') }} </label>
<div class="col-md-6">
			<input name="cnf_email" type="text" id="cnf_email" class="form-control input-sm" value="{{ CNF_EMAIL }}" /> 
			 </div> 
		  </div>
          <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4"><i class="fa fa-facebook-official fa-2x text-navy" aria-hidden="true"></i> </label>
<div class="col-md-6">
			<input name="cnf_facebook" type="text" id="cnf_facebook" class="form-control input-sm" placeholder="https://www.facebook.com/yourcompanyname" value="{{ CNF_FACEBOOK }}" /> 
			 </div> 
		  </div>
          <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4"><i class="fa fa-twitter-square fa-2x text-aqua" aria-hidden="true"></i>
</label>
<div class="col-md-6">
			<input name="cnf_twitter" type="text" id="cnf_twitter" class="form-control input-sm" placeholder="https://www.twitter.com/yourcompanyname" value="{{ CNF_TWITTER }}" /> 
			 </div> 
		  </div>
          <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4"><i class="fa fa-instagram fa-2x text-red" aria-hidden="true"></i>
 </label>
<div class="col-md-6">
			<input name="cnf_instagram" type="text" id="cnf_instagram" class="form-control input-sm" placeholder="https://www.instagram.com/yourcompanyname" value="{{ CNF_INSTAGRAM }}" /> 
			 </div> 
		  </div>

            <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4"><i class="fa fa-tripadvisor fa-2x text-green" aria-hidden="true"></i></label>
<div class="col-md-6">
			<input name="cnf_tripadvisor" type="text" id="cnf_tripadvisor" class="form-control input-sm" placeholder="https://www.tripadvisor.com/....." value="{{ CNF_TRIPADVISOR }}" /> 
			 </div> 
		  </div>		     
		   <div class="form-group">
		    <label  class=" control-label col-md-4">{{ Lang::get('core.logo') }}</label>
<div class="col-md-6">
    <div class="btn btn-primary btn-file"><i class="fa fa-picture-o fa-lg"></i>  {{ Lang::get('core.fr_backendlogo') }} 
				<input type="file" name="logo">
				
						 </div>
				<p> <i>{{ Lang::get('core.imagedimension') }} 400px * 50px </i> </p>
				<div>
				 	@if(file_exists(public_path().'/mmb/images/'.CNF_LOGO) && CNF_LOGO !='')
                    
				 	<img src="{{ asset('mmb/images/'.CNF_LOGO)}}" alt="{{ CNF_COMNAME }}" />
				 	@else
					<img src="{{ asset('mmb/images/logo.png')}}" alt="{{ CNF_COMNAME }}" />
					@endif	
				</div>				
			 </div> 
		  </div> 
      <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4">{{ Lang::get('core.sitetagline') }}</label>
<div class="col-md-6">
			<input name="cnf_tagline" type="text" id="cnf_tagline" class="form-control input-sm"  value="{{ CNF_TAGLINE }}" /> 
			 </div> 
		  </div>
      <div class="form-group">
			<label for="ipt" class=" control-label col-md-4">{{ Lang::get('core.tempcolor') }} </label>	
<div class="col-md-6">
					<label class="radio">
                    <div class="col-md-4">
					<input type="radio" name="cnf_tempcolor" value="green" @if(CNF_TEMPCOLOR =='green') checked @endif class="minimal-red"  /> 
                        <i class="fa fa-square fa-4x" style="color:#55A79A" aria-hidden="true"></i></div>
                    <div class="col-md-4">
					<input type="radio" name="cnf_tempcolor" value="red" @if(CNF_TEMPCOLOR =='red') checked @endif class="minimal-red"  /> 
					<i class="fa fa-square fa-4x" style="color:#BE3E1D" aria-hidden="true"></i></div>
					<div class="col-md-4">
					<input type="radio" name="cnf_tempcolor" value="blue" @if(CNF_TEMPCOLOR =='blue') checked @endif class="minimal-red"  /> 
					<i class="fa fa-square fa-4x" style="color:#00ADBB" aria-hidden="true"></i></div>
					<div class="col-md-4">
					<input type="radio" name="cnf_tempcolor" value="purple" @if(CNF_TEMPCOLOR =='purple') checked @endif class="minimal-red"  /> 
					<i class="fa fa-square fa-4x" style="color:#b771b0" aria-hidden="true"></i></div>
					<div class="col-md-4">
					<input type="radio" name="cnf_tempcolor" value="pink" @if(CNF_TEMPCOLOR =='pink') checked @endif class="minimal-red"  /> 
					<i class="fa fa-square fa-4x" style="color:#CC164D" aria-hidden="true"></i></div>
					<div class="col-md-4">
					<input type="radio" name="cnf_tempcolor" value="orange" @if(CNF_TEMPCOLOR =='orange') checked @endif class="minimal-red"  /> 
					<i class="fa fa-square fa-4x" style="color:#e67e22" aria-hidden="true"></i></div>
					<div class="col-md-4">
					<input type="radio" name="cnf_tempcolor" value="lime" @if(CNF_TEMPCOLOR =='lime') checked @endif class="minimal-red"  /> 
					<i class="fa fa-square fa-4x" style="color:#b1dc44" aria-hidden="true"></i></div>
					<div class="col-md-4">
					<input type="radio" name="cnf_tempcolor" value="blue-dark" @if(CNF_TEMPCOLOR =='blue-dark') checked @endif class="minimal-red"  /> 
					<i class="fa fa-square fa-4x" style="color:#34495e" aria-hidden="true"></i></div>
					<div class="col-md-4">
					<input type="radio" name="cnf_tempcolor" value="red-dark" @if(CNF_TEMPCOLOR =='red-dark') checked @endif class="minimal-red"  /> 
					<i class="fa fa-square fa-4x" style="color:#a10f2b" aria-hidden="true"></i></div>
					<div class="col-md-4">
					<input type="radio" name="cnf_tempcolor" value="brown" @if(CNF_TEMPCOLOR =='brown') checked @endif class="minimal-red"  /> 
					<i class="fa fa-square fa-4x" style="color:#91633c" aria-hidden="true"></i></div>
					<div class="col-md-4">
					<input type="radio" name="cnf_tempcolor" value="cyan-dark" @if(CNF_TEMPCOLOR =='cyan-dark') checked @endif class="minimal-red"  /> 
					<i class="fa fa-square fa-4x" style="color:#008b8b" aria-hidden="true"></i></div>
					<div class="col-md-4">
					<input type="radio" name="cnf_tempcolor" value="yellow" @if(CNF_TEMPCOLOR =='yellow') checked @endif class="minimal-red"  /> 
					<i class="fa fa-square fa-4x" style="color:#D4AC0D" aria-hidden="true"></i></div>
					<div class="col-md-4">
					<input type="radio" name="cnf_tempcolor" value="slate" @if(CNF_TEMPCOLOR =='slate') checked @endif class="minimal-red"  /> 
					<i class="fa fa-square fa-4x" style="color:#5D6D7E" aria-hidden="true"></i></div>
					<div class="col-md-4">
					<input type="radio" name="cnf_tempcolor" value="olive" @if(CNF_TEMPCOLOR =='olive') checked @endif class="minimal-red"  /> 
					<i class="fa fa-square fa-4x" style="color:olive" aria-hidden="true"></i></div>
					<div class="col-md-4">
					<input type="radio" name="cnf_tempcolor" value="teal" @if(CNF_TEMPCOLOR =='teal') checked @endif class="minimal-red"  /> 
					<i class="fa fa-square fa-4x" style="color:teal" aria-hidden="true"></i></div>
					<div class="col-md-4">
					<input type="radio" name="cnf_tempcolor" value="green-bright" @if(CNF_TEMPCOLOR =='green-bright') checked @endif class="minimal-red"  /> 
					<i class="fa fa-square fa-4x" style="color:#2ECC71" aria-hidden="true"></i></div>
					

          </div>	
		  </div>
      		   <div class="form-group">
		    <label  class=" control-label col-md-4">{{ Lang::get('core.headerimage') }}</label>
<div class="col-md-6">
    <div class="btn btn-primary btn-file"><i class="fa fa-picture-o fa-lg"></i>  {{ Lang::get('core.headerimage') }} 
				<input type="file" name="headerimage">
				
						 </div>
				<p> <i>{{ Lang::get('core.imagedimension') }} 1200px * 450px </i> </p>
				<div>
				 	@if(file_exists(public_path().'/uploads/images/'.CNF_HEADERIMAGE) && CNF_HEADERIMAGE !='')
                    
				 	<img src="{{ asset('uploads/images/'.CNF_HEADERIMAGE)}}" alt="{{ CNF_HEADERIMAGE }}" width="200"/>
				 	@else
					<img src="{{ asset('uploads/images/header.jpg')}}" alt="{{ CNF_HEADERIMAGE }}" width="200" />
					@endif	
				</div>				
			 </div> 
		  </div> 

      <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4">&nbsp;</label>
<div class="col-md-6">
				<button class="btn btn-primary" type="submit">{{ Lang::get('core.sb_savechanges') }} </button>
			 </div> 
		  </div>

		</div>  
		 {!! Form::close() !!}
	</div>
	</div>	 
</div>



                  			<div style="clear: both;"></div>





@stop