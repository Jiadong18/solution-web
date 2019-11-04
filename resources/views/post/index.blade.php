<?php
use App\Library\Markdown;
?>
@if(Session::has('messagetext'))
{!! Session::get('messagetext') !!}
@endif
<section id="blog" class="container">
        <div class="blog">
            <div class="row">
                 <div class="col-md-9">
                    <div class="blog-item">
                        <div class="row">
                			@foreach ($rowData as $row)
                            <div class="col-xs-12 col-sm-2 text-center">
                                <div class="entry-meta">
                                    <span id="publish_date">{{ \App\Library\SiteHelpers::TarihFormat($row->created)}}</span>
                                    <span><i class="fa fa-user"></i> <a href="#">{{ ucwords($row->username) }}</a></span>
                                    <span><i class="fa fa-comment"></i> <a href="{{ url('blog/view/'.$row->pageID.'/'.$row->alias)}}#comments">{{ $row->comments }}  comment(s)</a></span>
                                    <span><i class="fa fa-eye"></i><a href="#">{{ $row->views }} views</a></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-10 blog-content">
                                <a href="{{ url('blog/view/'.$row->pageID.'/'.$row->alias)}}"><img class="img-responsive img-blog" src="{{ asset('uploads/images/'.$row->image)}}" width="100%" alt="" /></a>
                                <h2><a href="{{ url('blog/view/'.$row->pageID.'/'.$row->alias)}}">{{ $row->title }}</a></h2>
                                <p>
                        {!! str_limit($row->note, $limit = 250, $end = '....') !!}
                                    </p>
                                <a class="btn btn-primary readmore" href="{{ url('blog/view/'.$row->pageID.'/'.$row->alias)}}">Read More <i class="fa fa-angle-right"></i></a>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div><!--/.col-md-8-->

                <aside class="col-md-3">
                        <div class="widget categories">
                        <h3>Recent Posts</h3>
                        <div class="row">
                            <div class="col-sm-12">
                            @include('post.widget',array("conpost"=>$conpost))
                            </div>
                        </div>
                    </div>

                    <div class="widget tags">
                        <h3>Tag Cloud</h3>
                        <ul class="tag-cloud">
                            {!! \App\Library\PostHelpers::cloudtags() !!}
                        </ul>
                    </div>
    			</aside>
            </div>
        </div>
    </section>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
 {!! $pagination->render() !!}

</div>
