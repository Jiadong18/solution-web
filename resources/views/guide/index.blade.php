@extends('layouts.app')

@section('content')
{{--*/ usort($tableGrid, "\App\Library\SiteHelpers::_sort") /*--}}
    <section class="content-header">
      <h1> {{ Lang::get('core.guides') }}</h1>
    </section>

  <div class="content">

<div class="box box-primary">
	<div class="box-header with-border">
        @include( 'mmb/toolbarmain')
	</div>
	<div class="box-body">

	 {!! Form::open(array('url'=>'guide/delete/', 'class'=>'form-horizontal' ,'id' =>'MmbTable' )) !!}
	 <div class="table-responsive" style="min-height:300px; padding-bottom:60px; border: none !important">
    <table class="table table-striped table-bordered " id="{{ $pageModule }}Table">
        <thead>
			<tr>
				<th class="number"> No </th>
				<th> <input type="checkbox" class="checkall" /></th>
				<th width="50" style="width: 50px;">{{ Lang::get('core.btn_action') }}</th>
				<th>{{Lang::get('core.namesurname')}}</th>
				<th>{{Lang::get('core.email')}}</th>
				<th>{{Lang::get('core.mobilephone')}}</th>
				<th>{{Lang::get('core.spokenlanguages')}}</th>
				<th>{{Lang::get('core.city')}}</th>
				<th>{{Lang::get('core.country')}}</th>
				<th width="30">{{Lang::get('core.status')}}</th>
			  </tr>
        </thead>

        <tbody>
            @foreach ($rowData as $row)
                <tr>
					<td width="30"> {{ ++$i }} </td>
					<td width="50"><input type="checkbox" class="ids minimal-red" name="ids[]" value="{{ $row->guideID }}" />  </td>
					<td>

						 	@if($access['is_detail'] ==1)
							<a href="{{ url('guide/show/'.$row->guideID.'?return='.$return)}}" class="tips" title="{{ Lang::get('core.btn_view') }}"><i class="fa  fa-search fa-2x"></i> </a>
							@endif
							@if($access['is_edit'] ==1)
							<a  href="{{ url('guide/update/'.$row->guideID.'?return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit fa-2x"></i> </a>
							@endif

					</td>
				 @foreach ($tableGrid as $field)
					 @if($field['view'] =='1')
					 	<?php $limited = isset($field['limited']) ? $field['limited'] :''; ?>
					 	@if(\App\Library\SiteHelpers::filterColumn($limited ))
						 <td align="{{ $field['align'] }}" width=" {{ $field['width'] }}">
						 	{!! \App\Library\SiteHelpers::formatRows($row->{$field['field']},$field ,$row ) !!}
						 </td>
						@endif
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
<script>
$(document).ready(function(){

	$('.do-quick-search').click(function(){
		$('#MmbTable').attr('action','{{ url("guide/multisearch")}}');
		$('#MmbTable').submit();
	});

	$('input[type="checkbox"],input[type="radio"]').iCheck({
		checkboxClass: 'icheckbox_square-red',
		radioClass: 'iradio_square-red',
	});

	$('#{{ $pageModule }}Table .checkall').on('ifChecked',function(){
		$('#{{ $pageModule }}Table input[type="checkbox"]').iCheck('check');
	});
	$('#{{ $pageModule }}Table .checkall').on('ifUnchecked',function(){
		$('#{{ $pageModule }}Table input[type="checkbox"]').iCheck('uncheck');
	});

	$('.copy').click(function() {
		var total = $('input[class="ids"]:checkbox:checked').length;
		if(confirm('{{ Lang::get('core.rusureyouwanttocopythis') }}'))
		{
				$('#MmbTable').attr('action','{{ url("guide/copy")}}');
				$('#MmbTable').submit();// do the rest here
		}
	})

});
</script>
<style>
.table th , th { text-align: none !important;  }
.table th.right { text-align:right !important;}
.table th.center { text-align:center !important;}

</style>

<script>
  $(function () {
    $('#{{ $pageModule }}Table').DataTable({

      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": false,
      "lengthMenu": [ [25, 50, -1], [25, 50, "All"] ],
      "autoWidth": false
    });
  });
</script>


@stop
