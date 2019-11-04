<?php
use App\Http\Controllers\ToursController;
?>
<script src="{{ URL::asset('mmb/js/jquery-2.2.3.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('mmb/js/jCombo.js') }}"></script>
<nav class="breadcrumb"> <a class="breadcrumb-item" href="{{ url('') }}">Home</a> <a class="breadcrumb-item" href="{{ url('trips') }}">Tours</a> <a class="breadcrumb-item" href="{{ url('trips?cat='.$row->tourcategoriesID) }}">{{ \App\Library\SiteHelpers::formatLookUp($row->tourcategoriesID,'tourcategoriesID','1:def_tour_categories:tourcategoriesID:tourcategoryname') }}</a> <span class="breadcrumb-item active">{{ $row->tour_name}}</span> </nav>
<div class="container py-2">
<ul class="parsley-error-list">
	@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
	@endforeach
</ul>

@if(Session::has('message'))
		{!! Session::get('message') !!}
@endif

          <h2 class="text-uppercase text-letter-spacing-l my-0 text-inverse font-weight-bold">
            <img class="rounded img-fluid float-left mx-3 my-3" src="@if(file_exists(public_path().'/uploads/images/'.$row->tourimage) && $row->tourimage !='')
        {{ asset('uploads/images/'.$row->tourimage)}}
        @else
        {{ asset('mmb/images/tour-noimage.jpg')}}
        @endif " alt="{{$row->tour_name}}"><span>{{ $row->tour_name }}</span></h2><br><h4>{{ \App\Library\SiteHelpers::formatLookUp($row->tourcategoriesID,'tourcategoriesID','1:def_tour_categories:tourcategoriesID:tourcategoryname') }} - <small>{{ $row->total_days}} Days - {{ $row->total_nights}} Nights</small></h4>

                      {!! $row->tour_description !!}

          <hr class="hr-primary w-15 hr-xl ml-0 mb-5">
          <!-- Days tabs -->
          <ul class="nav nav-pills nav-pills-flat nav-justified flex-row" role="tablist" data-toggle="scrollbar" tabindex="0" style="overflow: hidden; outline: none; cursor: -webkit-grab;">
            <li class="nav-item"> <a class="nav-link text-center text-uppercase font-weight-bold px-3 px-lg-4 py-3 active" data-toggle="pill" href="#itinerary" role="tab" aria-expanded="true">Itinerary</a> </li>
            <li class="nav-item"> <a class="nav-link text-center text-uppercase font-weight-bold px-3 px-lg-4 py-3" data-toggle="pill" href="#included" role="tab" aria-expanded="false">Included</a> </li>
            <li class="nav-item"> <a class="nav-link text-center text-uppercase font-weight-bold px-3 px-lg-4 py-3" data-toggle="pill" href="#tourdates" role="tab" aria-expanded="false">@if($row->departs == 3)Tour Dates @else Booking Form @endif</a> </li>
            <li class="nav-item"> <a class="nav-link text-center text-uppercase font-weight-bold px-3 px-lg-4 py-3" data-toggle="pill" href="#tourgallery" role="tab" aria-expanded="false">Tour Gallery</a> </li>
            <li class="nav-item"> <a class="nav-link text-center text-uppercase font-weight-bold px-3 px-lg-4 py-3" data-toggle="pill" href="#tandc" role="tab" aria-expanded="false">Terms&Conditions</a> </li>

          </ul>
          <!-- Days -->
          <div class="tab-content">
            <div class="tab-pane py-4 active" id="itinerary" aria-expanded="true">
        <div id="content">
      <div class="container" id="about">
        <div class="timeline timeline-left">
                  			@foreach($dayTree as $dt)

            <div class="timeline-breaker">{{ Lang::get('core.day') }} {{ $dt['day'] }}</div>
          <!--Timeline item 1-->


          <div class="timeline-item animated fadeIn de-02">
            <div class="timeline-item-date">{{ $dt['title'] }}</div>
            <p class="timeline-item-description">{!! $dt['description'] !!}</p>
            @if($dt['siteID']!=NULL)<p class="timeline-item-description"><i class="fa fa-globe fa-lg fa-fw" data-toggle="tooltip" title="Places to visit" aria-hidden="true"></i>  {!! ToursController::placesToVisit($dt['siteID']) !!}
             </p>@endif
@if($dt['hotelID']!=NULL)
                <p class="timeline-item-description"><i class="fa fa-bed fa-lg fa-fwtips" data-toggle="tooltip" title="Accomodation" aria-hidden="true"></i>
  {{ \App\Library\SiteHelpers::formatLookUp($dt['hotelID'],'hotelID','1:hotels:hotelID:hotel_name') }} {{ \App\Library\SiteHelpers::formatLookUp($dt['cityID'],'cityID','1:def_city:cityID:city_name') }}</p>
                  @endif
                @if($dt['meal']!=NULL)
                <p class="timeline-item-description "><i class="fa fa-cutlery fa-lgfa-fw" data-toggle="tooltip" title="Meals"aria-hidden="true"></i>  {{ $dt['meal']}} </p>
                @endif
                @if($dt['optionaltourID']!=NULL)<p class="timeline-item-description "><i class="fa fa-institution fa-lg fa-fw" aria-hidden="true" data-toggle="tooltip" title="Optional Tours"></i> {!! ToursController::optionalTours($dt['optionaltourID']) !!} </p>
                @endif
          </div>
            <br>
                @endforeach
          <div class="timeline-breaker timeline-breaker-bottom">End of the tour.......</div>
        </div>
      </div>
    </div>
        </div>
            <div class="tab-pane py-4" id="included" aria-expanded="false">
                 <ul class="list-group list-group-striped">{!! \App\Library\SiteHelpers::showInclusions($row->inclusions) !!}</ul>
            </div>
             <div class="tab-pane py-4" id="tourdates" aria-expanded="false">
                 @if($row->departs == 3)
                 <div class="p-0 p-lg-2 d-lg-flex justify-content-start align-items-center">
                  <p class="d-none d-md-inline-block w-lg-20 my-0 mr-lg-4">TOUR CODE</p>
                  <p class="d-md-inline-block w-70 w-lg-20 my-0 mr-lg-1 font-weight-bold">
                    START
                    </p>
                  <p class="d-md-inline-block w-70 w-lg-20 my-0 mr-lg-1 font-weight-bold">
                    END
                    </p>
                    <div class="w-30 w-lg-30 mb-2 mb-lg-0">
TOUR CAPACITY                    </div>
                  </div>

                 @foreach($tdate as $td)
<div class="p-0 p-lg-2 d-lg-flex justify-content-start align-items-center">
                  <p class="d-none d-md-inline-block w-lg-20 my-0 mr-lg-4">{{ $td['tour_code'] }}</p>
                  <p class="d-md-inline-block w-70 w-lg-20 my-0 mr-lg-1 font-weight-bold">
                    {{ \App\Library\SiteHelpers::TarihFormat($td['start']) }}
                    </p>
                  <p class="d-md-inline-block w-70 w-lg-20 my-0 mr-lg-1 font-weight-bold">
                    {{ \App\Library\SiteHelpers::TarihFormat($td['end']) }}
                    </p>
                    <div class="progress w-30 w-lg-30 mb-2 mb-lg-0" data-toggle="tooltip" data-placement="top" title="30 spaces left in class">
                      <div class="progress-bar w-25 progress-bar-md bg-pink py-2" role="progressbar" aria-valuenow="{!! \App\Library\GeneralStatuss::tourCapacity($td['tourID'] , $td['total_capacity'] ) !!}
" aria-valuemin="0" aria-valuemax="{{$td['total_capacity']}}"></div>
                    </div>
                    <a class="btn btn-outline-pink btn-rounded btn-sm text-xs px-3 py-1 text-uppercase border-w-2 ml-auto" href="booknow?tourID={{ $td['tourID'] }}&tourdateID={{ $td['tourdateID'] }}">Book Now</a>
                  </div>
                  <hr />
                               @endforeach
                 @else
          <div class="row">
                <div class="col">
                 {!! FormHelpers::render(5) !!}
                 </div>
                         <div class="col">
                             <h4>Found your holiday and now you want to book it? </h4>
                             <p>You can contact your preferred travel agent to book now. Alternatively, you can use the form on the right, search for your nearest travel agent, or phone or email us and we’ll help you with your reservation today.</p>

                             <h4>Travel Agents</h4>
                             <p>To book your holiday, simply visit your local travel agent. They will answer your questions and assist you with choosing the perfect experience.</p>
                             <p>Your request will be processed within the next 24-48 hours and emailed to you. The information you have provided will only be used to allow us to process your booking/enquiry.</p>
                 </div>
                 </div>

                 @endif

              </div>
             <div class="tab-pane py-4" id="tourgallery" aria-expanded="false">
    @if($row->gallery!='')
                <div class="row no-gutters" data-toggle="magnific-popup" data-magnific-popup-settings='{"delegate": "a.gallery-trigger", "gallery":{"enabled":true}}'>

                    @foreach(explode(',', $row->gallery) as $image)
        <div class="col-6 col-lg-3">
            <div class="card-effect card-effect-front-to-back">
              <img src="data:image/gif;base64,R0lGODlhAQABAPAAAP///////yH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{{ asset('uploads/images/'.$image)}}" data-toggle="unveil" class="img-fluid" />
              <div class="card-back rounded bg-inverse bg-op-8 flex-valign text-center p-3">
                <a href="{{ asset('uploads/images/'.$image)}}" class="text-white gallery-trigger"> <i class="fa fa-eye icon-2x"></i> </a>
              </div>
            </div>
          </div>

                @endforeach
          </div>

@endif
             </div>
            <div class="tab-pane py-4" id="tandc" aria-expanded="false">
{!! \App\Library\SiteHelpers::formatLookUp($row->policyandterms,'policyandterms','1:termsandconditions:tandcID:tandc') !!}
            </div>

            </div>
    @if($row->similartours!=NULL)
    <?php $similartours = explode(',',$row->similartours); ?>
    <div class="container py-4">
        <hr class="hr-lg mt-0 mb-3 w-10 mx-auto hr-primary" />
        <h2 class="text-center text-uppercase font-weight-bold my-0">
          Similar Tours
        </h2>
        <hr class="mb-3 w-50 mx-auto" />
        <div class="mt-4 owl-nav-over owl-nav-over-lg" data-toggle="owl-carousel" data-owl-carousel-settings='{"responsive":{"0":{"items":1}, "600":{"items":2}, "980":{"items":4}}, "margin":10, "nav":true, "dots":false}'>
          <!-- Product 1 -->
        @foreach($similartours as $tour)
          <div class="card product-card overlay-hover">
            <!-- Hover content -->
            <div class="overlay-hover-content overlay-op-7 product-card-hover-tools">
              <h4 class="text-white">
                {{ \App\Library\SiteHelpers::formatLookUp($tour,'tourID','1:tours:tourID:tour_name')}}
              </h4>
            <a href="{{ url('trips?view='.$tour) }}" class="btn btn-primary text-uppercase font-weight-bold mb-2"><i class="fa fa-eye fa-2x"></i></a>


            </div>
            <!-- Image & price content -->
            <div class="pos-relative">
              <img class="card-img-top img-fluid" src="uploads/images/{{ \App\Library\SiteHelpers::formatLookUp($tour,'tourID','1:tours:tourID:tourimage')}}" alt="{{ \App\Library\SiteHelpers::formatLookUp($tour,'tourID','1:tours:tourID:tour_name')}}">
            </div>
          </div>
          @endforeach
        </div>
      </div>
    @endif
</div>

