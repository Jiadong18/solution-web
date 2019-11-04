@if($setting['view-method'] =='native')
<div class="box box-primary">
	<div class="box-header with-border">

		<div class="box-header-tools pull-left" >
			@if($access['is_add'] ==1)
	   		<a href="{{ url('calendartourdates/update/'.$id.'?return='.$return) }}" class="tips btn btn-default btn-xs " title="{{ Lang::get('core.btn_edit') }}" onclick="ajaxViewDetail('#calendartourdates',this.href); return false; "><i class="fa  fa-edit fa-2x"></i></a>
			@endif
			<a href="{{ url('calendartourdates/show/'.$id.'?&print=true&return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_print') }}" onclick="ajaxPopupStatic(this.href); return false;"><i class="fa  fa-print"></i></a>
		</div>

		<div class="box-header-tools pull-right " >
			<a href="{{ ($prevnext['prev'] != '' ? url('calendartourdates/show/'.$prevnext['prev'].'?return='.$return ) : '#') }}" class="tips" onclick="ajaxViewDetail('#calendartourdates',this.href); return false; "><i class="fa fa-arrow-left fa-2x"></i>  </a>
			<a href="{{ ($prevnext['next'] != '' ? url('calendartourdates/show/'.$prevnext['next'].'?return='.$return ) : '#') }}" class="tips" onclick="ajaxViewDetail('#calendartourdates',this.href); return false; "> <i class="fa fa-arrow-right fa-2x"></i>  </a>
			<a href="javascript:void(0)" class="collapse-close tips btn btn-default btn-xs" onclick="ajaxViewClose('#{{ $pageModule }}')">
			<i class="fa fa-remove"></i></a>
		</div>
	 </div>

	<div class="box-body">
@endif

		<table class="table  table-bordered" >
			<tbody>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ Lang::get('core.featured') }}</strong></td>
						<td>{!! \App\Library\SiteHelpers::Featured($row->featured) !!} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ Lang::get('core.tourcategory') }}</strong></td>
						<td>{{ \App\Library\SiteHelpers::formatLookUp($row->tourcategoriesID,'tourcategoriesID','1:def_tour_categories:tourcategoriesID:tourcategoryname') }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ Lang::get('core.tourname') }}</strong></td>
						<td>{{ \App\Library\SiteHelpers::formatLookUp($row->tourID,'tourID','1:tours:tourID:tour_name') }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ Lang::get('core.tourcode') }}</strong></td>
						<td>{{ $row->tour_code}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ Lang::get('core.definitedeparture') }}</strong></td>
						<td>{!! \App\Library\SiteHelpers::Definite_departure($row->definite_departure) !!} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ Lang::get('core.start') }}</strong></td>
						<td>{{ \App\Library\SiteHelpers::TarihFormat($row->start)}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ Lang::get('core.end') }}</strong></td>
						<td>{{ \App\Library\SiteHelpers::TarihFormat($row->end)}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ Lang::get('core.guide') }}</strong></td>
						<td>{{ \App\Library\SiteHelpers::formatLookUp($row->guideID,'guideID','1:guides:guideID:name') }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ Lang::get('core.capacity') }}</strong></td>
						<td>{{ $row->total_capacity}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ Lang::get('core.singleroom') }}</strong></td>
						<td>{{ $row->cost_single}} {{ \App\Library\SiteHelpers::formatLookUp($row->currencyID,'currencyID','1:def_currency:currencyID:symbol|currency_name') }}</td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ Lang::get('core.doubleroom') }}</strong></td>
						<td>{{ $row->cost_double}} {{ \App\Library\SiteHelpers::formatLookUp($row->currencyID,'currencyID','1:def_currency:currencyID:symbol|currency_name') }}</td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ Lang::get('core.tripleroom') }}</strong></td>
						<td>{{ $row->cost_triple}} {{ \App\Library\SiteHelpers::formatLookUp($row->currencyID,'currencyID','1:def_currency:currencyID:symbol|currency_name') }}</td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ Lang::get('core.child') }}</strong></td>
						<td>{{ $row->cost_child}} {{ \App\Library\SiteHelpers::formatLookUp($row->currencyID,'currencyID','1:def_currency:currencyID:symbol|currency_name') }}</td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ Lang::get('core.remarks') }}</strong></td>
						<td>{!! $row->remarks!!} </td>

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
