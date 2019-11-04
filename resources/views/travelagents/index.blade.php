@extends('layouts.app')

@section('content')
{{--*/ usort($tableGrid, "\App\Library\SiteHelpers::_sort") /*--}}
    <section class="content-header">
      <h1>{{ Lang::get('core.travelagents') }}</h1>
    </section>

  <div class="content">

<div class="box box-primary">
	<div class="box-header with-border">
        		@include( 'mmb/toolbarmain')
	</div>
	<div class="box-body">

	 {!! Form::open(array('url'=>'travelagents/delete/', 'class'=>'form-horizontal' ,'id' =>'MmbTable' )) !!}
	 <div class="table-responsive" style="min-height:300px; padding-bottom:60px; border: none !important">
    <table class="table table-striped table-bordered " id="{{ $pageModule }}Table">
        <thead>
			<tr>
				<th class="number"> No </th>
				<th> <input type="checkbox" class="checkall" /></th>
				<th width="50" style="width: 50px;">{{ Lang::get('core.btn_action') }}</th>
                <th><?php echo Lang::get('core.agencyname') ;?></th>
				<th><?php echo Lang::get('core.website') ;?></th>
				<th><?php echo Lang::get('core.email') ;?></th>
                <th><?php echo Lang::get('core.country') ;?></th>
                <th><?php echo Lang::get('core.city') ;?></th>
				<th width="30"><?php echo Lang::get('core.status') ;?></th>
			  </tr>
        </thead>

        <tbody>
            @foreach ($rowData as $row)
                <tr>
					<td width="30"> {{ ++$i }} </td>
					<td width="50"><input type="checkbox" class="ids minimal-red" name="ids[]" value="{{ $row->travelagentID }}" />  </td>
					<td>

						 	@if($access['is_detail'] ==1)
							<a href="{{ url('travelagents/show/'.$row->travelagentID.'?return='.$return)}}" class="tips" title="{{ Lang::get('core.btn_view') }}"><i class="fa  fa-search fa-2x"></i> </a>
							@endif
							@if($access['is_edit'] ==1)
							<a  href="{{ url('travelagents/update/'.$row->travelagentID.'?return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit fa-2x"></i> </a>
							@endif

					</td>
                    <td>{{ $row->agency_name }}</td>
                    <td><a href="{{ $row->website }}" target="_blank">{{ $row->website }}</a></td>
                    <td><a href="mailto:{{ $row->email }}">{{ $row->email }}</a></td>
                    <td>{{ \App\Library\SiteHelpers::formatLookUp($row->countryID,'countryID','1:def_country:countryID:country_name') }}</td>
                    <td>{{ \App\Library\SiteHelpers::formatLookUp($row->cityID,'cityID','1:def_city:cityID:city_name') }}</td>
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
		$('#MmbTable').attr('action','{{ url("travelagents/multisearch")}}');
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
				$('#MmbTable').attr('action','{{ url('travelagents/copy')}}');
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
      "lengthMenu": [ [25, 50, -1], [25, 50, "All"] ],
      "autoWidth": true
    });
  });
</script>

@stop
