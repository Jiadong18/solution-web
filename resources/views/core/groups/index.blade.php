@extends('layouts.app')

@section('content')
{{--*/ usort($tableGrid, "\App\Library\SiteHelpers::_sort") /*--}}
    <section class="content-header">
      <h1>
        {{ Lang::get('core.m_groups') }}
      </h1>
    </section>
	<ul class="parsley-error-list">
	</ul>
 <div class="content">
	@include('mmb.config.tab')
<div class="col-md-9">
<div class="box box-primary ">
	<div class="box-header with-border">
		  @include( 'mmb/toolbarmain')
	</div>
	<div class="box-body">
	 {!! Form::open(array('url'=>'core/groups/delete/', 'class'=>'form-horizontal' ,'id' =>'MmbTable' )) !!}
	 <div class="table-responsive" style="min-height:300px;">
    <table class="table table-striped ">
        <thead>
			<tr>
				<th class="number"> No </th>
				<th> <input type="checkbox" class="checkall" /></th>
				<th width="70" >{{ Lang::get('core.btn_action') }}</th>
				<th>{{Lang::get('core.groupid')}}</th>
				<th>{{Lang::get('core.groupname')}}</th>
				<th>{{Lang::get('core.description')}}</th>
				<th>{{Lang::get('core.level')}}</th>
			  </tr>
        </thead>

        <tbody>

            @foreach ($rowData as $row)
                <tr>
					<td width="30"> {{ ++$i }} </td>
					<td width="50"><input type="checkbox" class="ids" name="id[]" value="{{ $row->group_id }}" />  </td>
					<td>

							@if($access['is_edit'] ==1)
							<a  href="{{ URL::to('core/groups/update/'.$row->group_id.'?return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit fa-2x"></i></a>
							@endif

					</td>
				 @foreach ($tableGrid as $field)
					 @if($field['view'] =='1')
					 <td>
					 	@if($field['attribute']['image']['active'] =='1')
							{{ \App\Library\SiteHelpers::showUploadedFile($row->$field['field'],$field['attribute']['image']['path']) }}
						@else
							{{--*/ $conn = (isset($field['conn']) ? $field['conn'] : array() ) /*--}}
							{!! \App\Library\SiteHelpers::gridDisplay($row->{$field['field']},$field['field'],$conn) !!}
						@endif
					 </td>
					 @endif
				 @endforeach

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
			<div style="clear:both"></div>

<script>
$(document).ready(function(){

	$('.do-quick-search').click(function(){
		$('#MmbTable').attr('action','{{ URL::to("cpre/groups/multisearch")}}');
		$('#MmbTable').submit();
	});

});
</script>
@stop
