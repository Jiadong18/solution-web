<?php
    use Carbon\Carbon;
    $payment = DB::table('invoice_payments')->where('invoiceID', $row->invoiceID )->sum('amount');
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>{{ CNF_COMNAME }}</title>
<link href="https://fonts.googleapis.com/css?family=Arial:400,700|Montserrat" rel="stylesheet">
<style type="text/css">
body {
  position: relative;
  color: #555555;
  font-size: 14px;
  font-family: Lato;
}

table.maintable {
    width: 100%;
}
table.gridtable {
    width: 100%;
    border-width: 0px;
}
table.gridtable th {
	padding: 8px;
}
table.gridtable td {
	padding: 8px;
}

.green {font-family: 'Montserrat', sans-serif;
  font-size: 15px; color: #ffffff ; background-color: #8bc34a; }
.gray {font-family: 'Montserrat', sans-serif;
  font-size: 13px; color: #000000 ; background-color: #efefef; }
</style>
  </head>
  <body>

<table cellpadding="0" cellspacing="0" class="maintable" style="width: 100%;">
<tbody>
<tr>
<td rowspan="4">@if(file_exists(public_path().'/mmb/images/'.CNF_LOGO) && CNF_LOGO !='')
        <img src="{{ asset('mmb/images/'.CNF_LOGO)}}" />
        @else
        <img src="{{ asset('mmb/images/logo.png')}}" />
        @endif </td>
<td align="right" style="font-family: 'Montserrat', sans-serif;
  font-size: 25px; color:#0087C3;">{{ CNF_COMNAME }}</td>
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
<hr>
<table class="maintable">
<tbody>
<tr>
<td align="left" style="font-family: 'Montserrat', sans-serif;
  font-size: 15px; color: #990000 ;"></td>
<td align="right" style="font-family: 'Montserrat', sans-serif;
  font-size: 15px;">{{Lang::get('core.invoiceno')}} :  {{ $row->invoiceID}}</td>
</tr>
<tr>
<td align="left">{{ \App\Library\SiteHelpers::formatLookUp($row->travellerID,'travellerID','1:travellers:travellerID:nameandsurname') }}</td>
<td align="right">{{Lang::get('core.bookingno')}} :      {{ \App\Library\SiteHelpers::formatLookUp($row->bookingID,'bookingsID','1:bookings:bookingsID:bookingno') }}</td>
</tr>
<tr>
<td align="left">{{ \App\Library\SiteHelpers::formatLookUp($row->travellerID,'travellerID','1:travellers:travellerID:address') }} {{ \App\Library\SiteHelpers::formatLookUp($row->travellerID,'travellerID','1:travellers:travellerID:city') }}
{{ \App\Library\SiteHelpers::formatLookUp($row->travellerID,'travellerID','1:travellers:travellerID:countryID') }}</td>
<td align="right">{{Lang::get('core.dateissued')}}: {{ \App\Library\SiteHelpers::TarihFormat($row->DateIssued)}}</td>
</tr>
<tr>
<td align="left">{{ \App\Library\SiteHelpers::formatLookUp($row->travellerID,'travellerID','1:travellers:travellerID:email') }}</td>
<td align="right">{{Lang::get('core.duedate')}}: {{ \App\Library\SiteHelpers::TarihFormat($row->DueDate)}}</td>
</tr>
<tr>
<td align="left">{{ \App\Library\SiteHelpers::formatLookUp($row->travellerID,'travellerID','1:travellers:travellerID:phone') }}</td>
<td align="right"></td>
</tr>
</tbody>
</table>
    <br>
      <table class="gridtable">
        <thead>
          <tr class="green">
            <td >{{Lang::get('core.productcode')}}</td>
            <td >{{Lang::get('core.product')}}</td>
            <td >{{Lang::get('core.price')}}</td>
            <td >{{Lang::get('core.qty')}}</td>
            <td >{{Lang::get('core.total')}}</td>
          </tr>
        </thead>
        <tbody>
            @foreach ($items as $child)

          <tr>
            <td >{{ $child->Code}}</td>
            <td >{{ $child->Items}}</td>
            <td >{{ \App\Library\SiteHelpers::formatLookUp($row->currency,'currency','1:def_currency:currencyID:currency_sym') }} {{ $child->Amount}}</td>
            <td align="center">{{ $child->Qty}}</td>
            <td >{{ \App\Library\SiteHelpers::formatLookUp($row->currency,'currency','1:def_currency:currencyID:currency_sym') }} {{ $child->Qty * $child->Amount }}</td>
          </tr>
            @endforeach
          <tr>
            <td class="gray" colspan="4" align="right" >{{Lang::get('core.subtotal')}}</td>
            <td class="green">{{ \App\Library\SiteHelpers::formatLookUp($row->currency,'currency','1:def_currency:currencyID:currency_sym') }} {{ $row->Subtotal }}</td>
          </tr>
        @if ($row->discount !='0')
            <tr>
            <td class="gray"colspan="4" align="right">{{Lang::get('core.discount')}}</td>
            <td class="green">{{ \App\Library\SiteHelpers::formatLookUp($row->currency,'currency','1:def_currency:currencyID:currency_sym') }} {{ $row->discount}}</td>
          </tr>
        @endif

            @if ($row->tax !='0')
            <tr >
            <td class="gray"colspan="4" align="right">{{Lang::get('core.tax')}} ( {{ $row->tax}} % )</td>
            <td class="green">{{ \App\Library\SiteHelpers::formatLookUp($row->currency,'currency','1:def_currency:currencyID:currency_sym') }} {{ ( $row->Subtotal - $row->discount ) * ($row->tax / 100) }}</td>
            </tr>
                @endif
          <tr>
            <td class="gray" colspan="4" align="right">{{Lang::get('core.total')}}</td>
            <td class="green">{{ \App\Library\SiteHelpers::formatLookUp($row->currency,'currency','1:def_currency:currencyID:currency_sym') }} {{ $row->InvTotal}}</td>
          </tr>
         @if ($payment >'0')
          <tr>
            <td class="gray" colspan="4" align="right">{{Lang::get('core.totalpayment')}}</td>
            <td class="green">{{ \App\Library\SiteHelpers::formatLookUp($row->currency,'currency','1:def_currency:currencyID:currency_sym') }} <?php echo $payment ; ?></td>
          </tr>
        @endif
            @if ( ( $row->InvTotal - $payment ) !='0')
          <tr>
            <td class="gray"colspan="4" align="right">{{Lang::get('core.balancedue')}}</td>
            <td class="green">{{ \App\Library\SiteHelpers::formatLookUp($row->currency,'currency','1:def_currency:currencyID:currency_sym') }} {{ $row->InvTotal - $payment }}</td>
          </tr>
            @endif
          <tr>
            <td >{{Lang::get('core.paymenttype')}}</td>
            <td colspan="4">{!! \App\Library\SiteHelpers::showPaymentOptions($row->payment_type) !!}</td>
          </tr>
          <tr>
            <td >{{Lang::get('core.notes')}}</td>
            <td colspan="4">{{ $row->notes}}</td>
          </tr>

          </tbody>
      </table>
