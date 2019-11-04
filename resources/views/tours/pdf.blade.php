<?php
use \App\Http\Controllers\ToursController;
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>{{ CNF_COMNAME }}</title>
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
<style type="text/css">
body,td,th {
	font-family: Gotham, "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-style: normal;
	font-size: 13px;
	color: #393939;
}
.title { font-family: 'Montserrat', sans-serif; color:#0087C3; font-size: 16px;}
    thead:before, thead:after,
    tbody:before, tbody:after,
    tfoot:before, tfoot:after
    {
        display: none;
    }

      </style>
  </head>
  <body>

<table>
<tbody>
<tr>
<td rowspan="4">@if(file_exists(public_path().'/mmb/images/'.CNF_LOGO) && CNF_LOGO !='')
        <img src="{{ asset('mmb/images/'.CNF_LOGO)}}" />
        @else
        <img src="{{ asset('mmb/images/logo.png')}}" />
        @endif </td>
<td align="right" class="title" style="font-size: 25px;">{{ CNF_COMNAME }}</td>
</tr>
<tr>
<td align="right">{{ CNF_ADDRESS }}</td>
</tr>
<tr>
<td align="right">{{ CNF_TEL }}</td>
</tr>
<tr>
<td align="right">{{ CNF_EMAIL }}</td>
</tr>
<tr>
<td colspan="2" align="center" class="title" style=" font-size: 25px; color:#800000;">{!! $row->tour_name !!}</td>
</tr>
<tr>
<td colspan="2" align="center" style="font-size: 15px; color:#800000;">{!! $row->total_days !!} {{ Lang::get('core.days') }} , {!! $row->total_nights !!} {{ Lang::get('core.nights') }}</td>
</tr>
<tr>
<td></td>
</tr>
<tr>
<td colspan="2" align="justify">{!! $row->tour_description !!}</td>
</tr>
@foreach($dayTree as $dt)
<tr>
<td class="title" style="color:#fff; background:#999; " colspan="2">{{ Lang::get('core.day') }} {{ $dt['day'] }} - {{ $dt['title'] }}</td>
</tr>
<tr>
<td colspan="2" align="justify">{{ $dt['description'] }}</td>
</tr>
@if($dt['siteID']!=NULL)
<tr>
<td colspan="2" align="left"><strong>{{ Lang::get('core.placestovisit') }}:</strong>{!! ToursController::placesToVisit($dt['siteID']) !!}</td>
</tr>
@endif
@if($dt['hotelID']!=NULL)
<tr>
<td colspan="2" ><strong>{{ Lang::get('core.overnight') }}:</strong>{{ \App\Library\SiteHelpers::formatLookUp($dt['hotelID'],'hotelID','1:hotels:hotelID:hotel_name') }}, {{ \App\Library\SiteHelpers::formatLookUp($dt['cityID'],'cityID','1:def_city:cityID:city_name') }}</td>
</tr>
@endif
@if($dt['meal']!=NULL)
<tr>
<td colspan="2" ><strong>{{ Lang::get('core.meals') }}:</strong>{{ $dt['meal']}}</td>
</tr>
@endif
@if($dt['optionaltourID']!=NULL)
<tr>
<td colspan="2" ><strong>{{ Lang::get('core.optionaltours') }}: </strong>{!! ToursController::optionalTours($dt['optionaltourID']) !!}</td>
</tr>
@endif
@endforeach
<tr>
<td colspan="2"> <hr></td>
</tr>

@if($row->inclusions!=NULL)
<tr>
<td colspan="2"><strong>{{ Lang::get('core.whatisincluded') }}</strong></td>
</tr>
<tr>
<td colspan="2"> <ul>{!! ToursController::whatsIncluded($row->inclusions) !!}</ul></td>
</tr>
@endif
<tr>
<td colspan="2"><strong>{{ Lang::get('core.tandc') }}</strong></td>
</tr>
<tr>
<td colspan="2">{!! \App\Library\SiteHelpers::formatLookUp($row->policyandterms,'tandcID','1:termsandconditions:tandcID:tandc') !!}
    </td>
</tr>

</tbody>
</table>
