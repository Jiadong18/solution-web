@if($setting['view-method'] =='native')
<div class="box box-primary">
	<div class="box-header with-border">

		<div class="box-header-tools pull-left" >
			@if($access['is_add'] ==1)
	   		<a href="{{ url('testimonials/update/'.$id.'?return='.$return) }}" class="tips btn btn-default btn-xs " title="{{ Lang::get('core.btn_edit') }}" onclick="ajaxViewDetail('#testimonials',this.href); return false; "><i class="fa  fa-edit fa-2x"></i></a>
			@endif
			<a href="{{ url('testimonials/show/'.$id.'?&print=true&return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_print') }}" onclick="ajaxPopupStatic(this.href); return false;"><i class="fa  fa-print"></i></a>
		</div>

		<div class="box-header-tools pull-right " >
			<a href="{{ ($prevnext['prev'] != '' ? url('testimonials/show/'.$prevnext['prev'].'?return='.$return ) : '#') }}" class="tips" onclick="ajaxViewDetail('#testimonials',this.href); return false; "><i class="fa fa-arrow-left fa-2x"></i>  </a>
			<a href="{{ ($prevnext['next'] != '' ? url('testimonials/show/'.$prevnext['next'].'?return='.$return ) : '#') }}" class="tips" onclick="ajaxViewDetail('#testimonials',this.href); return false; "> <i class="fa fa-arrow-right fa-2x"></i>  </a>
			<a href="javascript:void(0)" class="collapse-close tips btn btn-default btn-xs" onclick="ajaxViewClose('#{{ $pageModule }}')">
			<i class="fa fa-remove"></i></a>
		</div>
	 </div>

	<div class="box-body">
@endif

		<table class="table  table-bordered" >
			<tbody>


					<tr>
						<td width='40%' class='label-view text-right'></td>
						<td>{!! \App\Library\SiteHelpers::formatRows($row->image,$fields['image'],$row ) !!} </td>

					</tr>

					<tr>
						<td width='40%' class='label-view text-right'><strong>{{ Lang::get('core.testimonial') }}</strong></td>
						<td>{{ $row->testimonial}} </td>

					</tr>


					<tr>
						<td width='40%' class='label-view text-right'><strong>{{ Lang::get('core.created') }}</strong></td>
						<td>{{ \App\Library\SiteHelpers::TarihFormat($row->created_at)}} </td>

					</tr>
@if($row->updated_at!=NULL)
					<tr>
						<td width='40%' class='label-view text-right'><strong>{{ Lang::get('core.updated') }}</strong></td>
						<td>{{ \App\Library\SiteHelpers::TarihFormat($row->updated_at)}} </td>

					</tr>
@endif
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
