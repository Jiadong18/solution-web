	<div class="box-header-tools pull-left" >
			@if($access['is_add'] ==1)
			{!! \App\Library\AjaxHelpers::buttonActionCreate($pageModule,$setting) !!}
			<a href="javascript://ajax" class="tips btn btn-default btn-xs" onclick="ajaxCopy('#{{ $pageModule }}','{{ $pageUrl }}')" title="{{ Lang::get('core.btn_copy') }}"><i class="fa  fa-copy"></i> {{ Lang::get('core.btn_copy') }}</a>
			@endif
			@if($access['is_remove'] ==1)
			<a href="javascript://ajax" class="tips btn btn-default btn-xs" title="{{ Lang::get('core.btn_remove') }}" onclick="ajaxRemove('#{{ $pageModule }}','{{ $pageUrl }}');"><i class="fa fa-trash-o"></i> {{ Lang::get('core.btn_remove') }}</a>
			@endif


	</div>
	<div class="box-header-tools pull-right" >

		<div class="pull-right">
		@if($access['is_excel'] ==1)
		<div class="btn-group">
		    <a class="dropdown-toggle  btn btn-default btn-xs" data-toggle="dropdown" href="#"><i class="fa fa-download"></i>
		     {{ Lang::get('core.btn_download') }}</a>
			<ul class="dropdown-menu  pull-right">
				<li><a href="{{ URL::to( $pageModule .'/export/pdf?return='.$return) }}" class="tips " title="PDF"><i class="fa  fa-file"></i> PDF </a></li>
				<li class="divider"></li>
				<li><a href="{{ URL::to( $pageModule .'/export/excel?return='.$return) }}" class="tips "  title="Excel"><i class="fa fa-file-excel-o"></i> Excel </a></li>
				<li><a href="{{ URL::to( $pageModule .'/export/word?return='.$return) }}" class="tips "  title="Word"><i class="fa fa-file-word-o"></i> Word </a></li>
				<li><a href="{{ URL::to( $pageModule .'/export/csv?return='.$return) }}" class="tips " title="CSV"><i class="fa fa-file-code-o"></i> CSV </a></li>
				<li><a href="{{ URL::to( $pageModule .'/export/print?return='.$return) }}" class="tips " onclick="ajaxPopupStatic(this.href); return false;" ><i class="fa  fa-print"></i> Print </a></li>
				<li><a href="{{ URL::to( $pageModule .'/expotion?return='.$return) }}" class="tips " onclick="MmbModal(this.href,'Download Option'); return false" ><i class="fa  fa-cog"></i> {{ Lang::get('core.moreoption') }} </a></li>
			</ul>
		</div>

		@endif
			<a href="javascript:void(0)" class=" tips btn btn-default btn-xs"  onclick="reloadData('#{{ $pageModule }}','travellersfiles/data?return={{ $return }}')"><i class="fa fa-refresh"></i> {{ Lang::get('core.reload') }}</a>
		</div>

	</div>
