@if($setting['view-method'] =='native')
<div class="box box-primary">
	<div class="box-header with-border">

		<div class="box-header-tools pull-left" >
			@if($access['is_add'] ==1)
	   		<a href="{{ url('bookhotel/update/'.$id.'?return='.$return) }}" class="tips btn btn-default btn-xs " title="{{ Lang::get('core.btn_edit') }}" onclick="ajaxViewDetail('#bookhotel',this.href); return false; "><i class="fa  fa-edit fa-2x"></i></a>
			@endif
			<a href="{{ url('bookhotel/show/'.$id.'?&print=true&return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_print') }}" onclick="ajaxPopupStatic(this.href); return false;"><i class="fa  fa-print"></i></a>
		</div>

		<div class="box-header-tools pull-right " >
			<a href="{{ ($prevnext['prev'] != '' ? url('bookhotel/show/'.$prevnext['prev'].'?return='.$return ) : '#') }}" class="tips" onclick="ajaxViewDetail('#bookhotel',this.href); return false; "><i class="fa fa-arrow-left fa-2x"></i>  </a>
			<a href="{{ ($prevnext['next'] != '' ? url('bookhotel/show/'.$prevnext['next'].'?return='.$return ) : '#') }}" class="tips" onclick="ajaxViewDetail('#bookhotel',this.href); return false; "> <i class="fa fa-arrow-right fa-2x"></i>  </a>
			<a href="javascript:void(0)" class="collapse-close tips btn btn-default btn-xs" onclick="ajaxViewClose('#{{ $pageModule }}')">
			<i class="fa fa-remove"></i></a>
		</div>
	 </div>

	<div class="box-body">
@endif

		<table class="table  table-bordered" >
			<tbody>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{Lang::get('core.bookingno')}}</strong></td>
						<td><a href="createbooking/show/{{$row->bookingID}}">{{ $row->bookingID}} </a> </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{Lang::get('core.country')}}</strong></td>
						<td>{{ \App\Library\SiteHelpers::formatLookUp($row->countryID,'countryID','1:def_country:countryID:country_name') }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{Lang::get('core.city')}}</strong></td>
						<td>{{ \App\Library\SiteHelpers::formatLookUp($row->cityID,'cityID','1:def_city:cityID:city_name') }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{Lang::get('core.hotel')}}</strong></td>
						<td>{{ \App\Library\SiteHelpers::formatLookUp($row->hotelID,'hotelID','1:hotels:hotelID:hotel_name') }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{Lang::get('core.checkindate')}}</strong></td>
						<td>{{ date('d-M-Y',strtotime($row->checkin)) }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{Lang::get('core.checkindate')}}</strong></td>
						<td>{{ date('d-M-Y',strtotime($row->checkout)) }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{Lang::get('core.created')}}</strong></td>
						<td>{{ date('d-M-Y H:i',strtotime($row->created_at)) }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{Lang::get('core.updated')}}</strong></td>
						<td>{{ date('d-M-Y H:i',strtotime($row->updated_at)) }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{Lang::get('core.status')}}</strong></td>
						<td>{!! \App\Library\BookingStatus::Status($row->status) !!} </td>

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
