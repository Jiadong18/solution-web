@if($setting['view-method'] =='native')
<div class="box box-primary">
	<div class="box-header with-border">

		<div class="box-header-tools pull-left" >
			@if($access['is_add'] ==1)
	   		<a href="{{ url('cars/update/'.$id.'?return='.$return) }}" class="tips btn btn-default btn-xs " title="{{ Lang::get('core.btn_edit') }}" onclick="ajaxViewDetail('#cars',this.href); return false; "><i class="fa  fa-edit fa-2x"></i></a>
			@endif
			<a href="{{ url('cars/show/'.$id.'?&print=true&return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_print') }}" onclick="ajaxPopupStatic(this.href); return false;"><i class="fa  fa-print"></i></a>
		</div>

		<div class="box-header-tools pull-right " >
			<a href="{{ ($prevnext['prev'] != '' ? url('cars/show/'.$prevnext['prev'].'?return='.$return ) : '#') }}" class="tips" onclick="ajaxViewDetail('#cars',this.href); return false; "><i class="fa fa-arrow-left fa-2x"></i>  </a>
			<a href="{{ ($prevnext['next'] != '' ? url('cars/show/'.$prevnext['next'].'?return='.$return ) : '#') }}" class="tips" onclick="ajaxViewDetail('#cars',this.href); return false; "> <i class="fa fa-arrow-right fa-2x"></i>  </a>
			<a href="javascript:void(0)" class="collapse-close tips btn btn-default btn-xs" onclick="ajaxViewClose('#{{ $pageModule }}')">
			<i class="fa fa-remove"></i></a>
		</div>
	 </div>

	<div class="box-body">
@endif

		<table class="table  table-bordered" >
			<tbody>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{Lang::get('core.brand')}}</strong></td>
						<td>{{ \App\Library\SiteHelpers::formatLookUp($row->carbrandID,'carbrandID','1:def_car_brands:carbrandID:brand') }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{Lang::get('core.featured')}}</strong></td>
						<td>{!! \App\Library\SiteHelpers::Featured($row->featured) !!} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{Lang::get('core.description')}}</strong></td>
						<td>{{ $row->description}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{Lang::get('core.model')}}</strong></td>
						<td>{{ $row->model}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{Lang::get('core.passengers')}}</strong></td>
						<td>{{ $row->passengers}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{Lang::get('core.cardoors')}}</strong></td>
						<td>{{ $row->cardoors}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{Lang::get('core.transmission')}}</strong></td>
						<td>{{ $row->transmission}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{Lang::get('core.baggage')}}</strong></td>
						<td>{{ $row->baggage}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{Lang::get('core.type')}}</strong></td>
						<td>{!! \App\Library\SiteHelpers::formatRows($row->type,$fields['type'],$row ) !!} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{Lang::get('core.dailyrate')}}</strong></td>
						<td>{{ $row->dayrate}} {{ \App\Library\SiteHelpers::formatLookUp($row->currencyID,'currencyID','1:def_currency:currencyID:currency_sym|symbol') }}</td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{Lang::get('core.weeklyrate')}}</strong></td>
						<td>{{ $row->weekrate}} {{ \App\Library\SiteHelpers::formatLookUp($row->currencyID,'currencyID','1:def_currency:currencyID:currency_sym|symbol') }}</td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{Lang::get('core.monthlyrate')}}</strong></td>
						<td>{{ $row->monthrate}} {{ \App\Library\SiteHelpers::formatLookUp($row->currencyID,'currencyID','1:def_currency:currencyID:currency_sym|symbol') }}</td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{Lang::get('core.airportpickup')}}</strong></td>
						<td>{!! \App\Library\SiteHelpers::formatRows($row->airportpickup,$fields['airportpickup'],$row ) !!} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{Lang::get('core.similarcars')}}</strong></td>
						<td>{{ $row->similarcars}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{Lang::get('core.images')}}</strong></td>
						<td>{!! \App\Library\SiteHelpers::formatRows($row->images,$fields['images'],$row ) !!} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{Lang::get('core.availableextras')}}</strong></td>
						<td>{{ \App\Library\SiteHelpers::formatLookUp($row->availableextras,'availableextras','1:def_car_extras:carsextrasID:name') }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{Lang::get('core.status')}}</strong></td>
						<td>{!! \App\Library\GeneralStatuss::Status($row->status) !!} </td>

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
