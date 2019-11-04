@extends('layouts.app')

@section('content')
{{--*/ usort($tableGrid, "\App\Library\SiteHelpers::_sort") /*--}}
<section class="content-header">
      <h1>{{ Lang::get('core.cmsmanagement') }} </h1>
    </section>

<div class="content">
  <div class="box box-primary">
  <div class="box-header with-border">
		  @include( 'mmb/toolbarmain')
		</div>

	<div class="box-body">
	 {!! Form::open(array('url'=>'core/pages/delete/', 'class'=>'form-horizontal' ,'id' =>'MmbTable' )) !!}
	 <div class="table-responsive" style="min-height:300px;">
    <table class="table  table-hover ">
        <thead>
			<tr>
				<th class="number"> No </th>
				<th> <input type="checkbox" class="checkall" /></th>
				<th width="100" >{{ Lang::get('core.btn_action') }}</th>
				<th>{{ Lang::get('core.title') }}</th>
				<th>{{ Lang::get('core.slug') }}</th>
				<th width="50" >{{ Lang::get('core.status') }}</th>
				<th width="50" >{{ Lang::get('core.template') }}</th>
				<th width="90" >{{ Lang::get('core.views') }}</th>
				<th>{{ Lang::get('core.headerimage') }}</th>
			  </tr>
        </thead>

        <tbody>

            @foreach ($rowData as $row)
                <tr>
					<td width="30"> {{ ++$i }} </td>
					<td width="50"><input type="checkbox" class="ids" name="id[]" value="{{ $row->pageID }}" />  </td>
					<td>
						 	@if($access['is_detail'] ==1)
								@if($row->default == 1)
                                <a href="{{ url()}}" class="tips" title="{{ Lang::get('core.btn_view') }}" target="_blank"><i class="fa  fa-eye fa-2x"></i> </a>
								@else
								<a href="{{ url($row->alias)}}" class="tips" title="{{ Lang::get('core.btn_view') }}" target="_blank"><i class="fa fa-eye fa-2x "></i> </a>
								@endif
							@endif
							@if($access['is_edit'] ==1)
							<a  href="{{ URL::to('core/pages/update/'.$row->pageID.'?return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit fa-2x"></i></a>
							@endif
                        {!! $row->default == 1 ? '<i class="text-success fa fa-check-square fa-2x tips" title="HOMEPAGE"></i>' : '<i class="text-danger fa fa-minus-square fa-2x"></i>'  !!}
					</td>
                    <td> {{ $row->title }}</td>
                    <td> {{ $row->alias }}</td>
                    <td> {{ $row->status }}</td>
                    <td> {{ $row->template }}</td>
                    <td> <button type="button" class="btn btn-block btn-primary btn-xs">{{ $row->views }}</button></td>
                    <td> {!! \App\Library\SiteHelpers::showUploadedFile($row->image,'/uploads/images/') !!} </td>

                </tr>

            @endforeach

        </tbody>

    </table>
	<input type="hidden" name="md" value="" />
	</div>
	</div>
	</div>
	</div>
	{!! Form::close() !!}
		  @include( 'footer')

<script>
$(document).ready(function(){

	$('.do-quick-search').click(function(){
		$('#MmbTable').attr('action','{{ URL::to("core/pages/multisearch")}}');
		$('#MmbmoTable').submit();
	});

});
</script>
@stop
