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
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('TicketID', (isset($fields['TicketID']['language'])? $fields['TicketID']['language'] : array())) }}</strong></td>
						<td>{{ $row->TicketID}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Priority', (isset($fields['Priority']['language'])? $fields['Priority']['language'] : array())) }}</strong></td>
						<td>{!! \App\Library\SiteHelpers::formatRows($row->Priority,$fields['Priority'],$row ) !!} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Status', (isset($fields['Status']['language'])? $fields['Status']['language'] : array())) }}</strong></td>
						<td>{{ $row->Status}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Title', (isset($fields['Title']['language'])? $fields['Title']['language'] : array())) }}</strong></td>
						<td>{{ $row->Title}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('UserID', (isset($fields['UserID']['language'])? $fields['UserID']['language'] : array())) }}</strong></td>
						<td>{{ \App\Library\SiteHelpers::formatLookUp($row->UserID,'UserID','1:travellers:travellerID:nameandsurname') }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Category', (isset($fields['Category']['language'])? $fields['Category']['language'] : array())) }}</strong></td>
						<td>{{ \App\Library\SiteHelpers::formatLookUp($row->Category,'Category','1:tbl_ticket_category:ticket_category_ID:ticket_category') }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Image', (isset($fields['Image']['language'])? $fields['Image']['language'] : array())) }}</strong></td>
						<td>{{ $row->Image}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Description', (isset($fields['Description']['language'])? $fields['Description']['language'] : array())) }}</strong></td>
						<td>{{ $row->Description}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Assignments', (isset($fields['Assignments']['language'])? $fields['Assignments']['language'] : array())) }}</strong></td>
						<td>{{ $row->Assignments}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('CreatedOn', (isset($fields['createdOn']['language'])? $fields['createdOn']['language'] : array())) }}</strong></td>
						<td>{{ $row->createdOn}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('UpdatedOn', (isset($fields['updatedOn']['language'])? $fields['updatedOn']['language'] : array())) }}</strong></td>
						<td>{{ $row->updatedOn}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Entry By', (isset($fields['entry_by']['language'])? $fields['entry_by']['language'] : array())) }}</strong></td>
						<td>{{ $row->entry_by}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Fullname', (isset($fields['fullname']['language'])? $fields['fullname']['language'] : array())) }}</strong></td>
						<td>{{ $row->fullname}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Email', (isset($fields['email']['language'])? $fields['email']['language'] : array())) }}</strong></td>
						<td>{{ $row->email}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Avatar', (isset($fields['avatar']['language'])? $fields['avatar']['language'] : array())) }}</strong></td>
						<td>{{ $row->avatar}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'></td>
						<td> <a href="javascript:history.go(-1)" class="btn btn-primary"> Back To Grid <a> </td>

					</tr>

			</tbody>
		</table>



	</div>
</div>
