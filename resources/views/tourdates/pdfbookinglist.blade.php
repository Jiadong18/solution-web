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
                            <h2 align="center">{{ Lang::get('core.grouproominglist') }}</h2>

<h3 align="LEFT">{{ CNF_COMNAME }}<br>{{ CNF_TEL }}<br>{{ CNF_EMAIL }}</h3>
                <table>
                <tbody>

                <tr>
<td align="left" colspan="2">{{ Lang::get('core.tourname') }}: {{ \App\Library\SiteHelpers::formatLookUp($row->tourID,'tourID','1:tours:tourID:tour_name') }}<br>{{ Lang::get('core.tourdate') }}: {{ \App\Library\SiteHelpers::TarihFormat($row->start)}} / {{ \App\Library\SiteHelpers::TarihFormat($row->end)}}<br>{{ Lang::get('core.tourcode') }}:{{ $row->tour_code}}<br>{{ Lang::get('core.guide') }}: {{ \App\Library\SiteHelpers::formatLookUp($row->guideID,'guideID','1:guides:guideID:name') }}</td>
<td align="left">{{ Lang::get('core.singleroom') }}:{{ $room_single}}<br>{{ Lang::get('core.doubleroom') }}:{{ $room_double}}<br>{{ Lang::get('core.tripleroom') }}:{{ $room_triple}}<br>{{ Lang::get('core.totalpassenger') }}:{{ $total}}</td>
</tr>
                <tr style="background:#eeeeee; font-weight:bold; ">
                    <td style="width: 5%; text-align:center; height:20;">#</td>
                    <td style="width: 60%;">{{ Lang::get('core.namesurname') }}</td>
                    <td style="width: 35%;  ">{{ Lang::get('core.remarks') }}</td>
                </tr>
                    <?php $count = 1; ?>
                    @foreach($bkList as $bl)
                <tr>
                   <td style="font-weight:bold; text-align:center; height:18;"><?php echo $count ; $count++ ; ?></td>
                    <td><table >
                        <tbody>{!! TourdatesController::travelersDetailpdf($bl['travellers']) !!}</tbody></table></td>
                    <td style="background:#eeeeee;">{!! $bl['remarks'] !!}</td>
                </tr>
                    @endforeach
                @if ($row->remarks!=NULL)
                    <tr>
                <td align="left" colspan="3">{{ Lang::get('core.remarks') }}:<BR>{!!$row->remarks !!}</td>
                </tr>
                    @endif
              </tbody>
                </table>
            @endif
