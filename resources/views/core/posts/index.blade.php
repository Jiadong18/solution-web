@extends('layouts.app')
@section('content')
{{--*/ usort($tableGrid, "\App\Library\SiteHelpers::_sort") /*--}}

    <section class="content-header">
      <h1>{{ Lang::get('core.blog') }}
      </h1>
    </section>
 <div class="content">

	<div class="tab-content" style="margin-top: 0;">
		  <div class="tab-pane active" id="info">
			<div class="box box-success ">
				<div class="box-header with-border">
<div class="box box-solid collapsed-box">
		<div class="box-header-tools pull-left" >
			@if($access['is_add'] ==1)
	   		<a href="{{ url($pageModule .'/update?return='.$return) }}" class="tips text-green"  title="{{ Lang::get('core.btn_create') }} ">
			<i class="fa fa-plus-square-o fa-2x"></i></a>
			@endif
			@if($access['is_clone'] ==1)
            <a href="javascript://ajax" class="tips copy text-blue" title="{{ Lang::get('core.btn_copy') }} " ><i class="fa fa-copy fa-2x" data-toggle="confirmation" data-title="{{Lang::get('core.rusure')}}"  data-content="{{ Lang::get('core.rusureyouwanttocopythis') }}" ></i></a>
			@endif
			@if($access['is_remove'] ==1)
			<a href="javascript://ajax"  onclick="MmbDelete();" class="tips text-red" title="{{ Lang::get('core.btn_remove') }}">
			<i class="fa fa-trash-o fa-2x" data-toggle="confirmation" data-title="{{Lang::get('core.rusure')}}"  data-content="{{ Lang::get('core.rusuredelete') }}" ></i></a>
			@endif
            @if($access['is_excel'] ==1)
		    <a class="dropdown-toggle tips" data-toggle="dropdown" href="#" title="{{ Lang::get('core.btn_download') }}"><i class="fa fa-cloud-download fa-2x"></i></a>
			<ul class="dropdown-menu  pull-right ">
				<li><a href="{{ url( $pageModule .'/export/excel?return='.$return) }}" class="tips "  title="Excel"><i class="fa fa-file-excel-o fa-2x"></i> Excel </a></li>
				<li><a href="{{ url( $pageModule .'/export/word?return='.$return) }}" class="tips "  title="Word"><i class="fa fa-file-word-o fa-2x"></i> Word </a></li>
				<li><a href="{{ url( $pageModule .'/export/csv?return='.$return) }}" class="tips " title="CSV"><i class="fa fa-file-code-o fa-2x"></i> CSV </a></li>
				<li><a href="{{ url( $pageModule .'/export/print?return='.$return) }}" class="tips " onclick="ajaxPopupStatic(this.href); return false;" ><i class="fa fa-print fa-2x"></i> {{ Lang::get('core.btn_print') }} </a></li>
				<li><a href="{{ url( $pageModule .'/export/pdf?return='.$return) }}" class="tips " title="PDF"><i class="fa  fa-file fa-2x"></i> PDF </a></li>
				<li class="divider"></li>
				<li><a href="{{url( $pageModule .'/expotion?return='.$return) }}" class="tips " onclick="MmbModal(this.href,'Download Option'); return false" ><i class="fa  fa-cog fa-2x"></i> {{ Lang::get('core.moreoption') }} </a></li>
			</ul>
		@endif
		</div>

		<div class="box-header-tools pull-right" >
		  <a href="#"> <i class="fa fa-cog fa-2x tips" title="{{ Lang::get('core.dash_i_setting') }}" data-widget="collapse"></i></a>
		</div>
        <div class="box-body col-xs-12" style="display: none;">
            <div class="col-xs-2"></div>
<div class="col-xs-8">
				{!! Form::open(array('url'=>'core/posts/config', 'class'=>'form-horizontal' ,'id' =>'' )) !!}
				 <div class="form-group" >
		    <label for="ipt" class=" control-label col-md-5">{{ Lang::get('core.allowcomments') }} </label>
						<div class="col-md-7">
					  		<input type="checkbox" name="commsys" class="checkbox minimal-red" value="1"
					  		@if($conpost['commsys'] ==1) checked @endif
					  		 />
					  	</div>
				  </div>
				 <div class="form-group  " >
                     <label for="ipt" class=" control-label col-md-5">{{ Lang::get('core.displayimage') }} </label>
						<div class="col-md-7">
					  		<input type="checkbox" name="commimage" class="checkbox minimal-red" value="1"
					  		@if($conpost['commimage'] ==1) checked @endif
					  		 />
					  	</div>
				  </div>
				 <div class="form-group  " >
                    <label for="ipt" class=" control-label col-md-5">{{ Lang::get('core.displaylatestpost') }} </label>
						<div class="col-md-7">
					  		<input type="checkbox" name="commlatest" class="checkbox minimal-red" value="1"
					  		@if($conpost['commlatest'] ==1) checked @endif
					  		 />
					  	</div>
				  </div>

				 <div class="form-group  " >
                        <label for="ipt" class=" control-label col-md-5">{{ Lang::get('core.displaypopularposts') }} </label>
						<div class="col-md-7">
					  		<input type="checkbox" name="commpopular" class="checkbox minimal-red" value="1"
					  		@if($conpost['commpopular'] ==1) checked @endif
					  		/>
					  	</div>
				  </div>

				 <div class="form-group  " >
                        <label for="ipt" class=" control-label col-md-5">{{ Lang::get('core.allowsharepost') }} </label>
						<div class="col-md-7">
					  		<input type="checkbox" name="commshare" class="checkbox minimal-red" value="1"
					  		@if($conpost['commshare'] ==1) checked @endif
					  		/>
					  	</div>
				  </div>
				 <div class="form-group  " >
                        <label for="ipt" class=" control-label col-md-5">{{ Lang::get('core.sharepostapi') }} </label>
						<div class="col-md-7">
					  		<input type="text" name="commshareapi" class="form-control" value="{{ $conpost['commshareapi'] }}"  />
					  		<a href="http://www.sharethis.com/get-sharing-tools/" target="_blank"> http://www.sharethis.com/get-sharing-tools/ </a>
					  	</div>
				  </div>

				 <div class="form-group  " >
                    		    <label for="ipt" class=" control-label col-md-5">{{ Lang::get('core.displaypostperpage') }} </label>
						<div class="col-md-7">
					  		<input type="text" name="commperpage" class="form-control" style="width: 50px;" value="{{ $conpost['commperpage'] }}" />
					  	</div>
				  </div>
				 <div class="form-group  " >
						<label class="col-md-5" >   </label>
						<div class="col-md-7">
					  		<button type="submit" class="btn btn-primary"> Save Configuration </button>
					  	</div>
				  </div>
    				  {!! Form::close() !!}

</div>            <div class="col-xs-2"></div>

        </div>

</div>
                </div>

				<div class="box-body ">


				 {!! (isset($search_map) ? $search_map : '') !!}

				 {!! Form::open(array('url'=>'core/posts/delete?return='.$return, 'class'=>'form-horizontal' ,'id' =>'MmbTable' )) !!}
				 <div class="table-responsive" style="min-height:300px;  padding-bottom:60px;">
			    <table class="table table-hover ">
			        <thead>
						<tr>
							<th class="number"><span> No </span> </th>
							<th> <input type="checkbox" class="checkall" /></th>
							<th>{{ Lang::get('core.btn_action') }}</th>
							<th>{{ Lang::get('core.title') }}</th>
							<th>{{ Lang::get('core.date') }}</th>
							<th width="50">{{ Lang::get('core.status') }}</th>
							<th>{{ Lang::get('core.labels') }}</th>
							<th>{{ Lang::get('core.author') }}</th>
							<th>{{ Lang::get('core.comment') }}</th>
							<th>{{ Lang::get('core.views') }}</th>
				            <th>{{ Lang::get('core.headerimage') }}</th>

						  </tr>
			        </thead>

			        <tbody>
			            @foreach ($rowData as $row)
			                <tr>
								<td width="30"> {{ ++$i }} </td>
								<td width="50"><input type="checkbox" class="ids" name="ids[]" value="{{ $row->pageID }}" />  </td>
								<td>
									 	@if($access['is_detail'] ==1)
				<a href="{{ url('blog/view/'. $row->pageID.'/'.$row->alias)}}" class="tips" title="{{ Lang::get('core.btn_view') }}" target="_blank"><i class="fa  fa-eye fa-2x"></i></a>
										@endif
										@if($access['is_edit'] ==1)
				<a  href="{{ URL::to('core/posts/update/'.$row->pageID.'?return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit fa-2x "></i></a>
										@endif

								</td>
                                <td>{{ $row->title }}</td>
                                <td>{{ \App\Library\SiteHelpers::TarihFormat($row->created) }}</td>
                                <td>{!! $row->status == 'enable' ? '<i class="text-success fa fa-check-circle fa-2x"></i>' : '<i class="text-danger fa fa-times-circle fa-2x"></i>'  !!}</td>
                                <td>{{ $row->labels }}</td>
                                <td>{{ \App\Library\SiteHelpers::formatLookUp($row->userid,'userid','1:tb_users:id:username') }}</td>
                                <td><button type="button" class="btn btn-block btn-info btn-xs">{{ $row->comments }}</button></td>
                                <td><button type="button" class="btn btn-block btn-primary btn-xs">{{ $row->views }}</button></td>
                                <td> {!! \App\Library\SiteHelpers::showUploadedFile($row->image,'/uploads/images/') !!} </td>

			                </tr>

			            @endforeach

			        </tbody>

			    </table>
				<input type="hidden" name="md" value="" />
				</div>
				{!! Form::close() !!}
				</div>
			</div>


		  </div>
	</div>
</div>


@stop
