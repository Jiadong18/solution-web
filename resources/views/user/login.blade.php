@extends('layouts.login')

@section('content')

<div class="login-box">

  <div class="login-logo">
ManageMyBookings
  </div>

  <div class="login-box-body">
    <p class="login-box-msg">{{ Lang::get('core.login_text') }}</p>

		<div class="ajaxLoading"></div>
		<p class="message alert alert-danger " style="display:none;"></p>

	    	@if(Session::has('message'))
				{!! Session::get('message') !!}
			@endif
		<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
		<div id="login-area">

	   <form method="post" action="{{ url('user/signin')}}" class="form-vertical" id="LoginAjax">
           @csrf
	      <div class="form-group has-feedback">
	       <input type="text" name="email" placeholder="{{ Lang::get('core.emailorusername') }}" class="form-control" required="email" />
<span class="fa fa-envelope fa-lg text-red form-control-feedback"></span>
	      </div>
	      <div class="form-group has-feedback">
	       <input type="password" name="password" placeholder="{{ Lang::get('core.password') }}" class="form-control" required="true" />
	        <span class="fa fa-unlock fa-lg text-red form-control-feedback"></span>
	      </div>

			@if(CNF_RECAPTCHA =='true')
			<div class="form-group has-feedback ">
				<label class="text-left"> {{Lang::get('core.areyouhuman')}} ? </label>
				<br />
				{!! captcha_img() !!} <br /><br />
				<input type="text" name="captcha" placeholder="Type Security Code" class="form-control" required/>

				<div class="clr"></div>
			</div>
		 	@endif

			@if(CNF_MULTILANG =='1')
			<div class="form-group has-feedback">

				<select class="form-control" name="language">
					<option value="">-- {{ Lang::get('core.m_sel_lang') }} --</option>
					@foreach(\App\Library\SiteHelpers::langOption() as $lang)
					<option value="{{ $lang['folder'] }}" @if(Session::get('lang') ==$lang['folder']) selected @endif>  {{  $lang['name'] }}</option>
					@endforeach

				</select>

				<div class="clr"></div>
			</div>
		 	@endif


	      <div class="row">
	        <div class="col-xs-4 pull-right">
	          <button type="submit" class="btn btn-success btn-block btn-flat"><i class="fa fa-sign-in fa-lg" aria-hidden="true"></i>
 {{ Lang::get('core.signin') }}</button>
	        </div>
	        <!-- /.col -->
	      </div>
	    </form>


    <a href="javascript:void(0)" class="forgot-button" >{{ Lang::get('core.forgotpassword') }}</a><br>
    @if(CNF_REGIST =='true')
    	<a href="{{ url('user/register')}}" class="text-center">{{ Lang::get('core.registernew') }}</a>
    @endif


	   @if(isset($socialize['google']['client_id']) || isset($socialize['twitter']['client_id']) || isset($socialize['facebook'] ['client_id']))

		   <div class="social-auth-links text-center">
		      <p>- {{ Lang::get('core.loginsocial') }} -</p>

				@if($socialize['facebook']['client_id'] !='')
				<a href="{{ URL::to('user/socialize/facebook')}}" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook </a>
				@endif
				@if($socialize['google']['client_id'] !='')
				<a href="{{ URL::to('user/socialize/google')}}" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using  Google+ </a>
				@endif
				@if($socialize['twitter']['client_id'] !='')
				<a href="{{ URL::to('user/socialize/twitter')}}" class="btn btn-block btn-social btn-twitter btn-flat"><i class="fa fa-twitter"></i> Twitter </a>
				@endif
		    </div>
		@endif
    </div>
	    <div id="forgot-area">
			<form method="post" action="{{ url('user/request')}}" class="form-vertical " id="fr">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			      <div class="form-group has-feedback">
			       <input type="text" name="credit_email"  placeholder="{{ Lang::get('core.enteremailforgot') }}" class="form-control" required="email" />
			        <span class="fa fa-envelope fa-lg text-red form-control-feedback"></span>
			      </div>

				<div class="form-group has-feedback">
			      <button type="button" class="btn btn-danger  btn-flat forgot-button"> {{ Lang::get('core.sb_cancel') }} </button>
			      <button type="submit" class="btn btn-success btn-flat pull-right"> {{ Lang::get('core.sb_submit') }} </button>
			  </div>

			  <div class="clr"></div>


			</form>

	    </div>

	      </div>
</div>




<script type="text/javascript">
	$(document).ready(function(){
		$('#forgot-area').hide();
		$('.forgot-button').click(function(){
			$('#login-area').toggle();
			$('#forgot-area').toggle();
		});

		var form = $('#LoginAjax');
		form.parsley();
		form.submit(function(){

			if(form.parsley('isValid') == true){
				var options = {
					dataType:      'json',
					beforeSubmit :  showRequest,
					success:       showResponse
				}
				$(this).ajaxSubmit(options);
				return false;

			} else {
				return false;
			}

		});

	});

function showRequest()
{
	$('.ajaxLoading').show();
}
function showResponse(data)  {

	if(data.status == 'success')
	{
		window.location.href = data.url;
		$('.ajaxLoading').hide();
	} else {
		$('.message').html(data.message)
		$('.ajaxLoading').hide();
		$('.message').show(data.message)
		return false;
	}
}
</script>
@stop
