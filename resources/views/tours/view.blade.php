@extends('layouts.app')
@section('content')
<?php
use \App\Http\Controllers\ToursController;
?>

    <section class="content-header">
      <h1 class="text-blue"> {{ $row->tour_name}}<small> {{ $row->total_days}} {{ Lang::get('core.days') }}, {{ $row->total_nights}} {{ Lang::get('core.nights') }} </small></h1>
    </section>

  <div class="content">
<div class="box box-primary">
	<div class="box-header with-border">
		<div class="box-header-tools pull-left" >
	   		<a href="{{ url('tours?return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_back') }}"><i class="fa  fa-arrow-left fa-2x"></i></a>
			@if($access['is_add'] ==1)
	   		<a href="{{ url('tours/update/'.$id.'?return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_edit') }}"><i class="fa  fa-edit fa-2x"></i></a>
			<a href="{{ url('tourdetail/update/?tourID='.$id)}}@if($row->multicountry == 0)&country={{$row->countryID}}@endif" onclick="MmbModal(this.href,'{{ Lang::get('core.newday') }}'); return false;" class="tips" title="{{ Lang::get('core.newday') }}"><i class="fa fa-plus-square fa-2x text-green"></i></a>
			<a href="{{ url('tourdates?search=tourID:=:'.$id)}}" class="tips" title="{{ Lang::get('core.departuredates') }}" ><i class="fa fa-calendar fa-2x text-blue"></i></a>
            <a href="{{ url('tours/show/'.$id.'?pdf=true')}}" target="_blank" class="tips" title="{{ Lang::get('core.createpdf') }}"><i class="fa fa-file-pdf-o fa-2x text-red"></i></a>
			@endif

		</div>

		<div class="box-header-tools " >
			<a href="{{ ($prevnext['prev'] != '' ? url('tours/show/'.$prevnext['prev'].'?return='.$return ) : '#') }}" class="tips" title="{{ Lang::get('core.previoustour') }}"><i class="fa fa-arrow-left fa-2x"></i></a>
			<a href="{{ ($prevnext['next'] != '' ? url('tours/show/'.$prevnext['next'].'?return='.$return ) : '#') }}" class="tips" title="{{ Lang::get('core.nexttour') }}"><i class="fa fa-arrow-right fa-2x"></i></a>
		</div>


	</div>
	<div class="box-body" >
    <div class="col-md-3">

        <br>

        <div class="hpanel">
                    <div class="panel-body">
                        <div class="stats-title pull-left">
                            <h4>{{ Lang::get('core.status') }}</h4>
                        </div>
                        <div class="stats-icon pull-right">
                            <i class="fa fa-check-circle-o fa-4x"></i>
                        </div>
                        <div class="m-t-xl">
                            <h2 class="text-green">{!! \App\Library\SiteHelpers::Status2($row->status) !!}</h2>
                        </div>
                    </div>
                </div>
                <div class="hpanel">
                    <div class="panel-body">
                        <div class="stats-title pull-left">
                            <h4>{{ Lang::get('core.departs') }}</h4>
                        </div>
                        <div class="stats-icon pull-right">
                            <i class="fa fa-bus fa-4x"></i>
                        </div>
                        <div class="m-t-xl">
                            <h2 class="text-green">{!! \App\Library\SiteHelpers::Departs2($row->departs) !!}</h2>
                        </div>
                    </div>
                </div>
                <div class="hpanel">
                    <div class="panel-body">
                        <div class="stats-title pull-left">
                            <h4>{{ Lang::get('core.paymentoptions') }}</h4>
                        </div>
                        <div class="stats-icon pull-right">
                            <i class="fa fa-credit-card fa-4x"></i>
                        </div>
                        <div class="m-t-xl">
                            <p class="text-green">{!! \App\Library\SiteHelpers::showPaymentOptions2($row->payment_options) !!}</p>
                        </div>
                    </div>
                </div>



        </div>

	<div class="col-md-9">
    <p align="justify">   {!! $row->tour_description !!}</p>

                <ul class="timeline">

			@foreach($dayTree as $dt)
    <li>
        <i class="fa {{ $dt['icon']}} fa-2x"></i>
        <div class="timeline-item">

            <h3 class="timeline-header">{{ Lang::get('core.day') }} {{ $dt['day'] }} - {{ $dt['title'] }}
                @if($access['is_remove'] =='1')
					<a href="{{ url('tours/tourdetaildelete/'.$row->tourID.'/'.$dt['tourdetailID'])}}"  class="text-red pull-right " data-toggle="confirmation" data-title="{{Lang::get('core.rusure')}}" data-content="{{ Lang::get('core.youwanttodeletethis') }}"><i class="fa fa-trash-o fa-lg"></i></a>
					@endif
					@if($access['is_edit'] =='1')
					 <a href="{{ url('tourdetail/update/'.$dt['tourdetailID'].'/?tourID='.$id.'&country='.$row->countryID)}}"  onclick="MmbModal(this.href,'{{ Lang::get('core.editday') }}'); return false;"  class="text-blue pull-right tips" title="{{ Lang::get('core.editday') }}"><i class="fa fa-edit fa-lg"></i></a>
					@endif
            </h3>
            <div class="timeline-body">
            <table style="width: 100%;">
<tbody>
<tr>
<td>                @if(file_exists('./uploads/images/'.$dt['image']) && $dt['image'] !='')
            <img style="float: left; margin: 0px 15px 15px 0px;" src="{{ asset('uploads')}}/images/{{$dt['image']}}" >
                        @endif
</td>
<td>                 {!! $dt['description'] !!}
</td>
    </tr></tbody></table>
            </div>
            <div class="timeline-footer">
            @if($dt['siteID']!=NULL)
                <strong>{{ Lang::get('core.placestovisit') }}:</strong>
            {!! ToursController::placesToVisit($dt['siteID']) !!}
            @endif
            <br>
            <strong>{{ Lang::get('core.overnight') }}:</strong> {{ \App\Library\SiteHelpers::formatLookUp($dt['hotelID'],'hotelID','1:hotels:hotelID:hotel_name') }}, {{ \App\Library\SiteHelpers::formatLookUp($dt['cityID'],'cityID','1:def_city:cityID:city_name') }}<br>
            <strong>{{ Lang::get('core.meals') }}:</strong> {{ $dt['meal']}} <br>
            @if($dt['optionaltourID']!=NULL)<strong>{{ Lang::get('core.optionaltours') }}: </strong>@endif {!! ToursController::optionalTours($dt['optionaltourID']) !!}
            </div>
        </div>
    </li>
			@endforeach
                    </ul>
		</div>
        <div class="clr clear"></div>

	</div>
</div>
</div>

<script type="text/javascript">
$(function() {
	$('.editItem').click(function(){
		$('.displayItem').hide();
		$('.displayEdit').show();
	});
	$('.closeItem').click(function(){
		$('.displayItem').show();
		$('.displayEdit').hide();
	});

    $('[data-toggle=confirmation]').confirmation({
    rootSelector: '[data-toggle=confirmation]',
    container: 'body'
  });

})
</script>

@stop
