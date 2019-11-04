@if($setting['view-method'] =='native')
<div class="box box-primary">
	<div class="box-header with-border">

		<div class="box-header-tools pull-left" >
			@if($access['is_add'] ==1)
	   		<a href="{{ url('calendartourdates/update/'.$id.'?return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_edit') }}" onclick="ajaxViewDetail('#calendartourdates',this.href); return false; "><i class="fa  fa-edit fa-2x"></i></a>
			@endif
			<a href="{{ url('calendartourdates/show/'.$id.'?&print=true&return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_print') }}" onclick="ajaxPopupStatic(this.href); return false;"><i class="fa  fa-print"></i></a>

		</div>

		<div class="box-header-tools pull-right " >
			<a href="{{ ($prevnext['prev'] != '' ? url('calendartourdates/show/'.$prevnext['prev'].'?return='.$return ) : '#') }}" class="tips" onclick="ajaxViewDetail('#calendartourdates',this.href); return false; "><i class="fa fa-arrow-left fa-2x"></i>  </a>
			<a href="{{ ($prevnext['next'] != '' ? url('calendartourdates/show/'.$prevnext['next'].'?return='.$return ) : '#') }}" class="tips" onclick="ajaxViewDetail('#calendartourdates',this.href); return false; "> <i class="fa fa-arrow-right fa-2x"></i>  </a>
			<a href="javascript:void(0)" class="collapse-close tips btn btn-default btn-xs" onclick="ajaxViewClose('#{{ $pageModule }}')">
			<i class="fa fa-times"></i></a>
		</div>
	 </div>

	<div class="box-body">
@endif
    <div class="nav-tabs-custom">
  <ul class="nav nav-tabs" role="tablist">
  	<li role="presentation" class="active"><a href="#home{{ $row->tourdateID }}" aria-controls="home" role="tab" data-toggle="tab"> View Detail </a></li>
	@foreach($subgrid as $sub)
		<li role="presentation"><a href="#{{ str_replace(" ","_",$sub['title']) }}{{ $row->{$sub['master_key']} }}" aria-controls="profile" role="tab" data-toggle="tab">  {{ $sub['title'] }} </a></li>
	@endforeach
  </ul>


  <!-- Tab panes -->
  <div class="tab-content m-t">
  	<div role="tabpanel" class="tab-pane active" id="home{{ $row->tourdateID }}">

		<div class="table-responsive" >
			<table class="table table-striped table-bordered" >
				<tbody>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Featured', (isset($fields['featured']['language'])? $fields['featured']['language'] : array())) }}</strong></td>
						<td>{{ FeaturedTour::Featured($row->featured) }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Category', (isset($fields['tourcategoriesID']['language'])? $fields['tourcategoriesID']['language'] : array())) }}</strong></td>
						<td>{{ \App\Library\SiteHelpers::formatLookUp($row->tourcategoriesID,'tourcategoriesID','1:def_tour_categories:tourcategoriesID:tourcategoryname') }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Tour Name', (isset($fields['tourID']['language'])? $fields['tourID']['language'] : array())) }}</strong></td>
						<td>{{ \App\Library\SiteHelpers::formatLookUp($row->tourID,'tourID','1:tours:tourID:tour_name') }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Tour Code', (isset($fields['tour_code']['language'])? $fields['tour_code']['language'] : array())) }}</strong></td>
						<td>{{ $row->tour_code}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Definite', (isset($fields['definite_departure']['language'])? $fields['definite_departure']['language'] : array())) }}</strong></td>
						<td>{{ LeoTalay::Definite_departure($row->definite_departure) }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Start', (isset($fields['start']['language'])? $fields['start']['language'] : array())) }}</strong></td>
						<td>{{ \App\Library\SiteHelpers::TarihFormat($row->start)}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('End', (isset($fields['end']['language'])? $fields['end']['language'] : array())) }}</strong></td>
						<td>{{ \App\Library\SiteHelpers::TarihFormat($row->end)}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Guide', (isset($fields['guideID']['language'])? $fields['guideID']['language'] : array())) }}</strong></td>
						<td>{{ \App\Library\SiteHelpers::formatLookUp($row->guideID,'guideID','1:guides:guideID:name') }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Group Size', (isset($fields['total_capacity']['language'])? $fields['total_capacity']['language'] : array())) }}</strong></td>
						<td>{{ $row->total_capacity}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Currency', (isset($fields['currencyID']['language'])? $fields['currencyID']['language'] : array())) }}</strong></td>
						<td>{{ \App\Library\SiteHelpers::formatLookUp($row->currencyID,'currencyID','1:def_currency:currencyID:symbol|currency_name') }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Single Room Cost/ Traveller', (isset($fields['cost_single']['language'])? $fields['cost_single']['language'] : array())) }}</strong></td>
						<td>{{ $row->cost_single}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Double Room Cost/ Traveller', (isset($fields['cost_double']['language'])? $fields['cost_double']['language'] : array())) }}</strong></td>
						<td>{{ $row->cost_double}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Triple Room Cost / Traveller', (isset($fields['cost_triple']['language'])? $fields['cost_triple']['language'] : array())) }}</strong></td>
						<td>{{ $row->cost_triple}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Child Cost', (isset($fields['cost_child']['language'])? $fields['cost_child']['language'] : array())) }}</strong></td>
						<td>{{ $row->cost_child}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Available Optionals', (isset($fields['available_optionals']['language'])? $fields['available_optionals']['language'] : array())) }}</strong></td>
						<td>{{ \App\Library\SiteHelpers::formatLookUp($row->available_optionals,'available_optionals','1:def_optional_tours:optionaltourID:optional_tour') }} </td>

					</tr>

				</tbody>
			</table>
		</div>

  	</div>
  	@foreach($subgrid as $sub)
  	<div role="tabpanel" class="tab-pane" id="{{ str_replace(" ","_",$sub['title']) }}{{ $row->{$sub['master_key']} }}"></div>
  	@endforeach
  </div>
  </div>



@if($setting['form-method'] =='native')
	</div>
</div>
@endif

<script type="text/javascript">
	$(function(){
		<?php foreach($subgrid as $sub) { ?>
			$('#{{ str_replace(" ","_",$sub['title']) }}{{ $row->{$sub['master_key']} }}').load('{!! url($sub['module']."/lookup/".implode("-",$sub)."-".$row->{$sub['master_key']})!!}')
		<?php } ?>


	})

</script>
