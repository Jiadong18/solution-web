@if($setting['view-method'] =='native')
<div class="box box-primary">
	<div class="box-header with-border">

		<div class="box-header-tools pull-left" >
			@if($access['is_add'] ==1)
	   		<a href="{{ url('bookflight/update/'.$id.'?return='.$return) }}" class="tips btn btn-default btn-xs " title="{{ Lang::get('core.btn_edit') }}" onclick="ajaxViewDetail('#bookflight',this.href); return false; "><i class="fa  fa-edit fa-2x"></i></a>
			@endif
			<a href="{{ url('bookflight/show/'.$id.'?&print=true&return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_print') }}" onclick="ajaxPopupStatic(this.href); return false;"><i class="fa  fa-print"></i></a>
		</div>

		<div class="box-header-tools pull-right " >
			<a href="{{ ($prevnext['prev'] != '' ? url('bookflight/show/'.$prevnext['prev'].'?return='.$return ) : '#') }}" class="tips" onclick="ajaxViewDetail('#bookflight',this.href); return false; "><i class="fa fa-arrow-left fa-2x"></i>  </a>
			<a href="{{ ($prevnext['next'] != '' ? url('bookflight/show/'.$prevnext['next'].'?return='.$return ) : '#') }}" class="tips" onclick="ajaxViewDetail('#bookflight',this.href); return false; "> <i class="fa fa-arrow-right fa-2x"></i>  </a>
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
						<td><a href="createbooking/show/{{$row->bookingID}}">{{ \App\Library\SiteHelpers::formatLookUp($row->bookingID,'bookingID','1:bookings:bookingsID:bookingno') }} </a> </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{Lang::get('core.roundtrip')}}</strong></td>
						<td>{!! \App\Library\SiteHelpers::formatRows($row->return,$fields['return'],$row ) !!} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{Lang::get('core.travellers')}}</strong></td>
						<td>{!! \App\Library\SiteHelpers::showTravellers($row->travellersID) !!} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{Lang::get('core.departureairport')}}</strong></td>
						<td>{{ \App\Library\SiteHelpers::formatLookUp($row->depairportID,'depairportID','1:def_airports:airportID:airport_name') }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{Lang::get('core.arrivalairport')}}</strong></td>
						<td>{{ \App\Library\SiteHelpers::formatLookUp($row->arrairportID,'arrairportID','1:def_airports:airportID:airport_name') }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{Lang::get('core.departuredate')}}</strong></td>
						<td>{{ \App\Library\SiteHelpers::TarihFormat($row->departing)}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{Lang::get('core.returndate')}}</strong></td>
						<td>{{ \App\Library\SiteHelpers::TarihFormat($row->returning)}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong> {{Lang::get('core.airline')}}</strong></td>
						<td>{{ \App\Library\SiteHelpers::formatLookUp($row->airlineID,'airlineID','1:def_airlines:airlineID:airline') }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong> {{Lang::get('core.class')}} </strong></td>
						<td>{!! \App\Library\SiteHelpers::formatRows($row->class,$fields['class'],$row ) !!} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong> {{Lang::get('core.created')}} </strong></td>
						<td>{{ \App\Library\SiteHelpers::TarihFormat($row->created_at)}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong> {{Lang::get('core.updated')}} </strong></td>
						<td>{{ \App\Library\SiteHelpers::TarihFormat($row->updated_at)}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong> {{Lang::get('core.status')}} </strong></td>
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
