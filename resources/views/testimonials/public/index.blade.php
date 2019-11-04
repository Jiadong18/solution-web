@foreach ($rowData as $row)
 @if($row->status ==1)
            <blockquote>
                <p>
                    @if(file_exists(public_path().'/mmb/images/'.$row->image) && $row->image !='')
        <img class="img-rounded" src="{{ asset('mmb/images/'.$row->image)}}" width=150  style="float:left" />
        @else
        <img class="img-rounded" src="{{ asset('mmb/images/tour-noimage.jpg')}}"  width=150 style="float:left" />
        @endif {{$row->testimonial}}
                    <br>
                    <br>
                    <em>
                    {{$row->namesurname}} – {{ \App\Library\SiteHelpers::formatLookUp($row->country,'countryID','1:def_country:countryID:country_name') }} - {{ date('d-M-Y',strtotime($row->tour_date)) }}
                    </em>
                </p>
                <div style="clear: both;"></div>
<br>
            </blockquote>
    @endif
            @endforeach

<div class="text-center"> {!! $pagination->render() !!}</div>


