@extends('layouts.app')

@section('content')
{{--*/ usort($tableGrid, "\App\Library\SiteHelpers::_sort") /*--}}
    <section class="content-header">
  <h1> {{ Lang::get('core.touristicsites') }}</h1>
    </section>

  <div class="content">

<div class="box box-primary">
	<div class="box-header with-border">
		  @include( 'mmb/toolbarmain')
	</div>
	<div class="box-body">

	 {!! Form::open(array('url'=>'sites/delete/', 'class'=>'form-horizontal' ,'id' =>'MmbTable' )) !!}
	 <div class="table-responsive" style="min-height:300px; padding-bottom:60px; border: none !important">
    <table class="table table-striped table-bordered " id="{{ $pageModule }}Table">
        <thead>
			<tr>
				<th class="number"> No </th>
				<th> <input type="checkbox" class="checkall" /></th>
				<th width="50">{{ Lang::get('core.btn_action') }}</th>
				<th>{{ Lang::get('core.sitename') }}</th>
				<th>{{ Lang::get('core.country') }}</th>
				<th>{{ Lang::get('core.city') }}</th>
				<th width="30">{{ Lang::get('core.featured') }}</th>
				<th width="30">{{ Lang::get('core.status') }}</th>
			  </tr>
        </thead>

        <tbody>
            @foreach ($rowData as $row)
                <tr>
					<td width="30"> {{ ++$i }} </td>
					<td width="50"><input type="checkbox" class="ids minimal-red" name="ids[]" value="{{ $row->siteID }}" />  </td>
					<td>
						 	@if($access['is_detail'] ==1)
							<a href="{{ url('sites/show/'.$row->siteID.'?return='.$return)}}" class="tips" title="{{ Lang::get('core.btn_view') }}"><i class="fa  fa-search fa-2x"></i> </a>
							@endif
							@if($access['is_edit'] ==1)
							<a  href="{{ url('sites/update/'.$row->siteID.'?return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit fa-2x"></i> </a>
							@endif
					</td>
                    <td>{{ $row->site_name}}</td>
                    <td>{{ \App\Library\SiteHelpers::formatLookUp($row->countryID,'countryID','1:def_country:countryID:country_name') }}</td>
                    <td>{{ \App\Library\SiteHelpers::formatLookUp($row->cityID,'cityID','1:def_city:cityID:city_name') }}</td>
                    <td>{!! $row->featured == 1 ? '<i class="fa fa-fw fa-2x fa-star text-red tips" title="'.Lang::get('core.featured').'"></i>' : '<i class="fa fa-fw fa-2x fa-star-o text-mute tips"></i>'  !!}</td>
                    <td>{!! \App\Library\GeneralStatuss::Status($row->status) !!}</td>
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
		$('#MmbTable').attr('action','{{ url("sites/multisearch")}}');
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
				$('#MmbTable').attr('action','{{ url("sites/copy")}}');
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
