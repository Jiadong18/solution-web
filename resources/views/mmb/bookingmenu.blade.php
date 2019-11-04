<?php
$tours   = \App\Library\SiteHelpers::BookingNumber('tour') ;
$hotels  = \App\Library\SiteHelpers::BookingNumber('hotel') ;
$flights = \App\Library\SiteHelpers::BookingNumber('flight') ;
$cars    = \App\Library\SiteHelpers::BookingNumber('car') ;
$extras  = \App\Library\SiteHelpers::BookingNumber('extra') ;
?>
<div class="col-md-12 text-center">
          <a href="booktour" class="btn button-justify btn-app">
                @if($tours!=0)
<span class="badge bg-red">{{ $tours }}</span>
              @endif
                <i class="fa fa-bus fa-2x"></i> {{ Lang::get('core.tours') }}
              </a>
          <a href="bookhotel"class="btn btn-app">
            @if($hotels!=0)
                <span class="badge bg-red">{{$hotels}}</span>
              @endif
                <i class="fa fa-bed fa-2x"></i> {{ Lang::get('core.hotels') }}
              </a>
          <a href="bookflight"class="btn btn-app">
              @if($flights!=0)
                <span class="badge bg-red">{{$flights}}</span>
              @endif
                <i class="fa fa-plane fa-2x"></i> {{ Lang::get('core.flights') }}
              </a>
          <a href="bookcar"class="btn btn-app">
              @if($cars!=0)
                <span class="badge bg-red">{{$cars}}</span>
              @endif
                <i class="fa fa-car fa-2x"></i> {{ Lang::get('core.cars') }}
              </a>
          <a href="bookextra"class="btn btn-app">
              @if($extras!=0)
                <span class="badge bg-red">{{$extras}}</span>
              @endif
                <i class="fa fa-gift fa-2x"></i> {{ Lang::get('core.extras') }}
              </a>
      </div>
