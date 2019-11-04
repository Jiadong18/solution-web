@foreach($popularposts as $row)
                @if($conpost['commimage'] ==1)
                    <div class="col-4">
                      <div class="blog-media">
                        <a href="{{ url('blog/view/'.$row->pageID.'/'.$row->alias)}}">
                          <img src="{{ asset('uploads/images/')}}/{{ $row->image != NULL ? $row->image : 'no-image-blog.png'}}" class="img-fluid" />
                        </a>
                      </div>
                    </div>
                @endif
                    <div class="col-8">
                      <h5>
                        <a href="{{ url('blog/view/'.$row->pageID.'/'.$row->alias)}}">{{ $row->title }}</a>
                      </h5>
                        <p>{{ \App\Library\SiteHelpers::TarihFormat($row->created)}}</p>
                    </div>
@endforeach
