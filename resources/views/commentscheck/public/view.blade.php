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
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('PageID', (isset($fields['pageID']['language'])? $fields['pageID']['language'] : array())) }}</strong></td>
						<td>{{ \App\Library\SiteHelpers::formatLookUp($row->pageID,'pageID','1:tb_pages:pageID:title') }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('UserID', (isset($fields['userID']['language'])? $fields['userID']['language'] : array())) }}</strong></td>
						<td>{{ \App\Library\SiteHelpers::formatLookUp($row->userID,'userID','1:tb_users:id:username') }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Comments', (isset($fields['comments']['language'])? $fields['comments']['language'] : array())) }}</strong></td>
						<td>{{ $row->comments}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Posted', (isset($fields['posted']['language'])? $fields['posted']['language'] : array())) }}</strong></td>
						<td>{{ $row->posted}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Approved', (isset($fields['approved']['language'])? $fields['approved']['language'] : array())) }}</strong></td>
						<td>{{ $row->approved}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'></td>
						<td> <a href="javascript:history.go(-1)" class="btn btn-primary"> Back To Grid <a> </td>

					</tr>

			</tbody>
		</table>



	</div>
</div>
