<div class="box box-solid collapsed-box">
		<div class="box-header-tools pull-left" >
			@if($access['is_add'] ==1)
	   		<a href="{{ url($pageModule .'/update?return='.$return) }}" class="tips text-green"  title="{{ Lang::get('core.btn_create') }} ">
			<i class="fa fa-plus-square-o fa-2x"></i></a>
			@endif
			@if($access['is_clone'] ==1)
            <a href="javascript://ajax" class="tips copy text-blue" title="{{ Lang::get('core.btn_copy') }} " ><i class="fa fa-copy fa-2x" data-toggle="confirmation" data-title="{{Lang::get('core.rusure')}}"  data-content="{{ Lang::get('core.rusureyouwanttocopythis') }}" ></i></a>
			@endif
			@if($access['is_remove'] ==1)
			<a href="javascript://ajax"  onclick="MmbDelete();" class="tips text-red" title="{{ Lang::get('core.btn_remove') }}">
			<i class="fa fa-trash-o fa-2x" data-toggle="confirmation" data-title="{{Lang::get('core.rusure')}}"  data-content="{{ Lang::get('core.rusuredelete') }}" ></i></a>
			@endif
            @if($access['is_excel'] ==1)
		    <a class="dropdown-toggle tips" data-toggle="dropdown" href="#" title="{{ Lang::get('core.btn_download') }}"><i class="fa fa-cloud-download fa-2x"></i></a>
			<ul class="dropdown-menu  pull-right ">
				<li><a href="{{ url( $pageModule .'/export/excel?return='.$return) }}" class="tips "  title="Excel"><i class="fa fa-file-excel-o fa-2x"></i> Excel </a></li>
				<li><a href="{{ url( $pageModule .'/export/word?return='.$return) }}" class="tips "  title="Word"><i class="fa fa-file-word-o fa-2x"></i> Word </a></li>
				<li><a href="{{ url( $pageModule .'/export/csv?return='.$return) }}" class="tips " title="CSV"><i class="fa fa-file-code-o fa-2x"></i> CSV </a></li>
				<li><a href="{{ url( $pageModule .'/export/print?return='.$return) }}" class="tips " onclick="ajaxPopupStatic(this.href); return false;" ><i class="fa fa-print fa-2x"></i> {{ Lang::get('core.btn_print') }} </a></li>
				<li><a href="{{ url( $pageModule .'/export/pdf?return='.$return) }}" class="tips " title="PDF"><i class="fa  fa-file fa-2x"></i> PDF </a></li>
				<li class="divider"></li>
				<li><a href="{{url( $pageModule .'/expotion?return='.$return) }}" class="tips " onclick="MmbModal(this.href,'Download Option'); return false" ><i class="fa  fa-cog fa-2x"></i> {{ Lang::get('core.moreoption') }} </a></li>
			</ul>
		@endif
		</div>

		<div class="box-header-tools pull-right" >
        @if (CNF_SHOWHELP == 'ON')
		  <a href="#"> <i class="fa fa-question-circle fa-2x tips" title="{{ Lang::get('core.help') }}" data-widget="collapse"></i></a>
        @endif
            @if(Session::get('gid') ==1)
		  <a href="{{ url( 'mmb/module/permission/'.$pageModule) }}"> <i class="fa fa-lock fa-2x tips" title="{{ Lang::get('core.permissionsettings') }}"></i></a>
            @endif
		</div>
        @if (CNF_SHOWHELP == 'ON')
        <div class="box-body col-xs-12" style="display: none;">
		  @include( 'mmb/help/'.$pageModule)
        </div>
        @endif

</div>

<script>
$(document).ready(function() { 
	 
    $('[data-toggle=confirmation]').confirmation({
    rootSelector: '[data-toggle=confirmation]',
    container: 'body'
  });
});

</script>