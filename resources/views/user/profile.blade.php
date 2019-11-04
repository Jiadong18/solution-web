@extends('layouts.app')

@section('content')

  <script type="text/javascript" src="{{ asset('mmb/js/simpleclone.js') }}"></script>
    <section class="content-header">
      <h1>{{Lang::get('core.myprofile')}}</h1>
    </section>

  <div class="content">

	@if(Session::has('message'))
		   {!! Session::get('message') !!}
	@endif
	<ul>
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>

      <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box box-solid">
                            <div class="box-header with-border">
              <h3 class="box-title">Profile</h3>
            </div>
{!! Form::open(array('url'=>'user/saveprofile/', 'class'=>'form-horizontal ' ,'files' => true)) !!}
		  <div class="form-group">
            				{!! Form::hidden('username', $info->username) !!}
			<label for="ipt" class=" control-label col-md-4"> {{ Lang::get('core.username') }} </label>
			<div class="col-md-5">
            <label for="ipt" class=" control-label"> {{ $info->username }} </label>

			 </div>
		  </div>
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4">{{ Lang::get('core.email') }} </label>
			<div class="col-md-5">
			<input name="email" type="text" id="email"  class="form-control input-sm" value="{{ $info->email }}" />
			 </div>
		  </div>

		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4">{{ Lang::get('core.firstname') }} </label>
			<div class="col-md-5">
			<input name="first_name" type="text" id="first_name" class="form-control input-sm" required value="{{ $info->first_name }}" />
			 </div>
		  </div>

		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4">{{ Lang::get('core.lastname') }} </label>
			<div class="col-md-5">
			<input name="last_name" type="text" id="last_name" class="form-control input-sm" required value="{{ $info->last_name }}" />
			 </div>
		  </div>

		  <div class="form-group  " >
			<label for="ipt" class=" control-label col-md-4 text-right"></label>
			<div class="col-md-5">

			  <div class="btn btn-primary btn-file"><i class="fa fa-camera fa-2x"></i>  {{ Lang::get('core.profilepicture') }}
					<input type="file" name="avatar">
				</div>
			 {{Lang::get('core.imagedimension80x80')}} <br />

                @if(file_exists('./uploads/users/'.$info->avatar) && $info->avatar !='')
                <span class="pull-left removeMultiFiles "  url="/uploads/users/{{$info->avatar}}">
							<i class="fa fa-trash-o fa-2x text-red "
                               data-toggle="confirmation"
                               data-title="{{Lang::get('core.rusure')}}"
                               data-content="{{ Lang::get('core.youwanttodeletethis') }}" >
                            </i></span>

                {!! \App\Library\SiteHelpers::showUploadedFile($info->avatar,'/uploads/users/') !!}
                @endif

			 </div>
		  </div>

		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4">&nbsp;</label>
			<div class="col-md-8">
				<button class="btn btn-success" type="submit"> {{ Lang::get('core.sb_savechanges') }}</button>
			 </div>
		  </div>

		{!! Form::close() !!}

                        </div>
                    </div>
      </div>
      <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box box-solid">
<div class="box-header with-border">
              <h3 class="box-title">{{Lang::get('core.password')}}</h3>
            </div>
     {!! Form::open(array('url'=>'user/savepassword/', 'class'=>'form-horizontal ')) !!}

		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> {{ Lang::get('core.newpassword') }} </label>
			<div class="col-md-5">
			<input name="password" type="password" id="password" class="form-control input-sm" value="" />
			 </div>
		  </div>

		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> {{ Lang::get('core.conewpassword') }}  </label>
			<div class="col-md-5">
			<input name="password_confirmation" type="password" id="password_confirmation" class="form-control input-sm" value="" />
			 </div>
		  </div>
            <div class="col-md-3">
			 </div>

        <div class="callout callout-warning col-md-6">
            <p> <b>{{Lang::get('core.password6-12')}}</b> </p>
            </div>
                                        <div class="col-md-3">
			 </div>

		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4">&nbsp;</label>
			<div class="col-md-5">
				<button class="btn btn-danger" type="submit"> {{ Lang::get('core.sb_savechanges') }} </button>
			 </div>
		  </div>
		{!! Form::close() !!}
                        </div>
                    </div>
      </div>

</div>
 			<div style="clear:both"></div>

<script>
		$('.removeMultiFiles').on('click',function(){
			var removeUrl = '{{ url("travelagents/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();
			return false;
		});

    $('[data-toggle=confirmation]').confirmation({
    rootSelector: '[data-toggle=confirmation]',
    container: 'body'
    });


</script>
@endsection
