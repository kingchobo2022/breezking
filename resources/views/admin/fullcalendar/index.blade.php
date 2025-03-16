@extends('admin.admin_dashboard')
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />	
@endsection
@section('admin')
<div class="page-content">
	<div id="calendar">
	</div>	
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

<script>
$(document).ready(function(){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	var calendar = $('#calendar').fullCalendar({
		editable: true,
		header: {
			left:'prev next today',
			center: 'title',
		},

		events: '{{ url('admin/full_calendar') }}',

		selectable: true,
		selectHelper: true,
		select:function(start, end, allDay)
		{
			var title = prompt('Event Title: ');
			if (title)
			{
				var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');
				var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');

				$.ajax({
					url: "{{ url('admin/full_calendar/action') }}",
					type: "POST",
					data: {
						title: title,
						start: start,
						end: end,
						type: 'add'
					},
					success:function(data)
					{
						calendar.fullCalendar('refetchEvents');
						alert("Event Created Successfull");
					}
				});
			}
		},
		editable: true,
		eventResize: function(event, delta)
		{
			var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');
			var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');
			var title = event.title;
			var id = event.id;

			$.ajax({
				url: "{{ url('admin/full_calendar/action') }}",
				type: "POST",
				data: {
					title: title,
					start: start,
					end: end,
					type: 'update'
				},
				success:function(data)
				{
					calendar.fullCalendar('refetchEvents');
					alert("Event Created Successfull");
				}
			});

		},
		eventDrop: function(event, delta)
		{
			var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');
			var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');
			var title = event.title;
			var id = event.id;

			$.ajax({
					url: "{{ url('admin/full_calendar/action') }}",
					type: "POST",
					data: {
						title: title,
						start: start,
						end: end,
						id: id,
						type: 'update'
					},
					success:function(data)
					{
						calendar.fullCalendar('refetchEvents');
						alert("Event Updated Successfull");
					}
				});

		},
		eventClick: function(event)
		{
			if(!confirm('Are you sure you want to remove it?')) {
				return false;
			}
			var id = event.id;

			$.ajax({
					url: "{{ url('admin/full_calendar/action') }}",
					type: "POST",
					data: {
						id: id,
						type: 'delete'
					},
					success:function(data)
					{
						calendar.fullCalendar('refetchEvents');
						alert("Event Deleted Successfull");
					}
				});
			
		}
	});
});	
</script>
@endsection