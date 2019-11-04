@extends('layouts.app')

@section('content')
{{--*/ usort($tableGrid, "\App\Library\SiteHelpers::_sort") /*--}}
<section class="content-header">
  <h1>{{ Lang::get('core.faq') }}</h1>
</section>
 <div class="content">
<div class="box box-primary ">
	<div class="box-header with-border">
				  @include( 'mmb/toolbarmain')
	</div>
	<div class="box-body">

	 {!! (isset($search_map) ? $search_map : '') !!}

	 {!! Form::open(array('url'=>'faqs/delete/', 'class'=>'form-horizontal' ,'id' =>'MmbTable' )) !!}
	 <div class="table-responsive" style="min-height:300px;">
    <table class="table table-striped ">
        <thead>
			<tr>
				<th class="number"><span> No </span> </th>
				<th> <input type="checkbox" class="checkall" /></th>
				<th width="70">{{ Lang::get('core.btn_action') }}</th>
				<th>{{ Lang::get('core.name') }}</th>
				<th>{{ Lang::get('core.description') }}</th>
				<th>{{ Lang::get('core.shortcode') }}</th>
				<th width="30">{{ Lang::get('core.status') }}</th>
			  </tr>
        </thead>

        <tbody>
            @foreach ($rowData as $row)
                <tr>
					<td> {{ ++$i }} </td>
					<td><input type="checkbox" class="ids" name="ids[]" value="{{ $row->faqID }}" />  </td>
					<td>
					 	@if($access['is_detail'] ==1)
						<a href="{{ URL::to('faqs/show/'.$row->faqID.'?return='.$return)}}" class="tips" title="{{ Lang::get('core.btn_view') }}"><i class="fa fa-search fa-2x"></i></a>
						@endif
						@if($access['is_edit'] ==1)
						<a  href="{{ URL::to('faqs/update/'.$row->faqID.'?return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit fa-2x"></i></a>
						@endif
					</td>
                    <td>{{ $row->name}}</td>
                    <td>{{ $row->content}}</td>
                    <td><small>
				 	<?php echo htmlentities('<php>');?> use \App\Http\Controllers\FaqsController;<br />
					<?php echo ' echo FaqsController::display('.$row->faqID.');'. htmlentities('</php>') ; ?></small></td>
                    <td>{!! \App\Library\GeneralStatuss::Status($row->status) !!}</td>
                </tr>

            @endforeach

        </tbody>

    </table>
	<input type="hidden" name="md" value="" />
	</div>
	{!! Form::close() !!}
	@include('footer')
	</div>
</div>

</div>
<script>
$(document).ready(function(){

	$('.do-quick-search').click(function(){
		$('#MmbTable').attr('action','{{ URL::to("faqs/multisearch")}}');
		$('#MmbTable').submit();
	});

});
</script>
@stop
