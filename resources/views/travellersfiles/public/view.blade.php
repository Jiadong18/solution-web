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
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('TravellerID', (isset($fields['travellerID']['language'])? $fields['travellerID']['language'] : array())) }}</strong></td>
						<td>{{ $row->travellerID}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('File Type', (isset($fields['file_type']['language'])? $fields['file_type']['language'] : array())) }}</strong></td>
						<td>{{ $row->file_type}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('File', (isset($fields['file']['language'])? $fields['file']['language'] : array())) }}</strong></td>
						<td>{{ $row->file}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Remarks', (isset($fields['remarks']['language'])? $fields['remarks']['language'] : array())) }}</strong></td>
						<td>{{ $row->remarks}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Created At', (isset($fields['created_at']['language'])? $fields['created_at']['language'] : array())) }}</strong></td>
						<td>{{ date('d:M:Y',strtotime($row->created_at)) }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Updated At', (isset($fields['updated_at']['language'])? $fields['updated_at']['language'] : array())) }}</strong></td>
						<td>{{ date('d:M:Y',strtotime($row->updated_at)) }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'></td>
						<td> <a href="javascript:history.go(-1)" class="btn btn-primary"> Back To Grid <a> </td>

					</tr>

			</tbody>
		</table>



	</div>
</div>
