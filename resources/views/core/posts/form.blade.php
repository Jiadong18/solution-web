@extends('layouts.app')
@section('content')
    <section class="content-header">
      <h1>{{ Lang::get('core.blog') }}</h1>
    </section>
<div class="content">
<div class="box box-primary ">
	<div class="box-header with-border">
		<div class="box-header-tools pull-left" >
			<a href="{{ url($pageModule.'?return='.$return) }}" class="tips"  title="{{ Lang::get('core.btn_back') }}" ><i class="fa  fa-arrow-left fa-2x"></i></a>
		</div>
	</div>
	<div class="box-body">
		<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
		 {!! Form::open(array('url'=>'core/posts/save?return='.$return, 'class'=>'form-vertical','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
			<div class="col-md-9">

							{!! Form::hidden('pageID', $row['pageID']) !!}
							{!! Form::hidden('pagetype', 'post') !!}
							{!! Form::hidden('pageID', $row['pageID']) !!}
									  <div class="form-group  " >
										<label > {{ Lang::get('core.title') }} </label>
										  {!! Form::text('title', $row['title'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
									  </div>
									  <div class="form-group  " >
										<label for="ipt" class=" btn-success  btn btn-sm">  {!! url('post/view/')!!}  </label>			{!! Form::text('alias', $row['alias'],array('class'=>'form-control input-sm', 'placeholder'=>'', 'style'=>'width:150px; display:inline-block;'   )) !!}
									  </div>
									  <div class="form-group  " >
										  <textarea name='note' rows='25' id='note' class='form-control editor'
				           >{{ $row['note'] }}</textarea>
									  </div>
									  <div class="form-group  " >
										<label > {{ Lang::get('core.metakey') }}</label>
										 <textarea name='metakey' rows='5' id='metakey' class='form-control '
				           >{{ $row['metakey'] }}</textarea>
									  </div>
									  <div class="form-group  " >
										<label > {{ Lang::get('core.metadescription') }}</label>
										  <textarea name='metadesc' rows='5' id='metadesc' class='form-control '
				           >{{ $row['metadesc'] }}</textarea>
									  </div>
								<div class="form-group  " >
									<label > {{ Lang::get('core.headerimage') }}</label>
									<input type="file" name="image"></input>
                                @if(file_exists('./uploads/images/'.$row['image']) && $row['image'] !='')
                <span class="pull-left removeMultiFiles "  url="/uploads/images/{{$row['image']}}">
							<i class="fa fa-trash-o fa-2x text-red "
                               data-toggle="confirmation"
                               data-title="{{Lang::get('core.rusure')}}"
                               data-content="{{ Lang::get('core.youwanttodeletethis') }}" >
                            </i></span>

                {!! \App\Library\SiteHelpers::showUploadedFile($row['image'],'/uploads/images/') !!}
                @endif

								  </div>
			</div>
			<div class="col-md-3" id="sidebar">
                        <div class="theiaStickySidebar">
							  <div class="form-group  " >
								<label> {{ Lang::get('core.status') }}:  </label>
								<div class="">
								  <input  type='radio' name='status'  value="enable" required class="minimal-red"
								  @if( $row['status'] =='enable')  	checked	  @endif
								   />
								  <label>{{ Lang::get('core.fr_enable') }}</label>
								</div>
								<div class="">
								  <input  type='radio' name='status'  value="disable" required class="minimal-red"
								   @if( $row['status'] =='disable')  	checked	  @endif
								   />
								  <label>{{ Lang::get('core.disabled') }}</label>
								</div>
							  </div>
									  <div class="form-group  " >
										<label for="ipt" class=" control-label ">{{ Lang::get('core.created') }}</label>
										<div class="input-group m-b" style="width:150px !important;">
											{!! Form::text('created', $row['created'],array('class'=>'form-control input-sm date', 'style'=>'width:150px !important;')) !!}
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										</div>
									  </div>
									  <div class="form-group  " >
									  <label for="ipt">{{ Lang::get('core.whocanview') }}</label>
										@foreach($groups as $group)
										<div class="">
										  <input  type='checkbox' name='group_id[{{ $group['id'] }}]'    value="{{ $group['id'] }}"
										  @if($group['access'] ==1 or $group['id'] ==1)
										  	checked
										  @endif
										  class="minimal-red"
										   />
										  <label>{{ $group['name'] }}</label>
										</div>
										@endforeach
									  </div>
									   <div class="form-group  " >
										<label> {{ Lang::get('core.showpagetoguest') }}</label>
										<div class=""><input  type='checkbox' name='allow_guest'  class="minimal-red"
					 						@if($row['allow_guest'] ==1 ) checked  @endif
										   value="1"	/> <label> {{ Lang::get('core.yes') }} </lable>
										   </div>
									  </div>
				<div class="form-group  " >
					<label > {{ Lang::get('core.labels') }}</label>
					  <textarea name='labels' rows='2' id='labels' class='form-control '>{{ $row['labels'] }}</textarea>
				</div>
				  <div class="form-group">
					<button type="submit" name="apply" class="btn btn-info btn-sm btn-flat" >{{ Lang::get('core.sb_apply') }}</button>
					<button type="submit" name="submit" class="btn btn-primary btn-sm btn-flat" >{{ Lang::get('core.sb_save') }}</button>
					<button type="button" onclick="location.href='{{ URL::to('core/posts?return='.$return) }}' " class="btn btn-danger btn-sm btn-flat">  {{ Lang::get('core.sb_cancel') }} </button>
				</div>
			</div>
			</div>
		 {!! Form::close() !!}
	</div>
</div>
</div>
<div style="clear:both;"></div>

   <script type="text/javascript">

       jQuery('#sidebar').theiaStickySidebar({
			additionalMarginTop: 60
		});
	</script>
<script>
		$('.removeMultiFiles').on('click',function(){
			var removeUrl = '{{ url("core/posts/removefiles?file=")}}'+$(this).attr('url');
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

@stop
