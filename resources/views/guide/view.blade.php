@extends('layouts.app')
@section('content')
<?php
use \App\Http\Controllers\GuideController;
?>

    <section class="content-header">
      <h1>{{Lang::get('core.guides')}}</h1>
    </section>

	<div class="box-header with-border">
				<div class="box-header-tools pull-left" >
			   		<a href="{{ url('guide?return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_back') }}"><i class="fa fa-arrow-left fa-2x"></i></a>
					@if($access['is_add'] ==1)
			   		<a href="{{ url('guide/update/'.$id.'?return='.$return) }}" class="tips text-green" title="{{ Lang::get('core.btn_edit') }}"><i class="fa  fa-edit fa-2x"></i></a>
                    <a href="{{ url('guidenotes/update?guideID='.$id) }}" onclick="MmbModal(this.href,'New Guide Note'); return false;" class="tips" title="{{Lang::get('core.addnewnote')}}"><i class="fa fa-sticky-note fa-2x text-blue"></i></a>
                    @endif
				</div>

				<div class="box-header-tools pull-right " >
					<a href="{{ ($prevnext['prev'] != '' ? url('guide/show/'.$prevnext['prev'].'?return='.$return ) : '#') }}" class="tips" title="{{Lang::get('core.previous')}}"><i class="fa fa-arrow-left fa-2x"></i>  </a>
					<a href="{{ ($prevnext['next'] != '' ? url('guide/show/'.$prevnext['next'].'?return='.$return ) : '#') }}" class="tips" title="{{Lang::get('core.next')}}"> <i class="fa fa-arrow-right fa-2x"></i>  </a>
				</div>
			</div>
				<div class="row">
                    	<div class="col-md-4">
                    		<div class="box box-primary">
            <div class="box-body box-profile">
<h3 class="text-center">
                @if(file_exists('./uploads/images/'.$row->image) && $row->image !='')
                    {!! \App\Library\SiteHelpers::formatRows($row->image,$fields['image'],$row ) !!}
                @else
                <img src=" {{ asset('/uploads/images/no-image-guide.png') }}" />
                @endif
</h3>
              <h3 class="profile-username text-center">{{ $row->name}}</h3>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>{{Lang::get('core.email')}}</b> <a href="mailto:{{ $row->email}}" class="pull-right">{{ $row->email}}</a>
                </li>
                <li class="list-group-item">
                  <b>{{Lang::get('core.mobilephone')}}</b> <a class="pull-right">{{ $row->mobilephone}} </a>
                </li>
                <li class="list-group-item">
                  <b>{{Lang::get('core.licenseno')}}</b> <a class="pull-right">{{ $row->license_no}}</a>
                </li>
                  <li class="list-group-item">
                  <b>{{Lang::get('core.spokenlanguages')}}</b>
                </li>
                  <li class="list-group-item">
                  <a class="#">{!! GuideController::languages($row->languageID) !!}
</a>
                </li>
                  <li class="list-group-item">
                  <b>{{Lang::get('core.city')}}</b> <a class="pull-right">{{ \App\Library\SiteHelpers::formatLookUp($row->cityID,'cityID','1:def_city:cityID:city_name') }}</a>
                </li>
                  <li class="list-group-item">
                  <b>{{Lang::get('core.country')}}</b> <a class="pull-right">{{ \App\Library\SiteHelpers::formatLookUp($row->countryID,'countryID','1:def_country:countryID:country_name') }}</a>
                </li>
                  <li class="list-group-item">
                  <b>{{Lang::get('core.status')}}</b> <a class="pull-right">{!! \App\Library\GeneralStatuss::Status($row->status) !!}</a>
                </li>

              </ul>

             </div>
          </div>
            </div>
                        <div class="col-md-8">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class=""><a href="#tab_1" data-toggle="tab" aria-expanded="true"><i class="fa fa-square text-green" aria-hidden="true"></i> {{Lang::get('core.cv')}}</a></li>
              <li class="active"><a href="#tab_2" data-toggle="tab" aria-expanded="true"><i class="fa fa-square text-green" aria-hidden="true"></i> {{Lang::get('core.tours')}}</a></li>
              <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="true"><i class="fa fa-square text-green" aria-hidden="true"></i> {{Lang::get('core.notes')}}</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane" id="tab_1">
                {!! $row->CV !!}

              </div>
              <div class="tab-pane active" id="tab_2">
<table id="guidetours" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>{{Lang::get('core.tourname')}}</th>
                  <th>{{Lang::get('core.start')}}</th>
                  <th>{{Lang::get('core.end')}}</th>
                  <th style="width:30px;">{{Lang::get('core.featured')}}</th>
                  <th style="width:20px;">{{Lang::get('core.definitedeparture')}}</th>
                  <th style="width:20px;">{{Lang::get('core.status')}}</th>
                </tr>
                </thead>
                <tbody>

             @foreach($guide as $gt)
                <tr>
                  <td><a href="{{ url('tourdates/show/'.$gt['tourdateID']) }}" target="_blank">{{ \App\Library\SiteHelpers::formatLookUp($gt['tourID'],'tourID','1:tours:tourID:tour_name') }}</a></td>
                  <td>{{ \App\Library\SiteHelpers::TarihFormat($gt['start'])}}</td>
                  <td>{{ \App\Library\SiteHelpers::TarihFormat($gt['end'])}}</td>
                  <td>{!! \App\Library\SiteHelpers::Featured($gt['featured']) !!}</td>
                  <td>{!! \App\Library\SiteHelpers::Definite_departure($gt['definite_departure']) !!}</td>
                  <td>{!! \App\Library\GeneralStatuss::Status($gt['status']) !!}</td>
                </tr>
            @endforeach
                </tbody>
              </table>
              </div>
              <div class="tab-pane" id="tab_3">
                  <table id="notes" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width:10px;"></th>
                  <th>{{Lang::get('core.title')}}</th>
                  <th>{{Lang::get('core.note')}}</th>
                  <th style="width:65px;">{{Lang::get('core.date')}}</th>
                  <th style="width:25px;"></th>
                </tr>
                </thead>
                <tbody>
             @foreach($notes as $gn)
                <tr>
                  <td><a class="text-{{ $gn['style'] }} tips" title="{{ $gn['style'] }}" href="#"><i class="fa fa-square fa-2x"></i></a></td>
                  <td>{{ $gn['title'] }}</td>
                  <td>{{ $gn['note'] }}</td>
                  <td>{{ \App\Library\SiteHelpers::TarihFormat($gn['created_at'])}}</td>
                  <td>@if($access['is_remove'] =='1')
<a href="{{ url('guide/notedelete/'.$gn['guideID'].'/'.$gn['guidenotesID'])}}"  class="btn btn-default btn-xs btn-flat pull-right " data-toggle="confirmation" data-title="{{Lang::get('core.rusure')}}" data-content="{{ Lang::get('core.youwanttodeletethis') }}"><i class="fa fa-trash-o text-navy"></i></a>
					@endif
					@if($access['is_edit'] =='1')
					 <a href="{{ url('guidenotes/update/'.$gn['guidenotesID'].'/?guideID='.$id)}}"  onclick="MmbModal(this.href,'{{Lang::get('core.editnote')}}'); return false;"  class="btn btn-default btn-xs btn-flat pull-right tips" title="{{Lang::get('core.editnote')}}"><i class="fa fa-edit text-navy"></i></a>
					@endif
</td>
                </tr>
            @endforeach
                </tbody>
              </table>
              </div>
            </div>
          </div>


                        </div>

                    </div>



<script>
            $(function() {
            $('.editItem').click(function() {
                $('.displayItem').hide();
                $('.displayEdit').show();
            });
            $('.closeItem').click(function() {
                $('.displayItem').show();
                $('.displayEdit').hide();
            });
        })

  $(function () {
    $("#guidetours").DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": false,
      "autoWidth": false
    });
    $("#notes").DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": false,
      "autoWidth": false
    });
    $('[data-toggle=confirmation]').confirmation({
    rootSelector: '[data-toggle=confirmation]',
    container: 'body'
  });

  });
</script>


@stop
