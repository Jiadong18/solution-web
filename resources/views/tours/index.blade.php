@extends('layouts.app') @section('content') {{--*/ usort($tableGrid, "\App\Library\SiteHelpers::_sort") /*--}}
<section class="content-header">
    <h1>{{ Lang::get('core.tours') }}</h1>
</section>

<div class="content">
    <div class="box box-primary">

        <div class="box-header with-border">
		  @include( 'mmb/toolbarmain')
        </div>
        <div class="box-body">

            {!! Form::open(array('url'=>'tours/delete/', 'class'=>'form-horizontal' ,'id' =>'MmbTable' )) !!}
            <div class="table-responsive" style="min-height:300px; padding-bottom:60px; border: none !important">
                <table class="table table-striped table-filter" id="{{ $pageModule }}Table">
                    <thead>
                        <tr data-status="arama">
                        <th colspan="3"><div class="input-group pull-left">
                    <span class="input-group-addon">{{ Lang::get('core.btn_search') }}</span>
                    <input id="filter" type="text" class="form-control">
                </div></th>
                        <th colspan="5"> <div class="pull-right">
							<div class="btn-group">
							    <button type="button" class="btn btn-default btn-filter" data-target="all">All</button>
								<button type="button" class="btn btn-success btn-filter" data-target="1">{{ Lang::get('core.daily') }}</button>
								<button type="button" class="btn btn-warning btn-filter" data-target="2">{{ Lang::get('core.onrequest') }}</button>
								<button type="button" class="btn btn-info    btn-filter"  data-target="3">{{ Lang::get('core.setdate') }}</button>

							</div>
				</div></th>
                        </tr>
                        <tr data-status="title">
                            <th> <input type="checkbox" class="checkall" /></th>
                            <th>{{ Lang::get('core.btn_action') }}</th>
				<th >{{ Lang::get('core.tourname') }}</th>
				<th >{{ Lang::get('core.tourcategory') }}</th>
				<th >{{ Lang::get('core.tourduration') }}</th>
				<th width="50">{{ Lang::get('core.departs') }}</th>
				<th width="50">{{ Lang::get('core.views') }}</th>
				<th width="50">{{ Lang::get('core.status') }}</th>
                        </tr>
                    </thead>

                    <tbody class="searchable">
                        @foreach ($rowData as $row)
                        <?php $tour_dates=\DB::table('tour_date')->where('tourID', $row->tourID )->where('status','=','1' )->count('tourdateID'); ?>

                        <tr data-status="{{$row->departs}}">
                            <td width="50"><input type="checkbox" class="ids minimal-red" name="ids[]" value="{{ $row->tourID }}" /> </td>
                            <td width="100">
                                @if($access['is_detail'] ==1)
                                <a href="{{ url('tours/show/'.$row->tourID.'?return='.$return)}}" class="tips" title="{{ Lang::get('core.btn_view') }}"><i class="fa fa-search fa-2x"></i> </a>
                                @endif
                                @if($access['is_edit'] ==1)
                                <a href="{{ url('tours/update/'.$row->tourID.'?return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit fa-2x"></i> </a>
                                @endif
                                @if($access['is_detail'] ==1)
                                @if($tour_dates !=0)
                                <a href="{{ url('tourdates?search=tourID:=:'.$row->tourID.'?return='.$return)}}" class="tips" title="{{ $tour_dates }} {{ Lang::get('core.departures') }}"><i class="fa fa-bus fa-2x text-blue"></i> </a>
                                @endif
                                @if($tour_dates ==0)
                                <a href="{{ url('tourdates/update?return=')}}" class="tips text-red" title="{{ Lang::get('core.adddeparturedate') }}"><i class="fa fa-plus-square fa-2x"></i> </a>
                                @endif
                                @endif
                            </td>
                            <td><a href="{{ url('tours/show/'.$row->tourID.'?return='.$return)}}">{{ $row->tour_name }}</a></td>
                            <td>{{ \App\Library\SiteHelpers::formatLookUp($row->tourcategoriesID,'tourcategoriesID','1:def_tour_categories:tourcategoriesID:tourcategoryname') }}</td>
                            <td>{{ $row->total_days }} {{ Lang::get('core.days') }} - {{ $row->total_nights }} {{ Lang::get('core.nights') }}</td>
                            <td width="90">{!! \App\Library\SiteHelpers::departs($row->departs) !!}</td>
                            <td width="80"class="text-center">{{ $row->views }}</td>
                            <td width="70">{!! \App\Library\GeneralStatuss::Status($row->status) !!}</td>
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
    $(document).ready(function() {

        $('.do-quick-search').click(function() {
            $('#MmbTable').attr('action', '{{ url("tours/multisearch")}}');
            $('#MmbTable').submit();
        });

        $('input[type="checkbox"],input[type="radio"]').iCheck({
            checkboxClass: 'icheckbox_square-red',
            radioClass: 'iradio_square-red',
        });

        $('#{{ $pageModule }}Table .checkall').on('ifChecked', function() {
            $('#{{ $pageModule }}Table input[type="checkbox"]').iCheck('check');
        });

        $('#{{ $pageModule }}Table .checkall').on('ifUnchecked', function() {
            $('#{{ $pageModule }}Table input[type="checkbox"]').iCheck('uncheck');
        });

        $('.copy').click(function() {
            var total = $('input[class="ids"]:checkbox:checked').length;
                $('#MmbTable').attr('action', '{{ url("tours/copy")}}');
                $('#MmbTable').submit();
        })

    $('.btn-filter').on('click', function () {
      var $target = $(this).data('target');
      if ($target != 'all') {
        $('.table tr').css('display', 'none');
        $('.table tr[data-status="' + $target + '"]').fadeIn('slow');
        $('.table tr[data-status="title"]').fadeIn('slow');
        $('.table tr[data-status="arama"]').fadeIn('slow');
      } else {
        $('.table tr').css('display', 'none').fadeIn('slow');
      }
    });

 });
$(document).ready(function () {

    (function ($) {

        $('#filter').keyup(function () {

            var rex = new RegExp($(this).val(), 'i');
            $('.searchable tr').hide();
            $('.searchable tr').filter(function () {
                return rex.test($(this).text());
            }).show();

        })

    }(jQuery));

});
</script>

@stop
