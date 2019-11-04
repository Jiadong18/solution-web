<?php
use \App\Http\Controllers\TourdatesController;
?>
<style>
* {
  box-sizing: border-box;
}

body {
  font-family:sans-serif;
  font-size: 12px;
}

h1 {
  font-size: 12px;
  font-weight: normal;
}

table {
  width: 100%;
  display: table;
  border-collapse: collapse;
  text-align: left;
}

table td {
  padding: 2px;
  border: 1px solid #000000;
}
</style>
                @if($total==0)
{{ Lang::get('core.nobookingmade') }}
                @else
                            <h2 align="center">{{ Lang::get('core.passportlist') }}
</h2>
                            <h3 align="center">{{ CNF_COMNAME }}<br>{{ CNF_TEL }}<br>{{ CNF_EMAIL }}</h3>

                <table>
                <tbody>

                <tr>
<td align="left" colspan="6">{{ Lang::get('core.tourname') }}: {{ \App\Library\SiteHelpers::formatLookUp($row->tourID,'tourID','1:tours:tourID:tour_name') }}<br>{{ Lang::get('core.tourdate') }}: {{ \App\Library\SiteHelpers::TarihFormat($row->start)}} / {{ \App\Library\SiteHelpers::TarihFormat($row->end)}}<br>{{ Lang::get('core.tourcode') }}:{{ $row->tour_code}}<br>{{ Lang::get('core.tourcode') }}: {{ \App\Library\SiteHelpers::formatLookUp($row->guideID,'guideID','1:guides:guideID:name') }}</td>

</tr>
                <tr style="background:#eeeeee; font-weight:bold; ">
<td style='width:25%'>{{ Lang::get('core.passengerlist') }}</td>
<td style='width:15%'><strong>{{ Lang::get('core.passportno') }}</strong></td>
<td style='width:15%'><strong>{{ Lang::get('core.passportcountry') }}</strong></td>
<td style='width:15%'><strong>{{ Lang::get('core.dateofbirth') }}</strong></td>
<td style='width:15%'><strong>{{ Lang::get('core.dateofissue') }}</strong></td>
<td style='width:15%'><strong>{{ Lang::get('core.dateofexpiry') }}</strong></td>
</tr>
                    @foreach($bkList as $bl)
                        {!! TourdatesController::travelersDetailpassport($bl['travellers']) !!}
                    @endforeach
              </tbody>
                </table>
            @endif
<table>
<tbody>
</tbody>
</table>
