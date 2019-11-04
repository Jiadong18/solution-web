<?php
use App\Library\Markdown;
?>
@if(Session::has('messagetext'))
{!! Session::get('messagetext') !!}
@endif
<nav class="breadcrumb"> <a class="breadcrumb-item" href="{{ url('') }}">Home</a>  <span class="breadcrumb-item active"> Blog
</span> </nav>
<div id="content">
      <div class="container">
        <h2 class="title-divider">
          <span><span class="font-weight-normal text-muted">Blog</span></span>
          <small>Let us talk!</small>
        </h2>
        <div class="row">
          <!--Blog Roll Content-->
          <div class="col-md-9 blog-roll blog-list">
            <!-- Blog post -->
            @foreach ($rowData as $row)
            <div class="row blog-post">
              <div class="col-md-1 date-md">
                <!-- Date desktop -->
                <div class="date-wrapper"> <span class="date-m bg-primary">{{ date( "M" ,strtotime($row->created))}}</span> <span class="date-d">{{ date( "d" ,strtotime($row->created))}}</span> </div>
                <!-- Meta details desktop -->
              </div>
              <div class="col-md-11">
                <div class="tags"> <?php $clouds = explode(',',$row->labels); ?>
                    @foreach($clouds as $tag)
                      <a href="{{ url('blog/label/'.$tag) }}" class="badge badge-primary">{!! $tag !!}</a>
                    @endforeach
                  </div>
                <h4 class="title media-heading">
                  <a href="{{ url('blog/view/'.$row->pageID.'/'.$row->alias)}}">{{ $row->title }}</a>
                </h4>
                <!-- Meta details mobile -->
                <ul class="list-inline meta text-muted">
                  <li class="list-inline-item"><i class="fa fa-calendar"></i> {{ \App\Library\SiteHelpers::TarihFormat($row->created)}}</li>
                </ul>
                <div class="row">
                  <div class="col-md-4 push-md-8">
                    <div class="blog-media">
                      <a href="{{ url('blog/view/'.$row->pageID.'/'.$row->alias)}}">
                        <img src="{{ asset('uploads/images/')}}/{{ $row->image != NULL ? $row->image : 'no-image-blog.png'}}" alt="" class="img-fluid img-thumbnail" />
                      </a>
                    </div>
                  </div>
                  <div class="col-md-8 pull-md-4">
                    <p>{!! str_limit($row->note, $limit = 250, $end = '....') !!}</p>
                    <ul class="list-inline links">
                      <li class="list-inline-item">
                        <a href="{{ url('blog/view/'.$row->pageID.'/'.$row->alias)}}" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-circle-right"></i> Read more</a>
                      </li>
                        @if($conpost['commsys'] ==1)
                      <li class="list-inline-item">
                        <a href="{{ url('blog/view/'.$row->pageID.'/'.$row->alias)}}#comments" class="btn btn-secondary btn-sm"><i class="fa fa-comment"></i> {{ $row->comments }} comment(s)</a>
                      </li>@endif
                      <li class="list-inline-item">
                        <a href="{{ url('blog/view/'.$row->pageID.'/'.$row->alias)}}" class="btn btn-secondary btn-sm"><i class="fa fa-eye"></i> {{ $row->views }} views</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          <!--Sidebar-->
          <div class="col-md-3 sidebar-right">
                      <div data-toggle="sticky" data-settings='{"parent":"#content","mind":"#header", "top":10, "breakpoint":480}'>

            <!-- @Element: Search form -->
<!--            <div class="mb-4">
              <form role="form">
                <div class="input-group">
                  <label class="sr-only" for="search-field">Search</label>
                  <input type="search" class="form-control" id="search-field" placeholder="Search">
                  <span class="input-group-btn">
                    <button class="btn btn-secondary" type="button">Go!</button>
                  </span>
                </div>
              </form>
            </div>-->

            <!-- @Element: badge cloud -->
            <div class="mb-4">
              <h4 class="title-divider">
                <span>tags</span>
              </h4>
              <div class="tag-cloud">
                    {!! \App\Library\PostHelpers::cloudtags() !!}
              </div>
            </div>
            <!-- @Element: Popular/recent tabs -->
        @if($conpost['commlatest'] ==1 OR $conpost['commpopular'] ==1)
        <div class="mb-4">
              <ul class="nav nav-tabs">
        @if($conpost['commlatest'] ==1)
       <li class="nav-item"><a href="#latest" class="nav-link active" data-toggle="tab">Latest</a></li>@endif
        @if($conpost['commpopular'] ==1)
        <li class="nav-item"><a href="#popular" class="nav-link" data-toggle="tab">Popular</a></li>@endif
              </ul>
              <div class="tab-content tab-content-bordered">
                @if($conpost['commlatest'] ==1)
                  <div class="tab-pane fade show active blog-roll-mini" id="latest">
                  <div class="row blog-post">
                        @include('layouts.leo.blog.latest',array("conpost"=>$conpost))
                  </div>
                </div>
                @endif
                @if($conpost['commpopular'] ==1)
                  <div class="tab-pane fade blog-roll-mini" id="popular">
                  <div class="row blog-post">
                        @include('layouts.leo.blog.popular',array("conpost"=>$conpost))
                  </div>
                </div>
                @endif
              </div>
            </div>
            @endif
            <div class="mb-4">
              <h4 class="title-divider">
                <span>Follow Us On</span>
              </h4>
              <ul class="list-unstyled social-media-branding">
      @if (CNF_FACEBOOK !='')   <a href="{{ CNF_FACEBOOK }}" target="_blank"    class="social-link branding-facebook"> <i class="fa fa-facebook-square fa-fw"></i></a>@endif
      @if (CNF_TWITTER !='')   <a href="{{ CNF_TWITTER }}"  target="_blank"    class="social-link branding-facebook"> <i class="fa fa-twitter-square fa-fw"></i></a>@endif
      @if (CNF_INSTAGRAM !='')   <a href="{{ CNF_INSTAGRAM }} " target="_blank"  class="social-link branding-facebook"> <i class="fa fa-instagram fa-fw"></i></a>@endif
      @if (CNF_TRIPADVISOR !='')   <a href="{{ CNF_TRIPADVISOR }}" target="_blank" class="social-link branding-facebook"> <i class="fa fa-tripadvisor fa-fw"></i></a>@endif

              </ul>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
      <div class="container text-center">

                <nav aria-label="Page navigation">
                                    <ul class="pagination">
               {!! $blog = DB::table('tb_pages')->where('pagetype', '=' ,'post')->where('status', '=' ,'enable')->where('allow_guest', '=' ,'1')->paginate( !is_null($conpost['commperpage']) ? $conpost['commperpage']  : '5' ) !!}
                    </ul>
                </nav>
</div>
