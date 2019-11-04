<div class="col-md-3" id="sidebar">
 <div class="theiaStickySidebar">
    <div class="box box-solid">
        <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked">
                <li @if($active=='' ) class="active" @endif><a href="{{ URL::to('core/config/')}}"><i class="fa fa-gear fa-fw fa-2x"></i> {{ Lang::get('core.t_generalsetting') }}</a></li>
                <li @if($active=='security' ) class="active" @endif><a href="{{ URL::to('core/config/security')}}"><i class="fa fa-unlock fa-fw fa-2x"></i> {{ Lang::get('core.sitesettings') }}</a></li>
                <li @if($active=='users' ) class="active" @endif><a href="{{ URL::to('core/users/')}}"><i class="fa fa-user fa-fw fa-2x"></i> {{ Lang::get('core.m_users') }}</a></li>
                <li @if($active=='groups' ) class="active" @endif><a href="{{ URL::to('core/groups/')}}"><i class="fa fa-users fa-fw fa-2x"></i> {{ Lang::get('core.m_groups') }}</a></li>
                <li @if($active=='menu' ) class="active" @endif><a href="{{ URL::to('core/menu')}}"><i class="fa fa-bars fa-fw fa-2x"></i> {{ Lang::get('core.m_menu') }}</a></li>
                <li @if($active=='blast' ) class="active" @endif><a href="{{ URL::to('core/users/blast')}}"><i class="fa fa-at fa-fw fa-2x"></i> {{ Lang::get('core.m_blastemail') }}</a></li>
                <li @if($active=='email' ) class="active" @endif><a href="{{ URL::to('core/config/email')}}"><i class="fa fa-envelope fa-fw fa-2x"></i> {{ Lang::get('core.t_emailtemplate') }}</a></li>
                <li @if($active=='translation' ) class="active" @endif><a href="{{ URL::to('core/config/translation')}}"><i class="fa fa-language fa-fw fa-2x"></i> {{ Lang::get('core.tab_translation') }}</a></li>
                <li @if($active=='userlogs' ) class="active" @endif><a href="{{ URL::to('log')}}"><i class="fa fa-code fa-fw fa-2x"></i> {{ Lang::get('core.m_logs') }}</a></li>
                <li @if($active=='log' ) class="active" @endif><a href="{{ URL::to('core/config/clearlog')}}" class="clearCache"><i class="fa fa-refresh fa-fw fa-2x"></i> {{ Lang::get('core.m_clearcache') }}</a></li>
            </ul>
        </div>
    </div>
</div>
</div>
	<script>
		jQuery('#sidebar').theiaStickySidebar({
			additionalMarginTop: 70
		});
	</script>
