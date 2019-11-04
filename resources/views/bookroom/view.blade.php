@if($setting['view-method'] =='native')
<div class="box box-primary">
	<div class="box-header with-border">

		<div class="box-header-tools pull-left" >
			@if($access['is_add'] ==1)
	   		<a href="{{ url('bookroom/update/'.$id.'?return='.$return) }}" class="tips btn btn-default btn-xs " title="{{ Lang::get('core.btn_edit') }}" onclick="ajaxViewDetail('#bookroom',this.href); return false; "><i class="fa  fa-edit fa-2x"></i></a>
			@endif
			<a href="{{ url('bookroom/show/'.$id.'?&print=true&return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_print') }}" onclick="ajaxPopupStatic(this.href); return false;"><i class="fa  fa-print"></i></a>
		</div>

		<div class="box-header-tools pull-right " >
			<a href="{{ ($prevnext['prev'] != '' ? url('bookroom/show/'.$prevnext['prev'].'?return='.$return ) : '#') }}" class="tips" onclick="ajaxViewDetail('#bookroom',this.href); return false; "><i class="fa fa-arrow-left fa-2x"></i>  </a>
			<a href="{{ ($prevnext['next'] != '' ? url('bookroom/show/'.$prevnext['next'].'?return='.$return ) : '#') }}" class="tips" onclick="ajaxViewDetail('#bookroom',this.href); return false; "> <i class="fa fa-arrow-right fa-2x"></i>  </a>
			<a href="javascript:void(0)" class="collapse-close tips btn btn-default btn-xs" onclick="ajaxViewClose('#{{ $pageModule }}')">
			<i class="fa fa-remove"></i></a>
		</div>
	 </div>

	<div class="box-body">
@endif

		<table class="table  table-bordered" >
			<tbody>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('RoomID', (isset($fields['roomID']['language'])? $fields['roomID']['language'] : array())) }}</strong></td>
						<td>{{ $row->roomID}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Room Type', (isset($fields['roomtype']['language'])? $fields['roomtype']['language'] : array())) }}</strong></td>
						<td>{!! \App\Library\SiteHelpers::formatRows($row->roomtype,$fields['roomtype'],$row ) !!} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('BookingID', (isset($fields['bookingID']['language'])? $fields['bookingID']['language'] : array())) }}</strong></td>
						<td>{{ $row->bookingID}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Travellers', (isset($fields['travellers']['language'])? $fields['travellers']['language'] : array())) }}</strong></td>
						<td>{{ $row->travellers}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Created At', (isset($fields['created_at']['language'])? $fields['created_at']['language'] : array())) }}</strong></td>
						<td>{{ $row->created_at}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Updated At', (isset($fields['updated_at']['language'])? $fields['updated_at']['language'] : array())) }}</strong></td>
						<td>{{ $row->updated_at}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Entry By', (isset($fields['entry_by']['language'])? $fields['entry_by']['language'] : array())) }}</strong></td>
						<td>{{ $row->entry_by}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Status', (isset($fields['status']['language'])? $fields['status']['language'] : array())) }}</strong></td>
						<td>{{ $row->status}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Remarks', (isset($fields['remarks']['language'])? $fields['remarks']['language'] : array())) }}</strong></td>
						<td>{{ $row->remarks}} </td>

					</tr>

			</tbody>
		</table>



@if($setting['form-method'] =='native')
	</div>
</div>
@endif

<script>
$(document).ready(function(){

});
</script>
