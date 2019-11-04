@if($setting['view-method'] =='native')
<div class="box box-primary">
	<div class="box-header with-border">

		<div class="box-header-tools pull-left" >
			@if($access['is_add'] ==1)
	   		<a href="{{ url('commentscheck/update/'.$id.'?return='.$return) }}" class="tips btn btn-default btn-xs " title="{{ Lang::get('core.btn_edit') }}" onclick="ajaxViewDetail('#commentscheck',this.href); return false; "><i class="fa  fa-edit fa-2x"></i></a>
			@endif
			<a href="{{ url('commentscheck/show/'.$id.'?&print=true&return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_print') }}" onclick="ajaxPopupStatic(this.href); return false;"><i class="fa  fa-print"></i></a>
		</div>

		<div class="box-header-tools pull-right " >
			<a href="{{ ($prevnext['prev'] != '' ? url('commentscheck/show/'.$prevnext['prev'].'?return='.$return ) : '#') }}" class="tips" onclick="ajaxViewDetail('#commentscheck',this.href); return false; "><i class="fa fa-arrow-left fa-2x"></i>  </a>
			<a href="{{ ($prevnext['next'] != '' ? url('commentscheck/show/'.$prevnext['next'].'?return='.$return ) : '#') }}" class="tips" onclick="ajaxViewDetail('#commentscheck',this.href); return false; "> <i class="fa fa-arrow-right fa-2x"></i>  </a>
			<a href="javascript:void(0)" class="collapse-close tips btn btn-default btn-xs" onclick="ajaxViewClose('#{{ $pageModule }}')">
			<i class="fa fa-remove"></i></a>
		</div>
	 </div>

	<div class="box-body">
@endif

		<table class="table  table-bordered" >
			<tbody>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('PageID', (isset($fields['pageID']['language'])? $fields['pageID']['language'] : array())) }}</strong></td>
						<td>{{ \App\Library\SiteHelpers::formatLookUp($row->pageID,'pageID','1:tb_pages:pageID:title') }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('UserID', (isset($fields['userID']['language'])? $fields['userID']['language'] : array())) }}</strong></td>
						<td>{{ \App\Library\SiteHelpers::formatLookUp($row->userID,'userID','1:tb_users:id:username') }} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Comments', (isset($fields['comments']['language'])? $fields['comments']['language'] : array())) }}</strong></td>
						<td>{{ $row->comments}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Posted', (isset($fields['posted']['language'])? $fields['posted']['language'] : array())) }}</strong></td>
						<td>{{ $row->posted}} </td>

					</tr>

					<tr>
						<td width='30%' class='label-view text-right'><strong>{{ \App\Library\SiteHelpers::activeLang('Approved', (isset($fields['approved']['language'])? $fields['approved']['language'] : array())) }}</strong></td>
						<td>{{ $row->approved}} </td>

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
