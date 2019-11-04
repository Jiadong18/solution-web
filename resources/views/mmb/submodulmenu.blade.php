<?php $definitions = \App\Library\SiteHelpers::menus('definitions') ;?>

<div class="col-md-3">
    <div class="box box-solid">
        <div class="box-body no-padding">
<ul class="nav nav-pills nav-stacked">
    @foreach ($definitions as $menu)

      @if($menu['module'] =='separator')
        <li class="header"> {{$menu['menu_name']}} </li>
      @else
          <li class="treeview @if(Request::segment(1) == $menu['module']) active @endif">
          <a
            @if($menu['menu_type'] =='external')
              href="{{ $menu['url'] }}"
            @else
              href="{{ URL::to($menu['module'])}}"
            @endif
          >
            <i class="{{$menu['menu_icons']}}"></i>
            <span>
              @if(CNF_MULTILANG ==1 && isset($menu['menu_lang']['title'][Session::get('lang')]))
                {{ $menu['menu_lang']['title'][Session::get('lang')] }}
              @else
                {{$menu['menu_name']}}
              @endif
            </span>
            @if(count($menu['childs']) > 0 )
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            @endif
          </a>
          <!--- LEVEL II -->
            @if(count($menu['childs']) > 0 )

              <ul class="treeview-menu">
               @foreach ($menu['childs'] as $menu2)
                <li @if(Request::segment(1) == $menu2['module']) class="active" @endif >
                  <a
                    @if($menu2['menu_type'] =='external')
                      href="{{ $menu2['url']}}"
                    @else
                      href="{{ url($menu2['module'])}}"
                    @endif
                  >
                  <i class="{{$menu2['menu_icons']}}"></i>
                  @if(CNF_MULTILANG ==1 && isset($menu2['menu_lang']['title'][Session::get('lang')]))
                    {{ $menu2['menu_lang']['title'][Session::get('lang')] }}
                  @else
                    {{$menu2['menu_name']}}
                  @endif
                   @if(count($menu2['childs']) > 0 )
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                   @endif
                </a>
                  <!-- LEVEL III -->

                    @if(count($menu2['childs']) > 0)
                    <ul class="treeview-menu">
                       @foreach ($menu2['childs'] as $menu3)
                            <li  @if(Request::segment(1) == $menu3['module']) class="active" @endif>
                                <a
                                  @if($menu3['menu_type'] =='external')
                                    href="{{ $menu3['url']}}"
                                  @else
                                    href="{{ url($menu3['module'])}}"
                                  @endif
                                >
                                <i class="{{$menu3['menu_icons']}}"></i>
                                @if(CNF_MULTILANG ==1 && isset($menu3['menu_lang']['title'][Session::get('lang')]))
                                  {{ $menu3['menu_lang']['title'][Session::get('lang')] }}
                                @else
                                  {{$menu3['menu_name']}}
                                @endif
                              </a>

                           </li>
                        @endforeach

                    </ul>
                     @endif
                  <!-- END LEVEL III -->
                </li>
                @endforeach
              </ul>
            @endif
            <!-- END LEVEL II -->
          </li>
          @endif
        @endforeach

    </ul>        </div>
    </div>
</div>
