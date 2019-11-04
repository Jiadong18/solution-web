@extends('layouts.login')

@section('content')
<div class="login-box">

  <div class="login-logo">
   <h3 >{{ CNF_COMNAME }}</h3>
  </div>

  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

		{!! Form::open(array('url' => 'user/doreset/'.$verCode, 'class'=>'form-vertical sky-form boxed')) !!}

			    	@if(Session::has('message'))
						{!! Session::get('message') !!}
					@endif

		<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>	


			<div class="form-group has-feedback animated fadeInLeft delayp1">
				{!! Form::password('password',  array('class'=>'form-control', 'placeholder'=>'New Password')) !!}				
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>

			<div class="form-group has-feedback animated fadeInLeft delayp1">
				{!! Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>'Confirm Password')) !!}
				<span class="glyphicon glyphicon-log-in form-control-feedback"></span>
			</div>

			<div class="form-group has-feedback animated fadeInLeft delayp1">
				<label>	</label>
				<button type="submit" class="btn btn-primary btn-flat pull-right"><i class="fa fa-check"></i> Submit </button>
			</div>			

<p class="text-center ">
			  <a href="{{url('')}}" class="btn btn-white"> {{ Lang::get('core.backtosite') }} </a>  
		   		</p>				
			
			 {!! Form::close() !!}

  </div>
</div>



@stop