@extends('layouts.app')
@section('content')
{{--*/ usort($tableGrid, "\App\Library\SiteHelpers::_sort") /*--}}
<section class="content-header">
      <h1>{{ Lang::get('core.formmanagement') }} </h1>
</section>

<div class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
		  @include( 'mmb/toolbarmain')
	</div>

        <div class="box-body">

	 {!! (isset($search_map) ? $search_map : '') !!}

	 {!! Form::open(array('url'=>'core/forms/delete/0?return='.$return, 'class'=>'form-horizontal' ,'id' =>'MmbTable' )) !!}
	 <div class="table-responsive" style="min-height:300px;  padding-bottom:60px;">
    <table class="table table-striped ">
        <thead>
			<tr>
				<th class="number"><span> No </span> </th>
				<th> <input type="checkbox" class="checkall" /></th>
				<th ><span>{{ Lang::get('core.btn_action') }}</span></th>

				@foreach ($tableGrid as $t)
					@if($t['view'] =='1')
						<?php $limited = isset($t['limited']) ? $t['limited'] :''; ?>
						@if(\App\Library\SiteHelpers::filterColumn($limited ))

							<th><span>{{ $t['label'] }}</span></th>
						@endif
					@endif
				@endforeach
				<th> ShortCode </th>
			  </tr>
        </thead>

        <tbody>
            @foreach ($rowData as $row)
                <tr>
					<td width="30"> {{ ++$i }} </td>
					<td width="50"><input type="checkbox" class="ids" name="ids[]" value="{{ $row->formID }}" />  </td>
					<td>

						 	@if($access['is_detail'] ==1)
							<a href="{{ URL::to('core/forms/show/'.$row->formID.'?return='.$return)}}" class="tips" title="{{ Lang::get('core.btn_view') }}"><i class="fa fa-search fa-2x "></i></a>
							@endif
							@if($access['is_edit'] ==1)
							<a  href="{{ URL::to('core/forms/update/'.$row->formID.'?return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit fa-2x"></i> </a>
							@endif

					</td>

				 @foreach ($tableGrid as $field)
					 @if($field['view'] =='1')
					 	<?php $limited = isset($field['limited']) ? $field['limited'] :''; ?>
					 	@if(\App\Library\SiteHelpers::filterColumn($limited ))
						 <td>
						 	{!! \App\Library\SiteHelpers::formatRows($row->{$field['field']},$field ,$row ) !!}
						 </td>
						@endif
					 @endif

				 @endforeach
				  <td style="font-weight:bold"> !!FormHelpers|render|{{ $row->formID}}!!</td>
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


@stop
