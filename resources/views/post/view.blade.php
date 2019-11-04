<section id="blog" class="container">
        <div class="blog">
            <div class="row">
                <div class="col-md-9">
                    <div class="blog-item">
                            <div class="row">
                                <div class="col-xs-12 col-sm-2 text-center">
                                    <div class="entry-meta">
                                        <span id="publish_date">{{ \App\Library\SiteHelpers::TarihFormat($row->created)}}</span>
                                        <span><i class="fa fa-user"></i> <a href="#"> {{ ucwords($row->username) }}</a></span>
                                        <span><i class="fa fa-comment"></i> <a href="{{ url('post/view/'.$row->pageID.'/'.$row->alias)}}#comments">{{ $row->comments }} Comments</a></span>
                                        <span><i class="fa fa-eye"></i><a href="#">{{ $row->views }} Views</a></span>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-10 blog-content">
					@if(Session::has('messagetext'))
				    {!! Session::get('messagetext') !!}
					@endif

					 {!! \App\Library\PostHelpers::formatContent($row->note) !!}

                                </div>
                            </div>
                        </div>
                        @if($conpost['commsys'] ==1)
                        <h1 id="comments_title">Comments</h1>
                            @foreach($comments as $comm)
                        <div class="media comment_section">
                            <div class="pull-left post_comments">
                                <a href="#"><?php if( file_exists( './uploads/users/'.$comm->avatar) && $comm->avatar !='') { ?>
								<img src="{{ URL::to('uploads/users').'/'.$comm->avatar }} " border="0" width="40" class="img-circle" />
							<?php  } else { ?>
								<img alt="" src="http://www.gravatar.com/avatar/{{ md5($comm->email) }}" width="40" class="img-circle" />
							<?php } ?> </a>
                            </div>
                            <div class="media-body post_reply_comments">
                                <h3>{{ ucwords($comm->username) }}</h3>
                                <h4>{{ \App\Library\SiteHelpers::TarihFormat($comm->posted)}}</h4>
                                <p>{!! \App\Library\PostHelpers::formatContent($comm->comments) !!}</p>
                                @if(Session::get('gid') == '1' OR $comm->userID == Session::get('uid'))
									<a href="{{ url('post/remove/'.$row->pageID.'/'. $row->alias.'/'.$comm->commentID) }}"><i class="fa fa-minus-circle"></i> Remove  </a>
									@endif
                            </div>
                        </div>
                    @endforeach
                        <div id="comments clearfix">
                            <div class="status alert alert-success" style="display: none"></div>
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
							<input type="hidden" name="alias" value="{{ $row->alias }}" />
						</form>
                            @else
                            Please Register to comment
                            @endif

                        @endif

                        </div>
                    </div>

                <aside class="col-md-3">
    				<div class="widget categories">
                        <h3>Recent Posts</h3>
                        <div class="row">
                            <div class="col-sm-12">
                            @include('post.widget',array("conpost"=>$conpost))
                            </div>
                        </div>
                    </div>
    				<div class="widget categories">
                    </div>
                    <div class="widget tags">
                        <h3>Tag Cloud</h3>
                        <ul class="tag-cloud">
                            {!! \App\Library\PostHelpers::cloudtags() !!}
                        </ul>
                    </div><!--/.tags-->

                </aside>

            </div><!--/.row-->

         </div><!--/.blog-->

    </section>

<div class="container m-t">
	<div class="row"  style="padding:25px 0;">

		<div class="col-md-9">
			<div class="posts">

				@if($conpost['commshare'] ==1 AND $conpost['commshareapi'] !='')
				<span class='st_sharethis_large' displayText='ShareThis'></span>
				<span class='st_facebook_large' displayText='Facebook'></span>
				<span class='st_twitter_large' displayText='Tweet'></span>
				<span class='st_googleplus_large' displayText='Google +'></span>
				<span class='st_linkedin_large' displayText='LinkedIn'></span>
				<span class='st_email_large' displayText='Email'></span>
				@endif


				<div class="labels"><br />
				<a href="{{ url('blog')}}" class="btn btn-default btn-sm pull-left"><i class="fa fa-arrow-left fa-2x"></i> Back </a>
				</div>
			</div>
		</div>

		<div class="col-md-3">

		</div>

	</div>
</div>

<script type="text/javascript" id="st_insights_js" src="http://w.sharethis.com/button/buttons.js?publisher=90d7901a-4bf9-4acd-967c-a770c0fc6756"></script>
<script type="text/javascript">stLight.options({publisher: "90d7901a-4bf9-4acd-967c-a770c0fc6756", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>

