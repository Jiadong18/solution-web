@extends('layouts.app')

@section('content')

<section class="content-header">
  <h1>{{ Lang::get('core.users') }} </h1>
</section>
 <div class="content">
	@include('mmb.config.tab')
<div class="col-md-9">
<div class="box box-primary ">
	<div class="box-body">
		<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
		 {!! Form::open(array('url'=>'core/users/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
		<div class="col-md-12">
            <div class="form-group">
			<label for="ipt" class=" control-label col-md-4 text-left text-uppercase text-red" >					{{ Lang::get('core.userdetails') }}
 </label>
			<div class="col-md-6">
			</div>
		</div>
								  <div class="form-group hidethis " style="display:none;">
									<label for="Id" class=" control-label col-md-4 text-left"> Id </label>
									<div class="col-md-6">
									  {!! Form::text('id', $row['id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
									 </div>
								  </div>
								  <div class="form-group  " >
									<label for="Group / Level" class=" control-label col-md-4 text-left"> {{ Lang::get('core.grouplevel') }}<span class="asterix"> * </span></label>
									<div class="col-md-6">
									  <select name='group_id' rows='5' id='group_id' code='{$group_id}'
							class='select2 '  required  ></select>
									 </div>
								  </div>
								  <div class="form-group  " >
									<label for="Username" class=" control-label col-md-4 text-left"> {{ Lang::get('core.username') }} <span class="asterix"> * </span></label>
									<div class="col-md-6">
				                    @if($row['id'] !='')
                                    {!! Form::hidden('username', $row['username']) !!}
                                    <label class="control-label col-md-4 text-left"> {{ $row['username'] }}</label>
                                    @else
                        {!! Form::text('username', $row['username'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) !!}
                                    @endif
									 </div>
								  </div>
								  <div class="form-group  " >
									<label for="First Name" class=" control-label col-md-4 text-left"> {{ Lang::get('core.firstname') }} <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  {!! Form::text('first_name', $row['first_name'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) !!}
									 </div>
								  </div>
								  <div class="form-group  " >
									<label for="Last Name" class=" control-label col-md-4 text-left"> {{ Lang::get('core.lastname') }} </label>
									<div class="col-md-6">
									  {!! Form::text('last_name', $row['last_name'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
									 </div>
								  </div>
								  <div class="form-group  " >
									<label for="Email" class=" control-label col-md-4 text-left"> {{ Lang::get('core.email') }} <span class="asterix"> * </span></label>
									<div class="col-md-6">
                                    @if($row['id'] !='')
                                    {!! Form::hidden('email', $row['email']) !!}
                                    <label class="control-label col-md-4 text-left"> {{ $row['email'] }}</label>
                                    @else
									  {!! Form::text('email', $row['email'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true', 'parsley-type'=>'email'   )) !!}
                                    @endif

									 </div>
								  </div>
								</div>
			<div class="col-md-12">

		<div class="form-group">
				@if($row['id'] !='')
								<label for="ipt" class=" control-label col-md-10 text-left text-uppercase text-red" >					{{ Lang::get('core.notepassword') }}
 </label>

				@else
			<label for="ipt" class=" control-label col-md-4 text-left text-uppercase text-red" >{{ Lang::get('core.createpassword') }}
 </label>
				@endif
		</div>


		<div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> {{ Lang::get('core.newpassword') }} </label>
			<div class="col-md-6">
			<input name="password" type="password" id="password" class="form-control input-sm" value=""
			@if($row['id'] =='')
				required
			@endif
			 />
			 </div>
		</div>

		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> {{ Lang::get('core.conewpassword') }} </label>
			<div class="col-md-6">
			<input name="password_confirmation" type="password" id="password_confirmation" class="form-control input-sm" value=""
			@if($row['id'] =='')
				required
			@endif
			 />
			 </div>
		  </div>
        <div class="form-group  " >
									<label for="Status" class=" control-label col-md-4 text-left"> {{ Lang::get('core.status') }} <span class="asterix"> * </span></label>
									<div class="col-md-6">
										<input type='radio' name='active' value ='1' required @if($row['active'] == '1') checked="checked" @endif class="minimal-red" > {{ Lang::get('core.fr_mactive') }}

										<input type='radio' name='active' value ='0' required @if($row['active'] == '0') checked="checked" @endif class="minimal-red" > {{ Lang::get('core.fr_minactive') }}

										<input type='radio' name='active' value ='2' required @if($row['active'] == '2') checked="checked" @endif class="minimal-red" > {{ Lang::get('core.fr_pending') }}
									 </div>
								  </div>
                <div class="form-group  " >
									<label for="Avatar" class=" control-label col-md-4 text-left"> {{ Lang::get('core.profilepicture') }} </label>
									<div class="col-md-6">
									  <div class="btn btn-primary btn-file"><i class="fa fa-camera fa-2x"></i> {{ Lang::get('core.selectfile') }}
                                          <input  type='file' name='avatar' id='avatar' @if($row['avatar'] =='') class='required' @endif style='width:150px !important;'  />
                                          						 </div>

										 	<div >
                            @if(file_exists('./uploads/users/'.$row['avatar']) && $row['avatar'] !='')
                        <span class="pull-left removeMultiFiles "  url="/uploads/users/{{$row['avatar']}}">
							<i class="fa fa-trash-o fa-2x text-red "
                               data-toggle="confirmation"
                               data-title="{{Lang::get('core.rusure')}}"
                               data-content="{{ Lang::get('core.youwanttodeletethis') }}" >
                            </i></span>
                        {!! \App\Library\SiteHelpers::showUploadedFile($row['avatar'],'/uploads/users/') !!}
                        @endif
									</div>

									 </div>
								  </div>



		 </div>


			<div style="clear:both"></div>


				  <div class="form-group">
					<label class="col-sm-4 text-right">&nbsp;</label>
					<div class="col-sm-8">
					<button type="submit" name="apply" class="btn btn-info btn-sm" > {{ Lang::get('core.sb_apply') }}</button>
					<button type="submit" name="submit" class="btn btn-primary btn-sm" ><i class="fa  fa-save "></i> {{ Lang::get('core.sb_save') }}</button>
					<button type="button" onclick="location.href='{{ URL::to('core/users?return='.$return) }}' " class="btn btn-danger btn-sm ">  {{ Lang::get('core.sb_cancel') }} </button>
					</div>

				  </div>

		 {!! Form::close() !!}
	</div>
</div>

</div>
</div>
                  			<div style="clear: both;"></div>

   <script type="text/javascript">
	$(document).ready(function() {
		$('[data-toggle=confirmation]').confirmation({
    rootSelector: '[data-toggle=confirmation]',
    container: 'body'
    });
    		$('.removeMultiFiles').on('click',function(){
			var removeUrl = '{{ url("hotels/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();
			return false;
		});


		$("#group_id").jCombo("{{ URL::to('core/users/comboselect?filter=tb_groups:group_id:name') }}",
		{  selected_value : '{{ $row["group_id"] }}' });

	});
	</script>
@stop
