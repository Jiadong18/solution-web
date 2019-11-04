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
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Tour Category', (isset($fields['tourcategoryname']['language'])? $fields['tourcategoryname']['language'] : array())) }}</strong></td>
						<td><a href="tours?search=tourcategoriesID:=:{{$row->tourcategoriesID}}">{{ $row->tourcategoryname}} </a> </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Status', (isset($fields['status']['language'])? $fields['status']['language'] : array())) }}</strong></td>
						<td>{{ \App\Library\GeneralStatuss::Status($row->status) }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'></td>
						<td> <a href="javascript:history.go(-1)" class="btn btn-primary"> Back To Grid <a> </td>

					</tr>

			</tbody>
		</table>



	</div>
</div>
