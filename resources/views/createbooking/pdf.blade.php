<html lang="en">
<head>
<meta charset="UTF-8">
<title>{{Lang::get('core.bookingno')}} {{ $row->bookingno}} - {{ CNF_COMNAME }}</title>
<link href="https://fonts.googleapis.com/css?family=Arial:400,700|Montserrat" rel="stylesheet">
<style type="text/css">
body,td,th {
	font-family: Gotham, "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-style: normal;
	font-size: 11px;
	color: #393939;
}
table.maintable {
    width: 100%;
}
tr {
    text-transform: uppercase;
    }
th, td {
    border-bottom: 1px solid #ddd;
    height: 30px;
    text-align: left;
}
.gray {
  background-color: #efefef;
    }
.darkgray {
  background-color: #999;
  color: #fff;
 text-align: center;
    }
</style>
</head>
  <body>
<h1 style="text-align:center; " >VOUCHER</h1>
<table  class="maintable">
<tbody>
<tr>
<td width="60%" rowspan="4" valign="top">@if(file_exists(public_path().'/mmb/images/'.CNF_LOGO) && CNF_LOGO !='')
        <img src="{{ asset('mmb/images/'.CNF_LOGO)}}" />
        @else
        <img src="{{ asset('mmb/images/logo.png')}}" />
        @endif </td>
<td width="40%" align="right">{{ CNF_COMNAME }}</td>
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
</tbody>
</table>
<p>{{Lang::get('core.vouchertext')}}<br><br>
<b>{{Lang::get('core.yourbookingdetails')}}</b><br>
<b>{{Lang::get('core.bookingno')}}:</b> {{ $row->bookingno}}<br>
<b>{{Lang::get('core.name')}}:</b> {{ \App\Library\SiteHelpers::formatLookUp($row->travellerID,'travellerID','1:travellers:travellerID:nameandsurname') }}<br>
<b>{{Lang::get('core.address')}}:</b><br>
{{ \App\Library\SiteHelpers::formatLookUp($row->travellerID,'travellerID','1:travellers:travellerID:address') }} {{ \App\Library\SiteHelpers::formatLookUp($row->travellerID,'travellerID','1:travellers:travellerID:city') }}
<?php $invocountry=\App\Library\SiteHelpers::formatLookUp($row->travellerID,'travellerID','1:travellers:travellerID:countryID') ?>
{{ \App\Library\SiteHelpers::formatLookUp($invocountry,'countryID','1:def_country:countryID:country_name') }} <br>
<b>{{Lang::get('core.email')}}:</b> {{ \App\Library\SiteHelpers::formatLookUp($row->travellerID,'travellerID','1:travellers:travellerID:email') }}<br>
<b>{{Lang::get('core.tel')}}:</b>{{ \App\Library\SiteHelpers::formatLookUp($row->travellerID,'travellerID','1:travellers:travellerID:phone') }}<br>
</p>
            <table  class="maintable" cellpadding="0" cellspacing="0">
                <thead>
                <tr>
                <th colspan="3" class="darkgray">{{Lang::get('core.passengerlist')}}</th></tr>
                <tr class="gray">
                  <th width="20%" align="left">{{Lang::get('core.roomtype')}}</th>
                  <th width="70%" height="20" align="left" class="gray">{{Lang::get('core.travellers')}}</th>
                  <th width="10%" align="center">{{Lang::get('core.status')}}</th>
                </tr>
                </thead>
                <tbody>
             @foreach($rms as $rs)
                @if($rs['status']==1)
                <tr>
                  <td align="left">{!! \App\Library\SiteHelpers::roomType2($rs['roomtype']) !!}</td>
                  <td align="left">{!! \App\Library\SiteHelpers::showTravellers2($rs['travellers']) !!}</td>
                  <td align="left" >{!! \App\Library\BookingStatus::Status($rs['status']) !!}
                    </td>
                </tr>
                @endif
            @endforeach
                </tbody>
              </table>
                    <br>
              <br>

        @if ($trs != NULL)
                <table  class="maintable"  cellpadding="0" cellspacing="0">
                <thead>
                <tr><th colspan="5" class="darkgray">{{Lang::get('core.tours')}}</th></tr>
                <tr class="gray">
                  <th width="20%" align="left" >{{Lang::get('core.tourname')}}</th>
                  <th width="20%" align="left" >{{Lang::get('core.tourcode')}}</th>
                  <th width="20%" align="left" >{{Lang::get('core.start')}}</th>
                  <th width="20%" height="20" align="left" >{{Lang::get('core.end')}}</th>
                  <th width="10%" align="center" >{{Lang::get('core.status')}}</th>
                </tr>
                </thead>
                <tbody>
             @foreach($trs as $ts)
                @if($ts['status']==1)
                <tr>
                  <td align="left"><a href="{{ url('tours/show/'.$ts['tourID'])}}" target="_blank"><strong>{{ \App\Library\SiteHelpers::formatLookUp($ts['tourID'],'tourID','1:tours:tourID:tour_name') }}</strong></a></td>
                  <td align="left"><a href="{{ url('tourdates/show/'.$ts['tourdateID'])}}" target="_blank"><strong> {{ \App\Library\SiteHelpers::formatLookUp($ts['tourdateID'],'tourdateID','1:tour_date:tourdateID:tour_code') }}</strong></a></td>
                  <td align="left">{{date("".CNF_DATE."",strtotime(\App\Library\SiteHelpers::formatLookUp($ts['tourdateID'],'tourdateID','1:tour_date:tourdateID:start'))) }}</td>
                <td align="left">{{ date("".CNF_DATE."",strtotime(\App\Library\SiteHelpers::formatLookUp($ts['tourdateID'],'tourdateID','1:tour_date:tourdateID:end'))) }}</td>
                  <td align="left"  >{!! \App\Library\BookingStatus::Status($ts['status']) !!}
                  </td>
                </tr>
                @endif
            @endforeach
                </tbody>
              </table>
              <br>
              <br>
@endif
@if ( $hotel != NULL )
            <table  class="maintable"  cellpadding="0" cellspacing="0">
                <thead>
                <tr><th colspan="5" class="darkgray">{{Lang::get('core.hotels')}}</th></tr>
                <tr class="gray">
                  <th >{{Lang::get('core.hotel')}}</th>
                  <th >{{Lang::get('core.location')}}</th>
                  <th >{{Lang::get('core.checkindate')}}</th>
                  <th >{{Lang::get('core.checkoutdate')}}</th>
                  <th  width="10%" align="center">{{Lang::get('core.status')}}</th>
                </tr>
                </thead>
                <tbody>
             @foreach($hotel as $hot)
                @if($hot['status']==1)
                <tr>
                  <td>{{ \App\Library\SiteHelpers::formatLookUp($hot['hotelID'],'hotelID','1:hotels:hotelID:hotel_name') }}</td>
                  <td>{{ \App\Library\SiteHelpers::formatLookUp($hot['cityID'],'cityID','1:def_city:cityID:city_name') }}, {{ \App\Library\SiteHelpers::formatLookUp($hot['countryID'],'countryID','1:def_country:countryID:country_name') }}</td>
                  <td>{{ \App\Library\SiteHelpers::TarihFormat($hot['checkin'])}}</td>
                  <td>{{ \App\Library\SiteHelpers::TarihFormat($hot['checkout'])}}</td>
                  <td>{!! \App\Library\BookingStatus::Status($hot['status']) !!}</td>
                </tr>
                @endif
            @endforeach
                </tbody>
              </table>
              <br>
              <br>
@endif
@if ( $flight !=NULL )
      <table  class="maintable"  cellpadding="0" cellspacing="0">
                <thead>
                    <tr><th colspan="6" class="darkgray">{{Lang::get('core.flights')}}</th></tr>
                <tr class="gray">
                  <th >{{Lang::get('core.travellers')}}</th>
                  <th >{{Lang::get('core.airline')}}</th>
                  <th >{{Lang::get('core.from')}}-{{Lang::get('core.to')}}</th>
                  <th >{{Lang::get('core.departuredate')}}</th>
                  <th >{{Lang::get('core.returndate')}}</th>
                  <th  width="10%" align="center">{{Lang::get('core.status')}}</th>
                </tr>
                </thead>
                <tbody>
             @foreach($flight as $fl)
                @if($fl['status']==1)
                <tr>
                  <td>{!! \App\Library\SiteHelpers::showTravellers2($fl['travellersID']) !!} </td>
                  <td>{{ \App\Library\SiteHelpers::formatLookUp($fl['airlineID'],'airlineID','1:def_airlines:airlineID:airline') }}</td>
                  <td>{{ \App\Library\SiteHelpers::formatLookUp($fl['depairportID'],'depairportID','1:def_airports:airportID:IATA') }}-{{ \App\Library\SiteHelpers::formatLookUp($fl['arrairportID'],'depairportID','1:def_airports:airportID:IATA') }}</td>
                  <td>{{ \App\Library\SiteHelpers::TarihFormat2($fl['departing'])}}</td>
                  <td>{{ \App\Library\SiteHelpers::TarihFormat2($fl['returning'])}}</td>
                  <td>{!! \App\Library\BookingStatus::Status($fl['status']) !!}</td>
                </tr>
                @endif
            @endforeach
                </tbody>
              </table>
              <br>
              <br>
@endif
@if ( $car != NULL )
      <table  class="maintable"  cellpadding="0" cellspacing="0">
                <thead>
                <tr><th colspan="6" class="darkgray">{{Lang::get('core.cars')}}</th></tr>
                <tr class="gray">
                  <th >{{Lang::get('core.car')}}</th>
                  <th >{{Lang::get('core.start')}}</th>
                  <th >{{Lang::get('core.end')}}</th>
                  <th >{{Lang::get('core.pickup')}}</th>
                  <th >{{Lang::get('core.dropoff')}}</th>
                  <th width="10%" align="center"   >{{Lang::get('core.status')}}</th>
                </tr>
                </thead>
                <tbody>
             @foreach($car as $cr)
                @if($cr['status']==1)
                <tr>
                <td>{{ \App\Library\SiteHelpers::formatLookUp($cr['carbrandID'],'carbrandID','1:def_car_brands:carbrandID:brand') }} {{ \App\Library\SiteHelpers::formatLookUp($cr['carsID'],'carsID','1:cars:carsID:model') }}</td>
                <td>{{ \App\Library\SiteHelpers::TarihFormat($cr['start'])}}</td>
                <td>{{ \App\Library\SiteHelpers::TarihFormat($cr['end'])}}</td>
                <td>{{ $cr['pickup'] }}</td>
                <td>{{ $cr['dropoff'] }}</td>
                <td >{!! \App\Library\BookingStatus::Status($cr['status']) !!}</td>
                </tr>
                @endif
            @endforeach
                </tbody>
              </table>
              <br>
              <br>
@endif
@if ( $extra != NULL )
      <table  class="maintable"  cellpadding="0" cellspacing="0">
                <thead>
                <tr><th colspan="2" class="darkgray">{{Lang::get('core.extraservices')}}</th></tr>
                <tr class="gray">
                  <th >{{Lang::get('core.extraservice')}}</th>
                  <th width="10%" align="center">{{Lang::get('core.status')}}</th>
                </tr>
                </thead>
                <tbody>
             @foreach($extra as $ex)
                @if($ex['status']==1)
                <tr>
                <td>{{ \App\Library\SiteHelpers::formatLookUp($ex['extraserviceID'],'extraserviceID','1:def_extra_services:extraserviceID:service_name') }}</td>
                <td  >{!! \App\Library\BookingStatus::Status($ex['status']) !!}</td>
                </tr>
                @endif
            @endforeach
                </tbody>
              </table>
@endif
<hr>
      <p>{{Lang::get('core.vouchertext2')}}</p>

</body>
