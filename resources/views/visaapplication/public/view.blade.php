<div class="m-t" style="padding-top:25px;">
    <div class="row m-b-lg animated fadeInDown delayp1 text-center">
        <h3> {{ $pageTitle }} <small> {{ $pageNote }} </small></h3>
        <hr />
    </div>
</div>
<div class="m-t">
	<div class="table-responsive" >

		<table class="table table-striped table-bordered" >
			<tbody>


					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('TravellersID', (isset($fields['travellersID']['language'])? $fields['travellersID']['language'] : array())) }}</strong></td>
						<td>{{ \App\Library\SiteHelpers::formatLookUp($row->travellersID,'travellersID','1:travellers:travellerID:nameandsurname') }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('CountryID', (isset($fields['countryID']['language'])? $fields['countryID']['language'] : array())) }}</strong></td>
						<td>{{ \App\Library\SiteHelpers::formatLookUp($row->countryID,'countryID','1:def_country:countryID:country_name') }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Duration', (isset($fields['duration']['language'])? $fields['duration']['language'] : array())) }}</strong></td>
						<td>{{ $row->duration}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Duration2', (isset($fields['duration2']['language'])? $fields['duration2']['language'] : array())) }}</strong></td>
						<td>{{ $row->duration2}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Applicationdate', (isset($fields['applicationdate']['language'])? $fields['applicationdate']['language'] : array())) }}</strong></td>
						<td>{{ $row->applicationdate}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Processintime', (isset($fields['processintime']['language'])? $fields['processintime']['language'] : array())) }}</strong></td>
						<td>{{ $row->processintime}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Payment', (isset($fields['payment']['language'])? $fields['payment']['language'] : array())) }}</strong></td>
						<td>{{ $row->payment}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('CurrencyID', (isset($fields['currencyID']['language'])? $fields['currencyID']['language'] : array())) }}</strong></td>
						<td>{{ \App\Library\SiteHelpers::formatLookUp($row->currencyID,'currencyID','1:def_currency:currencyID:currency_name') }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('PaymenttypeID', (isset($fields['paymenttypeID']['language'])? $fields['paymenttypeID']['language'] : array())) }}</strong></td>
						<td>{{ $row->paymenttypeID}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Applicationfee', (isset($fields['applicationfee']['language'])? $fields['applicationfee']['language'] : array())) }}</strong></td>
						<td>{{ $row->applicationfee}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('CurrencyID2', (isset($fields['currencyID2']['language'])? $fields['currencyID2']['language'] : array())) }}</strong></td>
						<td>{{ \App\Library\SiteHelpers::formatLookUp($row->currencyID2,'currencyID2','1:def_currency:currencyID:currency_name') }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Documents', (isset($fields['documents']['language'])? $fields['documents']['language'] : array())) }}</strong></td>
						<td>{{ $row->documents}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Status', (isset($fields['status']['language'])? $fields['status']['language'] : array())) }}</strong></td>
						<td>{{ $row->status}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Visaexpirydate', (isset($fields['visaexpirydate']['language'])? $fields['visaexpirydate']['language'] : array())) }}</strong></td>
						<td>{{ $row->visaexpirydate}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Rejectreason', (isset($fields['rejectreason']['language'])? $fields['rejectreason']['language'] : array())) }}</strong></td>
						<td>{{ $row->rejectreason}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Remarks', (isset($fields['remarks']['language'])? $fields['remarks']['language'] : array())) }}</strong></td>
						<td>{{ $row->remarks}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Entry By', (isset($fields['entry_by']['language'])? $fields['entry_by']['language'] : array())) }}</strong></td>
						<td>{{ $row->entry_by}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'></td>
						<td> <a href="javascript:history.go(-1)" class="btn btn-primary"> Back To Grid <a> </td>

					</tr>

			</tbody>
		</table>



	</div>
</div>
