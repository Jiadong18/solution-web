@extends('layouts.app')

@section('content')

    <section class="content-header">
      <h1> {{ Lang::get('core.support') }} # {{ $row->TicketID}}</h1>
    </section>

<div class=" content col-md-3" id="sidebar">
 <div class="theiaStickySidebar">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <h3 class="profile-username text-center"><a href="{{ url('travellers/show/'.$row->UserID) }}" target="_blank">{{ \App\Library\SiteHelpers::formatLookUp($row->UserID,'UserID','1:travellers:travellerID:nameandsurname') }}</a></h3>
                <p class="text-muted text-center">{{ \App\Library\SiteHelpers::formatLookUp($row->UserID,'UserID','1:travellers:travellerID:email') }}</p>
                <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>{{ Lang::get('core.category') }}</b> <a class="pull-right">{{ \App\Library\SiteHelpers::formatLookUp($row->Category,'Category','1:tbl_ticket_category:ticket_category_ID:ticket_category') }}</a>
                </li>
                <li class="list-group-item">
                  <b>{{ Lang::get('core.priority') }}</b> <a class="pull-right
                         @if        ( $row->Priority == '0' ) text-blue
                         @elseif    ( $row->Priority == '1' ) text-yellow
                         @elseif    ( $row->Priority == '2' ) text-red
                         @endif">{!! \App\Library\SiteHelpers::formatRows($row->Priority,$fields['Priority'],$row ) !!}</a>
                </li>
                <li class="list-group-item" >
                  <b>{{ Lang::get('core.status') }} </b> <a class="pull-right
                         @if        ( $row->Status == 'New' ) text-red
                         @elseif    ( $row->Status == 'Processed' ) text-blue
                         @elseif    ( $row->Status == 'Pending' ) text-yellow
                         @elseif    ( $row->Status == 'Completed' ) text-green
                         @endif"><span id="bst">{{ $row->Status}}</span></a>
                </li>
              </ul>

              <select class="form-control pull-right text-center" id="Status" style="width: 100%;">
			<?php $st = array('New' , 'Processed' , 'Pending', 'Completed'  ) ;?>
			@foreach($st as $s)
				<option value="{{ $s }}" @if($s == $row->Status) selected @endif > {{ $s }} </option>
			@endforeach
		</select>
            </div>

          </div>
        </div>
        </div>
  <div class="content col-md-9">
<div class="box box-primary ">
	<div class="box-header with-border">

		<div class="box-header-tools pull-left" >
	   		<a href="{{ url('support?return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_back') }}"><i class="fa  fa-arrow-left fa-2x text-red"></i></a>
			@if($access['is_add'] ==1)
	   		<a href="{{ url('support/update/'.$id.'?return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit fa-2x text-green"></i></a>
			@endif

		</div>

		<div class="box-header-tools " >
			<a href="{{ ($prevnext['prev'] != '' ? url('support/show/'.$prevnext['prev'].'?return='.$return ) : '#') }}" class="tips" title="{{ Lang::get('core.previous') }}"><i class="fa fa-arrow-left fa-2x"></i>  </a>
			<a href="{{ ($prevnext['next'] != '' ? url('support/show/'.$prevnext['next'].'?return='.$return ) : '#') }}" class="tips" title="{{ Lang::get('core.next') }}"> <i class="fa fa-arrow-right fa-2x"></i>  </a>
		</div>
        <div><br><br>
    <ul class="timeline">
                    <li class="time-label">
                  <span class="bg-red">
                    {{ \App\Library\SiteHelpers::TarihFormat($row->createdOn)}}
                  </span>
            </li>
<li>
              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o fa-lg"></i>{{ date('H:i',strtotime($row->createdOn)) }}
</span>

                <h3 class="timeline-header text-red"><strong>{{ $row->Title}}</strong></h3>

                <div class="timeline-body">
{!! $row->Description !!}<br>
                @if(file_exists('./uploads/images/'.$row->Image) && $row->Image !='')
                {!! \App\Library\SiteHelpers::showUploadedFile($row->Image,'/uploads/images/') !!}
                    @endif
</div>
                <div class="timeline-footer">
                  <a href="#reply" class="btn btn-primary btn-xs"><i class="fa fa-reply fa-lg"></i> {{ Lang::get('core.reply') }}</a>
                </div>
              </div>
            </li>
        @foreach($comments as $comm)
                <li class="time-label">
                  <span class="bg-green">
                   {{ \App\Library\SiteHelpers::TarihFormat($row->createdOn)}}
                  </span>
            </li>
            <li>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o fa-lg"></i> {{ date('H:i',strtotime($comm->createdOn)) }}</span>

                <h3 class="timeline-header"><a href="#">						@if( file_exists('./uploads/users/'.$comm->avatar ) && $comm->avatar !=='')
							<img src="{{ asset('uploads/users/'.$comm->avatar)}}" class="img-circle" width="35">
						@else
							<img src="http://www.gravatar.com/avatar/{{md5($comm->email) }}" class="img-circle" width="35">
						@endif
 {{ $comm->fullname }}</a> </h3>

                <div class="timeline-body">
{!! $comm->Comments !!}
                  </div>
                <div class="timeline-footer">
                  <div class="relpyTicket" id="comm-{{ $comm->ReplyID  }}">
					<div class="tools text-right">
						<a href="{{ url('support/show/'.$comm->ReplyID).'?task=deleteReply&id='.$row->TicketID}}" class="tips deleteReply text-red" code="{{ $comm->ReplyID }}" title="{{ Lang::get('core.removecomment') }}">
							<i class="fa fa-trash-o fa-2x"></i>
						</a>
					</div>
				</div>
                </div>

              </div>
            </li>


				@endforeach

          </ul>
        </div>
    <div id="reply" class="relpyTicket">
			{!! Form::open(array('url'=>'support/save?task=saveReply', 'class'=>'form-vertical' ,'id' =>'replyComm' )) !!}
			{!! Form::hidden('TicketID', $row->TicketID) !!}

				<div class="form-group">
					<textarea class="form-control editor" placeholder=" Reply Tickets ... " name="Comments"> </textarea>
				</div>

				<div class="form-group">
					<button class="btn btn-success"><i class="fa fa-reply fa-lg"></i> {{ Lang::get('core.reply') }}</button>
				</div>


			{!! Form::close() !!}
    </div>

	</div>
</div>
</div>
<div style="clear: both;"></div>
	<script>
		jQuery('#sidebar').theiaStickySidebar({
			additionalMarginTop: 110
		});
	</script>
<script type="text/javascript">
$(document).ready(function() {
	$('.tips').tooltip();
    $('select').select2({
  minimumResultsForSearch: Infinity
});


	$('#Status').on('change',function(){
		value = $(this).val();
		var url = "{!! url('support/show/'.$row->TicketID.'?task=status&status=') !!}"+value;
		$.get(url,function( data ){
			notyMessage(data.message);
			$('#bst').html(value);
		})
	})
	$('.deleteReply').on('click',function(){
		var id = $(this).attr('code');
		var url = $(this).attr('href');
		if(confirm('Delete this reply ?'))
		{

			$.get(url,function( data ){
				notyMessage(data.message);
				$('#comm-'+id).remove();
			})
		}
		return false;
	});

	var form = $('#replyComm');
	form.parsley();
	form.submit(function(){

		if(form.parsley('isValid') == true){
			var options = {
				dataType:      'json',
				beforeSubmit :  showRequest,
				success:       showResponse
			}
			$(this).ajaxSubmit(options);
			return false;

		} else {
			return false;
		}

	});

});

function showRequest()
{
	$('.ajaxLoading').show();
}
function showResponse(data)  {
	if(data.status == 'success')
	{
		notyMessage(data.message);
		$('#mmb-modal').modal('hide');
			$.get('{{ url("support/show/".$row->TicketID) }}',function( callback ){
				$('#view_ticket').html(callback);
			})
	} else {
		notyMessageError(data.message);
		//$('.ajaxLoading').hide();
		return false;
	}
}
	</script>
@stop
