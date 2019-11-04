@extends('layouts.app')

@section('content')

<section class="content-header">
      <h1>{{ Lang::get('core.cmsmanagement') }} </h1>
    </section>
<div class="content">
			<div class="sbox-content">
			@if(Session::has('message'))
				   {{ Session::get('message') }}
			@endif
			<ul class="parsley-error-list">
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		 {!! Form::open(array('url'=>'core/pages/save/'.$row['pageID'], 'class'=>'form-vertical row ','files' => true , 'data-parsley-validate'=>'','novalidate'=>' ')) !!}
			<div class="col-sm-9 ">
				  <div class="form-group  " >
					  {!! Form::text('title', $row['title'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) !!}
				  </div>
				  <div class="form-group  " >
					<label for="ipt" class=" btn-primary  btn btn-sm">  {!! url('')!!}/  </label>
						{!! Form::text('alias', $row['alias'],array('class'=>'form-control', 'placeholder'=>'', 'style'=>'width:150px; display:inline-block;'   )) !!} @if ($row['alias']!=NULL) <a href="{{ URL::to($row['alias'])}}" class="tips btn btn-sm btn-primary" target="_blank" title="{{ Lang::get('core.btn_view') }}"><i class="fa  fa-eye fa-lg"></i></a>@endif
				  </div>
							  <div class="form-group  " >
								<div class="" style="background:#fff;">
								  <textarea name='note' rows='20' id='note'    class='form-control editor'
									 >{{ $row['note'] }}</textarea>
								 </div>
							  </div>
			<div class="col-sm-3 ">{{ Lang::get('core.description') }} <div id="charNum"></div></div>
			<div class="col-sm-9 "><textarea name='metadesc' onkeyup="countChar(this)" rows='3' id='metadesc' class='form-control markItUp'>{{ $row['metadesc'] }}</textarea></div>
			<div class="col-sm-3 ">{{ Lang::get('core.keywords') }}</div>
			<div class="col-sm-9 "><textarea name='metakey' rows='3' id='metakey' class='form-control markItUp'>{{ $row['metakey'] }}</textarea></div>
                				<div class="form-group  " >
									<label > {{ Lang::get('core.headerimage') }}</label><br><br>
                    			  <div class="btn btn-primary btn-file"><i class="fa fa-camera fa-2x"></i>  {{ Lang::get('core.headerimage') }}
									<input type="file" name="image"></input>
                                </div>
                <div>
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



						  </div>

		 	<div class="col-sm-3 ">
				  <div class="form-group hidethis " style="display:none;">
					<label for="ipt" class=""> PageID </label>

					  {!! Form::text('pageID', $row['pageID'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}

				  </div>

            <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{ Lang::get('core.m_setting') }}</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body" style="display: block;">
              <div class="form-group  " >
				  <label for="ipt"> {{ Lang::get('core.whocanview') }}</label>
					@foreach($groups as $group)
					<label class="checkbox">
					  <input  type='checkbox' name='group_id[{{ $group['id'] }}]'    value="{{ $group['id'] }}"
					  @if($group['access'] ==1 or $group['id'] ==1)
					  	checked
					  @endif
					   />
					  {{ $group['name'] }}
					</label>
					@endforeach

				  </div>
                <div class="form-group  " >
					<label> {{ Lang::get('core.showpagetoguest') }}</label>
					<label class="checkbox"><input  type='checkbox' name='allow_guest'
 						@if($row['allow_guest'] ==1 ) checked  @endif
					   value="1"	/> </lable>
				  </div>
				  <div class="form-group  " >
					<label> {{ Lang::get('core.status') }} </label>
					<label class="radio">
					  <input  type='radio' name='status'  value="enable" required
					  @if( $row['status'] =='enable')  	checked	  @endif
					   />
					  {{ Lang::get('core.fr_enable') }}
					</label>
					<label class="radio">
					  <input  type='radio' name='status'  value="disabled" required
					   @if( $row['status'] =='disabled')  	checked	  @endif
					   />
					  {{ Lang::get('core.disabled') }}
					</label>
				  </div>
				  <div class="form-group  " >
					<label> {{ Lang::get('core.template') }} </label>
					<label class="radio">
					  <input  type='radio' name='template'  value="frontend" required
					  @if( $row['template'] =='frontend')  	checked	  @endif
					   />
					  {{ Lang::get('core.frontend') }}
					</label>
					<label class="radio">
					  <input  type='radio' name='template'  value="backend" required
					   @if( $row['template'] =='backend')  	checked	  @endif
					   />
					  {{ Lang::get('core.backend') }}
					</label>
				  </div>
				  <div class="form-group  " >
					<label>{{ Lang::get('core.setashomepage') }}</label>
					<label class="checkbox"><input  type='checkbox' name='default'
 						@if($row['default'] ==1 ) checked  @endif
					   value="1"	/>
					</lable>
				  </div>
				  <div class="form-group  " >
					<label for="ipt" > {{ Lang::get('core.pagetemplate') }} </label>
					<select class="form-control" name="filename">
						<option value="page"> {{ Lang::get('core.selecttemplate') }}</option>
						@foreach($pagetemplate['template'] as $key=> $val)
							<option value="{{ $val }}" @if($row['filename'] == $val) selected @endif>{{ $key}}</option>
						@endforeach
					</select>
				  </div>
            </div>
          </div>

				  <div class="form-group text-center">
				<button type="submit" class="btn btn-info " name="apply">  {{ Lang::get('core.sb_apply') }} </button>
				<button type="submit" class="btn btn-primary ">  {{ Lang::get('core.sb_save') }} </button>
				<a href="{{ url('core/pages')}}" class="btn btn-danger"> {{ Lang::get('core.sb_cancel') }} </a>
			  </div>

			</div>
			 {!! Form::close() !!}
			<div style="clear: both;"></div>
			</div>
	</div>

<script>
		$('.removeMultiFiles').on('click',function(){
			var removeUrl = '{{ url("core/pages/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();
			return false;
		});

    $('[data-toggle=confirmation]').confirmation({
    rootSelector: '[data-toggle=confirmation]',
    container: 'body'
    });


      function countChar(val) {
        var len = val.value.length;
        if (len >= 160) {
          val.value = val.value.substring(0, 160);
        } else {
          $('#charNum').text(160 - len);
        }
      };
    </script>
@stop
