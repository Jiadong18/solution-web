@php
 $menus = \App\Library\SiteHelpers::menus('top');

@endphp
			@foreach ($menus as $menu)
		      @if($menu['module'] =='separator')
		      @else
				<li class="nav-item @if(count($menu['childs'])> 0 ) dropdown active @endif"><!-- HOME -->
				 	<a
					@if($menu['menu_type'] =='external')
						class="nav-link" href="{{ URL::to($menu['url'])}}"
					@else
						class="nav-link" href="{{ URL::to($menu['module'])}}"
					@endif

					 @if(count($menu['childs']) > 0 ) class="nav-link dropdown-toggle" id="{{$menu['menu_name']}}-drop" data-toggle="dropdown" data-hover="dropdown" @endif>
				 		<i class="{{$menu['menu_icons']}}"></i>

						@if(CNF_MULTILANG ==1 && isset($menu['menu_lang']['title'][Session::get('lang')]) && $menu['menu_lang']['title'][Session::get('lang')]!='')
							{{ $menu['menu_lang']['title'][Session::get('lang')] }}
						@else
							{{$menu['menu_name']}}
						@endif
					</a>
					@if(count($menu['childs']) > 0)
                    <div class="dropdown-menu">
							@foreach ($menu['childs'] as $menu2)
                           @if(count($menu2['childs']) > 0) <div class="dropdown dropdown-submenu"> @endif

							 	@if($menu2['module'] =='separator')
						      	@else
									 	<a class="dropdown-item" @if(count($menu2['childs']) > 0)
id="{{$menu2['menu_name']}}-drop" data-toggle="dropdown" data-hover="dropdown" data-close-others="false" @endif
											@if($menu2['menu_type'] =='external')
												href="{{ URL::to($menu2['url'])}}"
											@else
												href="{{ URL::to($menu2['module'])}}"
											@endif

										>
											<i class="{{$menu2['menu_icons']}}"></i>
												@if(CNF_MULTILANG ==1 && isset($menu2['menu_lang']['title'][Session::get('lang')]))
													{{ $menu2['menu_lang']['title'][Session::get('lang')] }}
												@else
													{{$menu2['menu_name']}}
												@endif

										</a>
										@if(count($menu2['childs']) > 0)
                                        <div class="dropdown-menu" role="menu" aria-labelledby="{{$menu2['menu_name']}}-drop">
											@foreach($menu2['childs'] as $menu3)
													<a
														@if($menu3['menu_type'] =='external')
															href="{{ URL::to($menu3['url'])}}"
														@else
															href="{{ URL::to($menu3['module'])}}"
														@endif
													class="dropdown-item"
													>
														@if(CNF_MULTILANG ==1 && isset($menu3['menu_lang']['title'][Session::get('lang')]))
															{{ $menu3['menu_lang']['title'][Session::get('lang')] }}
														@else
															{{$menu3['menu_name']}}
														@endif
												</a>
											@endforeach
                                        </div>
										@endif

									@endif
                                						@if(count($menu2['childs']) > 0)</div>@endif

							@endforeach
				    </div>
					@endif

				</li>
				@endif
			@endforeach

