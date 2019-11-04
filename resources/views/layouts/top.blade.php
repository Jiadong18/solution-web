<?php
$reviews  = \DB::table('testimonials')->where('status', '=', '0')->count();
$support  = \DB::table('tbl_tickets')->where('status', '=', 'New')->count();
$comments = \DB::table('tb_comments')->where('approved', '=', '0')->count();
?>
<header class="main-header">
    <a href="{{ url('')}}" target="_blank" class="logo">
        <span class="logo-mini">
        <img src="{{ asset('mmb/images/MMB-Logo.png') }}" width="40px" />
      </span>
        <span class="logo-lg">
        <img src="{{ asset('mmb/images/MMB-Logo.png')}}" width="50px" />
      </span>
    </a>
    <nav class="navbar navbar-static-top">
    <div class="header-link pull-left"><i class="fa fa-bars fa-lg" data-toggle="offcanvas"></i></div>
    <div class="header-link tips" title="Dashboard" data-placement="bottom"><a href="{{ url('dashboard')}}"><i class="fa fa-dashboard fa-lg"></i></a></div>
    <div class="header-link tips" title="{{ Lang::get('core.calendar1') }}" data-placement="bottom"><a href="{{ url('calendar')}}"><i class="fa fa-calendar fa-lg"></i></a></div>
            @if(Session::get('gid') ==1)
        <div class="header-link pull-right"><a href="{{ url('user/logout')}}" class="tips" title="{{ Lang::get('core.m_logout') }}"  data-placement="bottom" ><i class="fa fa-power-off fa-lg" aria-hidden="true"></i></a></div>
        <div class="header-link pull-right"><a href="#" data-toggle="control-sidebar" class="tips" title="{{ Lang::get('core.dash_i_setting') }}"  data-placement="bottom" ><i class="fa fa-gear fa-lg" aria-hidden="true"></i></a></div>
@endif
                @if(CNF_MULTILANG ==1)
                <div class="header-link pull-right">

                    <?php
          $flag ='en';
          $langname = 'English';
          foreach(\App\Library\SiteHelpers::langOption() as $lang):
            if($lang['folder'] == Session::get('lang') or $lang['folder'] == 'CNF_LANG') {
              $flag = $lang['folder'];
              $langname = $lang['name'];
            }
          endforeach;?>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img class="flag-lang" src="{{ asset('mmb/images/flags/'.$flag.'.png') }}" width="16" height="12" alt="lang" /> {{ strtoupper($flag) }}
                        <span class="hidden-xs">
             <i class="fa fa-caret-down"></i>
            </span>
                    </a>
                    <ul class="dropdown-menu icons-right animated flipInX">
                        <li class="header"> {{ Lang::get('core.m_sel_lang') }} </li>
                        @foreach(\App\Library\SiteHelpers::langOption() as $lang)
                        <li>
                            <a href="{{ URL::to('home/lang/'.$lang['folder'])}}"><img class="flag-lang" src="{{ asset('mmb/images/flags/'. $lang['folder'].'.png')}}" width="16" height="11" alt="lang" /> {{ $lang['name'] }}</a>
                        </li>
                        @endforeach
                    </ul>
                            </div>

                    @endif

        @if(Session::get('gid') ==1)
            <div class="header-link tips pull-right" title="{{ Lang::get('core.support') }}" data-placement="bottom">
                <a href="{{ url('support')}}">
        <i class="fa fa-life-ring fa-lg" aria-hidden="true"></i><span class="label label-danger">@if ($support!='0') {{$support }} @endif</span>
                </a>
        </div>
    <div class="header-link tips pull-right" title="{{ Lang::get('core.reviews') }}" data-placement="bottom">
        <a href="{{ url('testimonials')}}">
                      <i class="fa fa-star-half-o fa-lg"  aria-hidden="true"></i><span class="label label-danger">@if ($reviews!='0') {{$reviews }} @endif</span>
                    </a></div>
    <div class="header-link tips pull-right" title="{{ Lang::get('core.blogcomments') }}" data-placement="bottom"><a href="{{ url('commentscheck')}}">
                      <i class="fa fa-comments fa-lg" aria-hidden="true"></i>
 <span class="label label-danger">@if ($comments!='0') {{$comments }} @endif</span>
                    </a></div>
        <div class="header-link tips pull-right " title="CMS" data-placement="bottom">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="true">
                        <i class="fa fa-keyboard-o fa-lg"></i>
                    </a>

                    <div class="dropdown-menu hdropdown bigmenu animated flipInX">
                        <table>
                            <tbody>
                            <tr>
                                <td>
                                    <a href="{{ url('core/pages')}}">
                                        <i class="fa fa-newspaper-o fa-lg fa-fw text-yellow"></i>
                                        <h5>Pages</h5>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ url('core/posts')}}">
                                        <i class="fa fa-rss-square fa-lg fa-fw text-blue"></i>
                                        <h5>Blog</h5>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="{{ url('faqs')}}">
                                        <i class="fa fa-question-circle fa-lg fa-fw text-red"></i>
                                        <h5>FAQ</h5>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ url('core/forms')}}">
                                        <i class="fa fa-list fa-lg fa-fw text-green"></i>
                                        <h5>Forms</h5>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

        </div>

        @endif




    </nav>
</header>
