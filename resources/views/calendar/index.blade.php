@extends('layouts.app')
@section('content')
<link rel='stylesheet' href="{{ asset('mmb/js/calendar/fullcalendar.css') }}"/>
<script type="text/javascript" src="{{ asset('mmb/js/calendar/lib/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('mmb/js/calendar/calendar.js') }}"></script>
<script type="text/javascript" src="{{ asset('mmb/js/calendar/gcal.js') }}"></script>
<div class="page-content row">
      <div class="box box-default">
          <div class="box-body">
            <div id='calendar' class="" > </div>
          </div>	
		</div>	
		</div>	
<script>
$(document).ready(function() {
    
		$('#calendar').fullCalendar({
			header: {
				left: 'title',
				center: '',
                right:  'today prev,next,listMonth,month'
			},
			defaultDate: '{{ date("Y-m-d")}}',
			selectable: true,
			selectHelper: true,
			select: function(start, end) {
				MmbModal('{{ url("calendartourdates/update/") }}','Add New Tour');
			},
		   	eventClick: function(calEvent, jsEvent, view) {
		   		var tourdateID = calEvent.tourdateID;
				MmbModal('{!! url("calendartourdates/show/'+tourdateID+'") !!}','View :'+calEvent.tour_code );
            },			
			editable: false,
            googleCalendarApiKey: '{{ CNF_APIKEY }}',
            eventSources: [
                {
            googleCalendarId: '{{ CNF_CALENDARID }}',
                color: '#F22613',
                textColor: '#fff'
                    },                
                    {
                url: '{{ url("calendar/jsondata") }}',
				error: function() {
				$('#script-warning').show();
				}
			}]
            ,
			eventDrop: function(event, revertFunc) {
				if (confirm("Do you really want to change the date of this tour?")) {
					$.post( '{{url("calendar/savedrop") }}', 
					{ tourdateID:event.tourdateID,start : event.start.format(),end : event.end.format()});					
				} else {
					revertFunc();
				}
			}		
		});
    
    });
    
</script>
<style>
	#script-warning {
		display: none;
		background: #eee;
		border-bottom: 1px solid #ddd;
		padding: 0 10px;
		line-height: 40px;
		text-align: center;
		font-weight: bold;
		font-size: 12px;
		color: #65bd77;
	}
	.fc-event { background:#4c5667; color:#fff; font-weight: 800 ;}
	#loading {
		display: none;
		position: absolute;
		top: 10px;
		right: 10px;
	}
</style>


@stop