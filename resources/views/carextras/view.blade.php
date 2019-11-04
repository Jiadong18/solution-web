@if($setting['view-method'] =='native')
<div class="box box-primary">
	<div class="box-header with-border">

		<div class="box-header-tools pull-left" >
			@if($access['is_add'] ==1)
	   		<a href="{{ url('carextras/update/'.$id.'?return='.$return) }}" class="tips btn btn-default btn-xs " title="{{ Lang::get('core.btn_edit') }}" onclick="ajaxViewDetail('#carextras',this.href); return false; "><i class="fa  fa-edit fa-2x"></i></a>
			@endif
			<a href="{{ url('carextras/show/'.$id.'?&print=true&return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_print') }}" onclick="ajaxPopupStatic(this.href); return false;"><i class="fa  fa-print"></i></a>
		</div>

		<div class="box-header-tools pull-right " >
			<a href="{{ ($prevnext['prev'] != '' ? url('carextras/show/'.$prevnext['prev'].'?return='.$return ) : '#') }}" class="tips" onclick="ajaxViewDetail('#carextras',this.href); return false; "><i class="fa fa-arrow-left fa-2x"></i>  </a>
			<a href="{{ ($prevnext['next'] != '' ? url('carextras/show/'.$prevnext['next'].'?return='.$return ) : '#') }}" class="tips" onclick="ajaxViewDetail('#carextras',this.href); return false; "> <i class="fa fa-arrow-right fa-2x"></i>  </a>
			<a href="javascript:void(0)" class="collapse-close tips btn btn-default btn-xs" onclick="ajaxViewClose('#{{ $pageModule }}')">
			<i class="fa fa-remove"></i></a>
		</div>
	 </div>

	<div class="box-body">
@endif

		<table class="table  table-bordered" >
			<tbody>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{Lang::get('core.id')}}</strong></td>
						<td>{{ $row->carsextrasID}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{Lang::get('core.extraname')}}</strong></td>
						<td>{{ $row->name}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{Lang::get('core.price')}}</strong></td>
						<td>{{ $row->price}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{Lang::get('core.currency')}}</strong></td>
						<td>{{ \App\Library\SiteHelpers::formatLookUp($row->currency,'currency','1:def_currency:currencyID:currency_sym|symbol') }} </td>

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
