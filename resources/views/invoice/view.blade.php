
@extends('layouts.app')

@section('content')
<?php
    use Carbon\Carbon;
    $payment = DB::table('invoice_payments')->where('invoiceID', $row->invoiceID )->sum('amount');
    $width= 100*$payment/$row->InvTotal ;
    $maxamount=$row->InvTotal-$payment;
?>
	<div class="box-header with-border">
				<div class="box-header-tools pull-left" >
			   		<a href="{{ url('invoice?return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_back') }}"><i class="fa fa-arrow-left fa-2x"></i></a>
					@if($access['is_add'] ==1)
			   		<a href="{{ url('invoice/update/'.$id.'?return='.$return) }}" class="tips text-green" title="{{ Lang::get('core.btn_edit') }}"><i class="fa  fa-edit fa-2x"></i></a>
					@endif
				</div>
				<div class="box-header-tools pull-right " >
					<a href="{{ ($prevnext['prev'] != '' ? url('invoice/show/'.$prevnext['prev'].'?return='.$return ) : '#') }}" class="tips" title="Previous"><i class="fa fa-arrow-left fa-2x"></i>  </a>
					<a href="{{ ($prevnext['next'] != '' ? url('invoice/show/'.$prevnext['next'].'?return='.$return ) : '#') }}" class="tips" title="Next"> <i class="fa fa-arrow-right fa-2x"></i>  </a>
				</div>
			</div>

<div class="box-body" >
<php></php>
    <section class="invoice">
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
        <img src="{{ asset('mmb/images/'.CNF_LOGO) }}" alt="{{ CNF_COMNAME }}"/>
            <small class="pull-right">{{Lang::get('core.dateissued')}}: {{ \App\Library\SiteHelpers::TarihFormat($row->DateIssued)}}  </small>
          </h2>
        </div>
      </div>
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <address>
            <strong>{{ CNF_COMNAME }}</strong><br>
            {{ CNF_ADDRESS }}<br>
            {{Lang::get('core.phone')}}: {{ CNF_TEL }}<br>
            {{Lang::get('core.email')}}: {{ CNF_EMAIL }}
          </address>
        </div>
        <div class="col-sm-4 invoice-col">
          <address>
            <strong>{{ \App\Library\SiteHelpers::formatLookUp($row->travellerID,'travellerID','1:travellers:travellerID:nameandsurname') }}</strong><br>
            {{ \App\Library\SiteHelpers::formatLookUp($row->travellerID,'travellerID','1:travellers:travellerID:address') }}
            {{ \App\Library\SiteHelpers::formatLookUp($row->travellerID,'travellerID','1:travellers:travellerID:city') }}
            <?php $invocountry=\App\Library\SiteHelpers::formatLookUp($row->travellerID,'travellerID','1:travellers:travellerID:countryID') ?>
            {{ \App\Library\SiteHelpers::formatLookUp($invocountry,'countryID','1:def_country:countryID:country_name') }} <br>
            {{Lang::get('core.phone')}}: {{ \App\Library\SiteHelpers::formatLookUp($row->travellerID,'travellerID','1:travellers:travellerID:phone') }}<br>
            {{Lang::get('core.email')}}: {{ \App\Library\SiteHelpers::formatLookUp($row->travellerID,'travellerID','1:travellers:travellerID:email') }}
          </address>
        </div>
        <div class="col-sm-4 invoice-col">
          <h2>{{Lang::get('core.invoiceno')}}: {{ $row->invoiceID}}</h2>
          <b>{{Lang::get('core.bookingno')}}: {{ \App\Library\SiteHelpers::formatLookUp($row->bookingID,'bookingsID','1:bookings:bookingsID:bookingno') }}</b><br>
          <b>{{Lang::get('core.duedate')}}: </b>{!! \App\Library\InvoiceStatus::Paymentstatus($row->DueDate) !!}<br>
          {!! \App\Library\InvoiceStatus::Payments($payment , $row->InvTotal) !!}
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12 table-responsive">

            <table class="table table-striped">
			<thead>
				<tr>
                    <th width="150">{{Lang::get('core.productcode')}} </th>
					<th>{{Lang::get('core.product')}}</th>
                    <th width="50"> {{Lang::get('core.qty')}} </th>
					<th width="130"> {{Lang::get('core.price')}}  </th>
					<th width="130"> {{Lang::get('core.total')}} </th>
				</tr>
			</thead>
			<tbody>
				@foreach ($items as $child)
				<tr class="clone clonedInput">
					<td>{{ $child->Code}}</td>
					<td>{{ $child->Items}}</td>
                    <td>{{ $child->Qty}}</td>
					<td>{{ \App\Library\SiteHelpers::formatLookUp($row->currency,'currency','1:def_currency:currencyID:currency_sym|symbol') }} {{ $child->Amount}}</td>
					<td>{{ \App\Library\SiteHelpers::formatLookUp($row->currency,'currency','1:def_currency:currencyID:currency_sym|symbol') }} {{ $child->Qty * $child->Amount }} </td>
				</tr>
				@endforeach
<tr><td></td></tr>
                <tr>
                    <td colspan="3"></td>
					<td><b>{{Lang::get('core.subtotal')}}</b></td>
					<td>{{ \App\Library\SiteHelpers::formatLookUp($row->currency,'currency','1:def_currency:currencyID:currency_sym|symbol') }} {{ $row->Subtotal }}</td>
				</tr>
                @if ($row->discount !='0')
				<tr >
                    <td colspan="3"></td>
					<td><b>{{Lang::get('core.discount')}}</b></td>
					<td>{{ \App\Library\SiteHelpers::formatLookUp($row->currency,'currency','1:def_currency:currencyID:currency_sym|symbol') }} {{ $row->discount}}</td>
				</tr>
                @endif
				@if ($row->tax !='0')
                <tr >
                    <td colspan="3"></td>
					<td><b>{{Lang::get('core.tax')}} ( {{ $row->tax}} % )</b></td>
					<td>{{ \App\Library\SiteHelpers::formatLookUp($row->currency,'currency','1:def_currency:currencyID:currency_sym|symbol') }} {{ ( $row->Subtotal - $row->discount ) * ($row->tax / 100) }} </td>
				</tr>
                @endif
				<tr >
                    <td colspan="3"></td>
					<td><b>{{Lang::get('core.total')}}</b></td>
					<td>{{ \App\Library\SiteHelpers::formatLookUp($row->currency,'currency','1:def_currency:currencyID:currency_sym|symbol') }} {{ $row->InvTotal}}</td>
				</tr>
              <tr>
                <td colspan="3"></td>
                <td><b>{{Lang::get('core.totalpayment')}}</b></td>
                <td>{{ \App\Library\SiteHelpers::formatLookUp($row->currency,'currency','1:def_currency:currencyID:currency_sym|symbol') }}<?php echo $payment ; ?> </td>
              </tr>
            @if ( $maxamount !='0')
                <tr>
                <td colspan="3"></td>
                <td><b>{{Lang::get('core.balancedue')}}</b></td>
                <td>{{ \App\Library\SiteHelpers::formatLookUp($row->currency,'currency','1:def_currency:currencyID:currency_sym|symbol') }} {{ $row->InvTotal - $payment }} </td>
              </tr>
                @endif
			</tbody>
		</table>

            <table class="table no-border ">
            <thead>
				<tr>
                    <th width="50"> </th>
                    <th ></th>
					<th width="130"></th>
					<th width="130"></th>
				</tr>
			</thead>

			<tbody>
				<tr>
                    <td colspan="1"></td>
                    <td>{{Lang::get('core.paymenttype')}}</td>
				</tr>
				<tr >
                    <td colspan="1"></td>
                    <td > {{Lang::get('core.notes')}}</td>
				</tr>
				<tr >
                    <td colspan="1"></td>
                    <td ><p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
              {{ $row->notes}}
                        </p></td>
				</tr>

			</tbody>
		</table>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead"> </p>
        </div>
      </div>
      <div class="row no-print">
        <div class="col-xs-12">
        @if ( $maxamount > 0)
          <a href="{{ url('payments/update?travellerID='.$row->travellerID.'&maxamount='.$maxamount)}}" title="{{Lang::get('core.addnewpayment')}}" onclick="MmbModal(this.href,'{{Lang::get('core.addnewpayment')}}'); return false;" target="_blank">
          <button type="button" class="btn btn-success pull-right" style="margin-right: 5px;"><i class="fa fa-cc-visa fa-2x"></i> {{Lang::get('core.addnewpayment')}}
          </button></a>
        @endif

          <a href="{{ URL::to('invoice/show/'.$id.'?pdf=true') }}" target="_blank"> <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-file-pdf-o fa-2x"></i> {{Lang::get('core.createpdf')}}
          </button></a>
        </div>
      </div>
    </section>
			</div>


@stop
