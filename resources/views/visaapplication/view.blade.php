@extends('layouts.app')
@section('content')
<?php
use \App\Http\Controllers\VisaapplicationController;
?>

<section class="content-header">
      <h1> {{ Lang::get('core.visaapplication') }}</h1>
    </section>

  <div class="content">
<div class="box box-primary">
	<div class="box-header with-border">
		<div class="box-header-tools pull-left" >
	   		<a href="{{ url('visaapplication?return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_back') }}"><i class="fa  fa-arrow-left fa-2x"></i></a>
			@if($access['is_add'] ==1)
	   		<a href="{{ url('visaapplication/update/'.$id.'?return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_edit') }}"><i class="fa  fa-edit fa-2x"></i></a>
			@endif

		</div>

		<div class="box-header-tools " >
			<a href="{{ ($prevnext['prev'] != '' ? url('visaapplication/show/'.$prevnext['prev'].'?return='.$return ) : '#') }}" class="tips"><i class="fa fa-arrow-left fa-2x"></i>  </a>
			<a href="{{ ($prevnext['next'] != '' ? url('visaapplication/show/'.$prevnext['next'].'?return='.$return ) : '#') }}" class="tips"> <i class="fa fa-arrow-right fa-2x"></i>  </a>
		</div>


	</div>
	<div class="box-body" >

		<table class="table table-striped table-bordered" >
			<tbody>

					<tr>
						<td width='40%' class='label-view text-right'><strong>Visa Applicants</strong></td>
						<td>{!! VisaapplicationController::visaApplicants($row->travellersID) !!} </td>

					</tr>

					<tr>
						<td width='40%' class='label-view text-right'><strong>Visa Application Country</strong></td>
						<td>{{ \App\Library\SiteHelpers::formatLookUp($row->countryID,'countryID','1:def_country:countryID:country_name') }} </td>

					</tr>

					<tr>
						<td width='40%' class='label-view text-right'><strong>Visa Duration</strong></td>
						<td>{{ $row->duration}} @if ($row->duration2 =='1') {{ Lang::get('core.days') }} @elseif ($row->duration2 =='2'){{ Lang::get('core.weeks') }} @elseif ($row->duration2 =='3'){{ Lang::get('core.months') }} @elseif ($row->duration2 =='4'){{ Lang::get('core.years') }} @endif </td>

					</tr>
					<tr>
						<td width='40%' class='label-view text-right'><strong>Application Date</strong></td>
						<td>{{ \App\Library\SiteHelpers::TarihFormat($row->applicationdate) }} </td>

					</tr>

					<tr>
						<td width='40%' class='label-view text-right'><strong>Processing Time</strong></td>
						<td>{{ $row->processintime}} Days</td>

					</tr>

					<tr>
						<td width='40%' class='label-view text-right'><strong>Down Payment</strong></td>
						<td>{{ $row->payment}} {{ \App\Library\SiteHelpers::formatLookUp($row->currencyID,'currencyID','1:def_currency:currencyID:currency_name') }}</td>

					</tr>
					<tr>
						<td width='40%' class='label-view text-right'><strong>Payment Type</strong></td>
						<td>{{ \App\Library\SiteHelpers::formatLookUp($row->paymenttypeID,'paymenttypeID','1:def_payment_types:paymenttypeID:payment_type') }} </td>

					</tr>

					<tr>
						<td width='40%' class='label-view text-right'><strong>Application Fee</strong></td>
						<td>{{ $row->applicationfee}} {{ \App\Library\SiteHelpers::formatLookUp($row->currencyID2,'currencyID2','1:def_currency:currencyID:currency_name') }}</td>

					</tr>
					<tr>
						<td width='40%' class='label-view text-right'><strong>Documents</strong></td>
						<td>
                    <ul class="uploadedLists " >
					<?php $cr= 0;
					$row->documents = explode(",",$row->documents);
					?>
					@foreach($row->documents as $files)
						@if(file_exists('./uploads/files/'.$files) && $files !='')
                            <li id="cr-<?php echo $cr;?>" class=" text-muted well well-sm no-shadow" style="margin-top: 10px;">
							<a href="{{ url('/uploads/files/'.$files) }}" target="_blank" >{{ $files }}</a>

							<?php ++$cr;?>
						</li>

						@endif

					@endforeach
					</ul>


                        </td>

					</tr>
                    <tr>
						<td width='40%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Remarks', (isset($fields['remarks']['language'])? $fields['remarks']['language'] : array())) }}</strong></td>
						<td>{{ $row->remarks}} </td>

					</tr>


					<tr>
						<td width='40%' class='label-view text-right'><strong>Status</strong></td>
						<td><span>{!! \App\Library\GeneralStatuss::Visa($row->status) !!}</span> </td>

					</tr>
				@if($row->status=='3')
					<tr>
						<td width='40%' class='label-view text-right'><strong>Visa Expiry Date</strong></td>
						<td>{{ \App\Library\SiteHelpers::TarihFormat($row->visaexpirydate) }} </td>

					</tr>
				@endif
                @if($row->status=='0')

					<tr>
						<td width='40%' class='label-view text-right'><strong>Reject Reason</strong></td>
						<td>{{ $row->rejectreason}} </td>

					</tr>
				@endif
			</tbody>
		</table>



	</div>
</div>
</div>

@stop
