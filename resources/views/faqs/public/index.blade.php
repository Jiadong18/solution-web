<nav class="breadcrumb"> <a class="breadcrumb-item" href="{{ url('') }}">Home</a>  <span class="breadcrumb-item active"> Frequentl Asked Questions
</span> </nav>
<div id="content">
      <div class="container">
        <h2 class="title-divider">
          <span>F. A. Q. </span>
        </h2>
        <div class="row">
          <!-- @Sidebar -->
          <div class="col-md-3">
            <div data-toggle="sticky" data-settings='{"parent":"#content","mind":"#header", "top":10, "breakpoint":480}'>
            <!-- Sections Menu-->
            <ul class="nav nav-section-menu mb-4 py-3">
              <li class="nav-header">Sections</li>
            @foreach($faqTree as $fs)
            <li><a href="#{{ $fs['sectionID'] }}" class="nav-link first"> <i class="fa fa-angle-right"></i> {{ $fs['title'] }}</a></li>
            @endforeach
            </ul>
          </div>
          </div>
          <div class="col-md-9">
            <p>You've got a Question?  We've got the Answer! Check out our FAQs.</p>            
              @foreach($faqTree as $fs)
				<div id="{{ $fs['sectionID'] }}"></div>
            <h4 class="mt-4">
              {{ $fs['title'] }}
            </h4>
            <div class="card-accordion card-accordion-list-style card-accordion-icons-left" id="accordion-list-style" role="tablist" aria-multiselectable="true">
				@foreach($fs['items'] as $item)
                <div class="card">
                <div class="card-header py-0 px-0" role="tab" id="headingOne2"> <a data-toggle="collapse" data-parent="#accordion-list-style" href="#{!! $item->id !!}" aria-expanded="true" aria-controls="{!! $item->sectionID !!}">{!! $item->question !!}</a> </div>
                <div id="{!! $item->id !!}" class="collapse in" role="tabpanel" aria-labelledby="heading{!! $item->sectionID !!}">
                  <div class="card-body">{!! $item->answer !!}</div>
                </div>
              </div>
				@endforeach
              </div>
              @endforeach

          </div>
        </div>
      </div>
    </div>
