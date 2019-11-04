<?php
use \App\Http\Controllers\TourdatesController;
?>
<style>
* {
  box-sizing: border-box;
}

body {
  font-family:arial, sans-serif;
  font-size: 11px;
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
<table>
<tbody>
<tr>
<td align="left" colspan="9">{{ Lang::get('core.tourname') }}: {{ \App\Library\SiteHelpers::formatLookUp($row->tourID,'tourID','1:tours:tourID:tour_name') }}<br>{{ Lang::get('core.tourdate') }}: {{ \App\Library\SiteHelpers::TarihFormat($row->start)}} / {{ \App\Library\SiteHelpers::TarihFormat($row->end)}}<br>{{ Lang::get('core.tourcode') }}:{{ $row->tour_code}}<br>{{ Lang::get('core.guide') }}: {{ \App\Library\SiteHelpers::formatLookUp($row->guideID,'guideID','1:guides:guideID:name') }}</td>
</tr>
<tr>
<td></td>
<td colspan="3" align=center > {{ Lang::get('core.emergencydetails') }}</td>
<td colspan="3" align=center > {{ Lang::get('core.insurancedetails') }}</td>
<td colspan="2" align=center > {{ Lang::get('core.specialreq') }}</td>
</tr>
<tr>
<td style='width:10%'><strong>{{ Lang::get('core.passengerlist') }}</strong></td>
<td style='width:11%'><strong>{{ Lang::get('core.emergencycontact') }}</strong></td>
<td style='width:10%'><strong>{{ Lang::get('core.email') }}</strong></td>
<td style='width:10%'><strong>{{ Lang::get('core.phone') }}</strong></td>
<td style='width:12%'><strong>{{ Lang::get('core.insurancecompany') }}</strong></td>
<td style='width:12%'><strong>{{ Lang::get('core.insurancepolicyno') }}</strong> </td>
<td style='width:10%'><strong>{{ Lang::get('core.phone') }}</strong></td>
<td style='width:10%'><strong>{{ Lang::get('core.bedconfiguration') }}</strong></td>
<td style='width:15%'><strong>{{ Lang::get('core.dietaryreq') }}</strong></td>
</tr>
                        @foreach($bkList as $bl)
                        {!! TourdatesController::travelersDetailemergency($bl['travellers']) !!}
                        @endforeach

</tbody>
</table>
