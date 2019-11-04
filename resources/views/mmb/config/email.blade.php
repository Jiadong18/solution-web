@extends('layouts.app')
@section('content')
    <section class="content-header">
      <h1>{{ Lang::get('core.emailtemplate') }}</h1>
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
<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">{{ Lang::get('core.registernew') }}</a></li>
              <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">{{ Lang::get('core.forgotpassword') }}</a></li>
              <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="true">{{ Lang::get('core.formemail') }}</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
	 {!! Form::open(array('url'=>'core/config/email/', 'class'=>'form-vertical row')) !!}

                <div class="form-group">
					<textarea rows="50" name="regEmail" class="form-control editor input-md  markItUp">{{ $regEmail }}</textarea>		
				  </div>  
				<div class="form-group">   
					<button class="btn btn-primary" type="submit"> {{ Lang::get('core.sb_savechanges') }}</button>	 
				</div>
              </div>
              <div class="tab-pane" id="tab_2">
                  <div class="form-group">
					<textarea rows="50" name="resetEmail" class="form-control editor input-sm markItUp">{{ $resetEmail }}</textarea>					 
				  </div> 

			  <div class="form-group">
					<button class="btn btn-primary" type="submit">{{ Lang::get('core.sb_savechanges') }}</button>
				 </div>
              </div>
              <div class="tab-pane" id="tab_3">
                  <div class="form-group">
					<textarea rows="50" name="formEmail" class="form-control editor input-sm markItUp">{{ $formEmail }}</textarea>
				  </div> 
			  <div class="form-group">
					<button class="btn btn-primary" type="submit">{{ Lang::get('core.sb_savechanges') }}</button>
				 </div>
              </div>
            </div>
          </div>
	
 	</div>
 </div>
 {!! Form::close() !!}
                  			<div style="clear: both;"></div>

@stop





