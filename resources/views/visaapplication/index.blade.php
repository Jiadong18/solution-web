@extends('layouts.app')
@section('content')
<?php
use \App\Http\Controllers\VisaapplicationController;
?>

{{--*/ usort($tableGrid, "\App\Library\SiteHelpers::_sort") /*--}}
    <section class="content-header">
      <h1> {{ Lang::get('core.visaapplication') }}</h1>
    </section>

  <div class="content">

<div class="box box-primary">
	<div class="box-header with-border">
		  @include( 'mmb/toolbarmain')
	</div>
	<div class="box-body">

	 {!! Form::open(array('url'=>'visaapplication/delete/', 'class'=>'form-horizontal' ,'id' =>'MmbTable' )) !!}
	 <div class="table-responsive" style="min-height:300px; padding-bottom:60px; border: none !important">
    <table class="table table-striped table-bordered " id="{{ $pageModule }}Table">
        <thead>
			<tr>
				<th class="number"> No </th>
				<th> <input type="checkbox" class="checkall" /></th>
				<th style="width: 50px;">{{ Lang::get('core.btn_action') }}</th>
				<th >{{ Lang::get('core.namesurname') }}</th>
				<th >{{ Lang::get('core.country') }}</th>
				<th >{{ Lang::get('core.duration') }}</th>
				<th >{{ Lang::get('core.applicationdate') }}</th>
				<th >{{ Lang::get('core.processtime') }}</th>
				<th width="30">{{ Lang::get('core.status') }}</th>

			  </tr>
        </thead>

        <tbody>
            @foreach ($rowData as $row)
                <tr>
					<td width="30"> {{ ++$i }} </td>
					<td width="50"><input type="checkbox" class="ids minimal-red" name="ids[]" value="{{ $row->applicationID }}" />  </td>
					<td>

						 	@if($access['is_detail'] ==1)
							<a href="{{ url('visaapplication/show/'.$row->applicationID.'?return='.$return)}}" class="tips" title="{{ Lang::get('core.btn_view') }}"><i class="fa  fa-search fa-2x"></i> </a>
							@endif
							@if($access['is_edit'] ==1)
							<a  href="{{ url('visaapplication/update/'.$row->applicationID.'?return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit fa-2x"></i> </a>
							@endif

					</td>
                    <td>{!! VisaapplicationController::visaApplicants($row->travellersID) !!}</td>
                    <td>{{ \App\Library\SiteHelpers::formatLookUp($row->countryID,'countryID','1:def_country:countryID:country_name') }}</td>
                    <td>{{ $row->duration }} @if ($row->duration2 =='1') {{ Lang::get('core.days') }} @elseif ($row->duration2 =='2'){{ Lang::get('core.weeks') }} @elseif ($row->duration2 =='3'){{ Lang::get('core.months') }} @elseif ($row->duration2 =='4'){{ Lang::get('core.years') }} @endif</td>
                    <td>{{ \App\Library\SiteHelpers::TarihFormat($row->applicationdate)}}</td>
                    <td>{{ $row->processintime }} {{ Lang::get('core.days') }}</td>
                    <td>{!! \App\Library\GeneralStatuss::Visa($row->status) !!}</td>

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
		$('#MmbTable').attr('action','{{ url("visaapplication/multisearch")}}');
		$('#MmbTable').submit();
	});

	$('input[type="checkbox"],input[type="radio"]').iCheck({
		checkboxClass: 'icheckbox_square-red',
		radioClass: 'iradio_square-red',
	});

	$('#{{ $pageModule }}Table .checkall').on('ifChecked',function(){
		$('#{{ $pageModule }}Table input[type="checkbox"]').iCheck('check');
	});

	$('.copy').click(function() {
		var total = $('input[class="ids"]:checkbox:checked').length;
		if(confirm('are u sure Copy selected rows ?'))
		{
				$('#MmbTable').attr('action','{{ url("visaapplication/copy")}}');
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
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });
  });
</script>

@stop
