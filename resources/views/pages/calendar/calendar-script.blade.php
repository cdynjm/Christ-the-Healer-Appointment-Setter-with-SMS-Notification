@php
    date_default_timezone_set("Asia/Singapore"); 
    $today = date('Y-m-d');
@endphp

<script>

	$(document).ready(function() {
	    var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();

		/*  className colors

		className: default(transparent), important(red), chill(pink), success(green), info(blue)

		*/

		/* initialize the external events
		-----------------------------------------------------------------*/

		$('#external-events div.external-event').each(function() {

			// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
			// it doesn't need to have a start or end
			var eventObject = {
				title: $.trim($(this).text()) // use the element's text as the event title
			};

			// store the Event Object in the DOM element so we can get to it later
			$(this).data('eventObject', eventObject);

			// make the event draggable using jQuery UI
			$(this).draggable({
				zIndex: 999,
				revert: true,      // will cause the event to go back to its
				revertDuration: 0  //  original position after the drag
			});

		});


		/* initialize the calendar
		-----------------------------------------------------------------*/

		var calendar =  $('#calendar').fullCalendar({
			header: {
				left: 'title',
				center: 'agendaDay,agendaWeek,month',
				right: 'prev,next today'
			},
			editable: true,
			firstDay: 0, //  1(Monday) this can be changed to 0(Sunday) for the USA system
			selectable: true,
			defaultView: 'month',

			axisFormat: 'h:mm',
			columnFormat: {
                month: 'ddd',    // Mon
                week: 'ddd d', // Mon 7
                day: 'dddd M/d',  // Monday 9/7
                agendaDay: 'dddd d'
            },
            titleFormat: {
                month: 'MMMM yyyy', // September 2009
                week: "MMMM yyyy", // September 2009
                day: 'MMMM yyyy'                  // Tuesday, Sep 8, 2009
            },
			allDaySlot: false,
			selectHelper: true,
			dayClick: function(date, jsEvent, view) { 

                const today = new Date();
                today.setHours(0,0,0,0);
               
               if(date >= today) {

                    var month = date.toLocaleString('default', { month: 'long' });
                    var monthNumber = date.getMonth() + 1;
                    var year = date.getFullYear();
                    var day = ('0' + date.getDate()).slice(-2);
                    var weekday = date.toLocaleString('default', { weekday: 'long' })

                    var datePicked = month + " " + day + ", " + year + " - " + weekday;

					if(monthNumber >= 1 && monthNumber <= 9) {
                    	var dateValue = year + "-0" + monthNumber + "-" + day;
					}
					if(monthNumber >= 10 && monthNumber <= 12) {
                    	var dateValue = year + "-" + monthNumber + "-" + day;
					}

                    $("#date-scheduled").val(datePicked);
                    $("#date-value").val(dateValue);

                    $.ajax({
                        type: 'POST',
                        url: '/create/date-schedule',
                        data: { dateValue },
                        dataType: 'text',
                        success: function(response)
                        {
                            $("#select-time-schedule").html(response);
                        }
                    });
                    
                    $('#setAppointmentModal').modal('show');
                }
               
            },
			droppable: true, // this allows things to be dropped onto the calendar !!!
			drop: function(date, allDay) { // this function is called when something is dropped

				// retrieve the dropped element's stored Event Object
				var originalEventObject = $(this).data('eventObject');

				// we need to copy it, so that multiple events don't have a reference to the same object
				var copiedEventObject = $.extend({}, originalEventObject);

				// assign it the date that was reported
				copiedEventObject.start = date;
				copiedEventObject.allDay = allDay;

				// render the event on the calendar
				// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
				$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

				// is the "remove after drop" checkbox checked?
				if ($('#drop-remove').is(':checked')) {
					// if so, remove the element from the "Draggable Events" list
					$(this).remove();
				}

			},
			<?php if(str_contains(request()->url(), 'dashboard') == true) { ?>
			events: [
				<?php foreach($calendar as $cal) {
					
					if($cal->date >= $today) {
					
					$year = date('Y', strtotime($cal->date));
					$month = date('n', strtotime($cal->date)) - 1;
					$day = date('j', strtotime($cal->date));

					$count = 0;

					foreach($appointments as $ap) {
						if($ap->date == $cal->date) {
							$count += 1;
						}
					}
				?>
				{
					title: 'Scheduled: <?php echo $count; ?>',
					start: new Date(<?php echo $year; ?>, <?php echo $month; ?>, <?php echo $day; ?>),
					className: 'success text-black'
				},	
				<?php } 
					}
				?>	
			],
			<?php } ?>

			<?php if(str_contains(request()->url(), 'appointment') == true) { ?>
			events: [
				<?php foreach($calendar as $cal) {
					
					$year = date('Y', strtotime($cal->date));
					$month = date('n', strtotime($cal->date)) - 1;
					$day = date('j', strtotime($cal->date));

					$countFailed = 0;
					$countVisited = 0;
					$countPending = 0;
					$countUpcoming = 0;

					foreach($appointments as $ap) {
						if($ap->date == $cal->date) {
							if($ap->status == 0) {
								$countUpcoming += 1;
							}
							if($ap->status == 1) {
								$countPending += 1;
							}
							if($ap->status == 2) {
								$countVisited += 1;
							}
							if($ap->status == 3) {
								$countFailed += 1;
							}
						}
					}
				?>
				<?php if($countPending != 0) { ?>
				{
					title: 'Pending: <?php echo $countPending; ?>',
					start: new Date(<?php echo $year; ?>, <?php echo $month; ?>, <?php echo $day; ?>),
					className: 'info text-black'
				},
				<?php } ?>
				<?php if($countUpcoming != 0) { ?>
				{
					title: 'Upcoming: <?php echo $countUpcoming; ?>',
					start: new Date(<?php echo $year; ?>, <?php echo $month; ?>, <?php echo $day; ?>),
					className: 'warning text-black',
					color: 'rgb(248, 248, 154)'
				},
				<?php } ?>
				<?php if($countVisited != 0) { ?>
				{
					title: 'Visited: <?php echo $countVisited; ?>',
					start: new Date(<?php echo $year; ?>, <?php echo $month; ?>, <?php echo $day; ?>),
					className: 'success text-black'
				},
				<?php } ?>
				<?php if($countFailed != 0) { ?>
				{
					title: 'Failed: <?php echo $countFailed; ?>',
					start: new Date(<?php echo $year; ?>, <?php echo $month; ?>, <?php echo $day; ?>),
					className: 'important text-black'
				},	
				<?php } ?>				
				<?php 
					}
				?>	
			],
			<?php } ?>
		});


	});

</script>