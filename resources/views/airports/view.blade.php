@if($setting['view-method'] =='native')
<div class="box box-primary">
	<div class="box-header with-border">

		<div class="box-header-tools pull-left" >
			@if($access['is_add'] ==1)
	   		<a href="{{ url('airports/update/'.$id.'?return='.$return) }}" class="tips btn btn-default btn-xs " title="{{ Lang::get('core.btn_edit') }}" onclick="ajaxViewDetail('#airports',this.href); return false; "><i class="fa  fa-edit fa-2x"></i></a>
			@endif
			<a href="{{ url('airports/show/'.$id.'?&print=true&return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_print') }}" onclick="ajaxPopupStatic(this.href); return false;"><i class="fa  fa-print"></i></a>

		</div>

		<div class="box-header-tools pull-right " >
			<a href="{{ ($prevnext['prev'] != '' ? url('airports/show/'.$prevnext['prev'].'?return='.$return ) : '#') }}" class="tips btn btn-default btn-xs " onclick="ajaxViewDetail('#airports',this.href); return false; "><i class="fa fa-arrow-left fa-2x"></i>  </a>
			<a href="{{ ($prevnext['next'] != '' ? url('airports/show/'.$prevnext['next'].'?return='.$return ) : '#') }}" class="tips" onclick="ajaxViewDetail('#airports',this.href); return false; "> <i class="fa fa-arrow-right fa-2x"></i>  </a>
			<a href="javascript:void(0)" class="collapse-close tips btn btn-default btn-xs" onclick="ajaxViewClose('#{{ $pageModule }}')">
			<i class="fa fa-remove"></i></a>
		</div>

	 </div>

	<div class="box-body">
@endif

		<table class="table  table-bordered" >
			<tbody>

					<tr>
						<td width='30%' class='label-view text-right'>{{ \App\Library\SiteHelpers::activeLang('Airport Name', (isset($fields['airport_name']['language'])? $fields['airport_name']['language'] : array())) }}</td>
						<td>{{ $row->airport_name}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'>{{ \App\Library\SiteHelpers::activeLang('Country', (isset($fields['countryID']['language'])? $fields['countryID']['language'] : array())) }}</td>
						<td>{{ \App\Library\SiteHelpers::formatLookUp($row->countryID,'countryID','1:def_country:countryID:country_name') }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'>{{ \App\Library\SiteHelpers::activeLang('City', (isset($fields['cityID']['language'])? $fields['cityID']['language'] : array())) }}</td>
						<td>{{ \App\Library\SiteHelpers::formatLookUp($row->cityID,'cityID','1:def_city:cityID:city_name') }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'>{{ \App\Library\SiteHelpers::activeLang('Status', (isset($fields['status']['language'])? $fields['status']['language'] : array())) }}</td>
						<td>{{ \App\Library\GeneralStatuss::Status($row->status) }} </td>

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
