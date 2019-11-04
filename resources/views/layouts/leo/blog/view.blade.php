<nav class="breadcrumb"> <a class="breadcrumb-item" href="{{ url('') }}">Home</a> <a class="breadcrumb-item" href="{{ url('blog') }}">Blog</a> <span class="breadcrumb-item active"> {{$row->title}}
</span> </nav><div id="content">
<?php $clouds = explode(',',$row->labels); ?>
    <div class="container">
        <div class="row">
          <!--Main Content-->
          <div class="col-md-9">
            <!-- Blog post -->
            <div class="row blog-post">
              <div class="col-md-1 date-md">
                <!-- Date desktop -->
                <div class="date-wrapper"> <span class="date-m bg-primary">{{ date( "M" ,strtotime($row->created))}}</span> <span class="date-d">{{ date( "d" ,strtotime($row->created))}}</span>
</div>
                <!-- Meta details desktop -->
              </div>
              <div class="col-md-11">
                <div class="media-body">
                  <h3 class="title media-heading">
                    {{$row->title}}
                  </h3>
                  <!-- Meta details mobile -->
                  <ul class="list-inline meta text-muted">
                    <li class="list-inline-item"><i class="fa fa-calendar"></i> {{ \App\Library\SiteHelpers::TarihFormat($row->created)}}</li>
                  </ul>

                  <!--Main content of post-->
                  <div class="blog-content">
                    @if($conpost['commimage'] ==1)
                   @if($row->image != NULL)
                      <div class="blog-media">
                      <img src="{{ asset('uploads/images/'.$row->image)}}" alt="" class="img-fluid" />
                    </div>
                    @endif
                      @endif
                      @if(Session::has('messagetext'))
				    {!! Session::get('messagetext') !!}
					@endif
                    <p class="lead">
					 {!! \App\Library\PostHelpers::formatContent($row->note) !!}</p>
                  </div>
                  <!-- Post tags -->
                  <div class="tag-cloud post-tag-cloud">
                    <h4>
                      tags
                    </h4>
                    @foreach($clouds as $tag)

                      <a href="{{ url('blog/label/'.$tag) }}" class="badge badge-secondary">{!! $tag !!}</a>

                    @endforeach


                  </div>
                @if($conpost['commshare'] ==1 AND $conpost['commshareapi'] !='')
                  <div class="block bg-faded p-3 post-block">
                      <div class="post-share social-media-branding">
                      <h5>
                        Share it:
                      </h5>
				<span class='st_sharethis_large' displayText='ShareThis'></span>
				<span class='st_facebook_large' displayText='Facebook'></span>
				<span class='st_twitter_large' displayText='Tweet'></span>
				<span class='st_googleplus_large' displayText='Google +'></span>
				<span class='st_linkedin_large' displayText='LinkedIn'></span>
				<span class='st_email_large' displayText='Email'></span>
                    </div>
                  </div>
                @endif
                </div>
                  @if($conpost['commsys'] ==1)
              <div class="comments" id="comments">
              <h3>
                Comments
              </h3>
              <hr />
              <ul class="list-unstyled">
                @foreach($comments as $comm)

                  <li class="media mb-3 pos-relative">
                  <a href="#">
                      <?php if( file_exists( './uploads/users/'.$comm->avatar) && $comm->avatar !='') { ?>
								<img src="{{ URL::to('uploads/users').'/'.$comm->avatar }} " class="d-flex mr-3 img-thumbnail img-fluid" />
							<?php  } else { ?>
								<img alt="" src="http://www.gravatar.com/avatar/{{ md5($comm->email) }}" class="d-flex mr-3 img-thumbnail img-fluid" />
							<?php } ?>                   </a>
                  <div class="media-body">
                    <ul class="list-inline blog-meta text-muted">
                      <li class="list-inline-item"> {{ \App\Library\SiteHelpers::TarihFormat($comm->posted)}}</li>
                      <li class="list-inline-item"><i class="fa fa-user"></i> <a href="#">{{ ucwords($comm->username) }}</a></li>
                    </ul>
                    <p class="mb-1">{!! \App\Library\PostHelpers::formatContent($comm->comments) !!}</p>
                  </div>
                </li>
                @endforeach
              </ul>
                        @if(Auth::check())
                            <div class="message_heading" >
                                <h4>Leave a Reply</h4>
                                <p>Make sure you enter the(*)required information where indicate.HTML code is not allowed</p>
                            </div>
                        <form method="post"  action="{{ url('post/comment') }}" parsley-validate novalidate class="form">
						{{ csrf_field() }}
							<textarea rows="5" placeholder="Leave comments here ...." class="form-control " required name="comments"></textarea><br />
							<button type="submit" class="btn btn-primary "> Submit Comment </button>
							<input type="hidden" name="pageID" value="{{ $row->pageID }}" />
							<input type="hidden" name="userID" value="{{ Session::get('uid') }}" />
						</form>
                            @else
                            Please Register to comment
                            @endif
            </div>
        @endif
              </div>

            </div>

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
        <li class="nav-item"><a href="#popular" class="nav-link @if($conpost['commlatest'] !=1) active @endif" data-toggle="tab">Popular</a></li>@endif
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
                  <div class="tab-pane fade @if($conpost['commlatest'] !=1) show active @endif blog-roll-mini" id="popular">
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
                  <a href="#" class="social-link branding-twitter"><i class="fa fa-facebook-square fa-fw"></i></a>
                  <a href="#" class="social-link branding-facebook"><i class="fa fa-twitter-square fa-fw"></i></a>
                  <a href="#" class="social-link branding-linkedin"><i class="fa fa-instagram fa-fw"></i></a>
                  <a href="#" class="social-link branding-google-plus"><i class="fa fa-tripadvisor fa-fw"></i></a>
              </ul>
            </div>
          </div>
          </div>

          </div>
      </div>
    </div>

<script type="text/javascript" id="st_insights_js" src="http://w.sharethis.com/button/buttons.js?publisher=90d7901a-4bf9-4acd-967c-a770c0fc6756"></script>
<script type="text/javascript">stLight.options({publisher: "90d7901a-4bf9-4acd-967c-a770c0fc6756", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>

