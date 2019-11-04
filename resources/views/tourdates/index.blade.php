@extends('layouts.app')
@section('content')
{{--*/ usort($tableGrid, "\App\Library\SiteHelpers::_sort") /*--}}
    <section class="content-header">
      <h1>{{ Lang::get('core.tourdates') }}</h1>
    </section>

  <div class="content">
	<div class="box-header with-border">
		<div class="col-lg-3 col-xs-6">
        <div class="hpanel">
                    <div class="panel-body">
                        <div class="stats-title pull-left">
                            <a href="{{ url('tourdates?search=status:equal:1|start:smaller_equal:'.$today.'|end:bigger:'.$today) }}"><h4>{{ Lang::get('core.runningtours') }}</h4></a>
                        </div>
                        <div class="stats-icon pull-right">
                            <i class="fa fa-bus fa-4x"></i>
                        </div>
                        <div class="m-t-xl">
                            <h1 class="text-green">{{$running_tours}}</h1>
                        </div>
                    </div>
                </div>
        </div>
        <div class="col-lg-3 col-xs-6">
        <div class="hpanel">
                    <div class="panel-body">
                        <div class="stats-title pull-left">
                            <h4><a href="{{ url('tourdates?search=status:equal:1|start:bigger:'.$today) }}">
              {{ Lang::get('core.upcomingtours') }}
            </a>
</h4>
                        </div>
                        <div class="stats-icon pull-right">
                            <i class="fa fa-random fa-4x"></i>
                        </div>
                        <div class="m-t-xl">
                            <h1 class="text-yellow">{{$upcoming_tours}}</h1>
                        </div>
                    </div>
                </div>
                </div><div class="col-lg-3 col-xs-6">
        <div class="hpanel">
                    <div class="panel-body">
                        <div class="stats-title pull-left">
                            <h4><a href="{{ url('tourdates?search=status:equal:1|end:smaller:'.$today) }}">
               {{ Lang::get('core.pasttours') }}
            </a></h4>
                        </div>
                        <div class="stats-icon pull-right">
                            <i class="fa fa-check-square fa-4x"></i>
                        </div>
                        <div class="m-t-xl">
                            <h1 class="text-blue">{{$old_tours}}</h1>
                        </div>
                    </div>
                </div>
                </div>
        <div class="col-lg-3 col-xs-6">
        <div class="hpanel">
                    <div class="panel-body">
                        <div class="stats-title pull-left">
                            <h4>            <a href="{{ url('tourdates?search=status:equal:2') }}">
              {{ Lang::get('core.cancelledtours') }}
            </a>
</h4>
                        </div>
                        <div class="stats-icon pull-right">
                            <i class="fa fa-times fa-4x"></i>
                        </div>
                        <div class="m-t-xl">
                            <h1 class="text-red">{{$cancelled_tours}}</h1>
                        </div>
                    </div>
                </div>
                </div>
	</div>
<div class="box box-primary">
	<div class="box-header with-border">
        		@include( 'mmb/toolbarmain')
	</div>
	<div class="box-body">

	 {!! Form::open(array('url'=>'tourdates/delete/', 'class'=>'form-horizontal' ,'id' =>'MmbTable' )) !!}
	 <div class="table-responsive" style="min-height:300px; padding-bottom:60px; border: none !important">
    <table class="table table-striped table-bordered " id="{{ $pageModule }}Table">
        <thead>
			<tr>
				<th class="number"> No </th>
				<th> <input type="checkbox" class="checkall" /></th>
				<th >{{ Lang::get('core.btn_action') }}</th>
				<th >{{ Lang::get('core.capacity') }}</th>
				<th >{{ Lang::get('core.tourcategory') }}</th>
				<th >{{ Lang::get('core.tourname') }}</th>
				<th >{{ Lang::get('core.tourcode') }}</th>
				<th >{{ Lang::get('core.start') }}</th>
				<th >{{ Lang::get('core.end') }}</th>
				<th >{{ Lang::get('core.guide') }}</th>
			  </tr>
        </thead>

        <tbody>
            @foreach ($rowData as $row)
                <tr>
					<td > {{ ++$i }} </td>
					<td ><input type="checkbox" class="ids minimal-red" name="ids[]" value="{{ $row->tourdateID }}" />  </td>
					<td style="width: 190px;">
                        @if($access['is_detail'] ==1)
							<a href="{{ url('tourdates/show/'.$row->tourdateID.'?return='.$return)}}" class="tips" title="{{ Lang::get('core.btn_view') }}"><i class="fa  fa-search fa-2x"></i> </a>
							@endif
							@if($access['is_edit'] ==1)
							<a   class="tips"
                            @if( $row->start < $today)
                                disabled
                            title="{{ Lang::get('core.youcanteditthistour') }}"
                            @else
                            href="{{ url('tourdates/update/'.$row->tourdateID.'?return='.$return) }}" title="{{ Lang::get('core.btn_edit') }}"
                            @endif
                            ><i class="fa fa-edit fa-2x"></i> </a>
							@endif
                        {!! \App\Library\SiteHelpers::Featured($row->featured) !!}
                        {!! \App\Library\SiteHelpers::definite_departure($row->definite_departure) !!}
                        {!! \App\Library\GeneralStatuss::Tour($row->status,$row->start,$row->end,$row->tourdateID, $row->total_capacity) !!}
                    </td>
            <td>{{ $row->total_capacity}}</td>
            <td>{{ \App\Library\SiteHelpers::formatLookUp($row->tourcategoriesID,'tourcategoriesID','1:def_tour_categories:tourcategoriesID:tourcategoryname') }}</td>
            <td>{{ \App\Library\SiteHelpers::formatLookUp($row->tourID,'tourID','1:tours:tourID:tour_name') }}</td>
            <td>{{ $row->tour_code}}</td>
            <td>{{ \App\Library\SiteHelpers::TarihFormat($row->start)}}</td>
            <td>{{ \App\Library\SiteHelpers::TarihFormat($row->end)}}</td>
                    <td><a href="{{ url('guide/show/'.$row->guideID.'?return='.$return)}}"> {{ \App\Library\SiteHelpers::formatLookUp($row->guideID,'guideID','1:guides:guideID:name')}}</a></td>
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
		$('#MmbTable').attr('action','{{ url("tourdates/multisearch")}}');
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
				$('#MmbTable').attr('action','{{ url("tourdates/copy")}}');
				$('#MmbTable').submit();// do the rest here
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
