@extends('layouts.login')

@section('content')

<div class="login-box">

  <div class="login-logo">ManageMyBookings</div>

  <div class="login-box-body">
    <p class="login-box-msg">{{  Lang::get('core.registernew') }}</p>

		<div class="ajaxLoading"></div>

 {!! Form::open(array('url'=>'user/create', 'class'=>'form-signup')) !!}
	    	@if(Session::has('message'))
				{!! Session::get('message') !!}
			@endif
		<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	
	<div class="form-group has-feedback">
	  {!! Form::text('username', null, array('class'=>'form-control', 'placeholder'=> Lang::get('core.username') ,'required'=>'' )) !!}
		<span class="fa fa-user-circle-o fa-lg text-red form-control-feedback"></span>
	</div>

	<div class="row">
			<div class="form-group has-feedback">
			  {!! Form::text('firstname', null, array('class'=>'form-control', 'placeholder'=>Lang::get('core.firstname') ,'required'=>'' )) !!}
			</div>
			<div class="form-group has-feedback">
			 {!! Form::text('lastname', null, array('class'=>'form-control', 'placeholder'=>Lang::get('core.lastname'),'required'=>'')) !!}
			</div>
	</div>	

	<div class="form-group has-feedback">
	 	{!! Form::text('email', null, array('class'=>'form-control', 'placeholder'=>Lang::get('core.email'),'required'=>'email')) !!}
		 <span class="fa fa-envelope fa-lg text-red form-control-feedback"></span>
	</div>		

	<div class="row">
			<div class="form-group has-feedback">
			 {!! Form::password('password', array('class'=>'form-control', 'placeholder'=>Lang::get('core.password'),'required'=>'')) !!}
				 <span class="fa fa-unlock fa-lg text-red form-control-feedback"></span>
			</div>
			
			<div class="form-group has-feedback">
			 {!! Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>Lang::get('core.repassword'),'required'=>'')) !!}
				<span class="fa fa-unlock fa-lg text-red form-control-feedback"></span>
            </div>
	</div>		
	

    @if(CNF_RECAPTCHA =='true') 
    <div class="form-group has-feedback  animated fadeInLeft delayp1">
        <label class="text-left"> Are u human ? </label>    
        <br />
        {!! captcha_img() !!} <br /><br />
        <input type="text" name="captcha" placeholder="Type Security Code" class="form-control" required/>

        <div class="clr"></div>
    </div>
    @endif		
    	 <div class="row">
	        <div class="col-xs-8">
	          <div class="checkbox icheck">
	            <label>
	              
	            </label>
	          </div>
	        </div>
	        <!-- /.col -->
	        <div class="col-xs-4">
	          <button type="submit" class="btn btn-success btn-block btn-flat"> {{ Lang::get('core.signup') }}</button>
	        </div>
	        <!-- /.col -->
	      </div>

	  <p style="padding:10px 0" class="text-center">
	  <a href="{{ URL::to('user/login')}}"> {{ Lang::get('core.signin') }}  </a> | <a href="{{ URL::to('')}}"> {{ Lang::get('core.backtosite') }}  </a> 
   		</p>
 {!! Form::close() !!}

	</div>
</div>


@stop
