  $(function () {
      var menuId = parseInt($('#menuId').val());
      var isDayClickable = 1;
      $('#calendar').fullCalendar({
          header: {
              right: 'prev,next',
              center: 'title',
              left: 'today'
          },
          fixedWeekCount: false,
          defaultView: 'month',
          eventLimit: true,
          eventRender: function (eventObj, $el) {
              $el.popover({
                  title: eventObj.title,
                  content: eventObj.description,
                  trigger: 'hover',
                  placement: 'top',
                  container: 'body',
                  html: true,
              });
          },
          loading: function (isLoading, view) {
              if (isLoading) { // isLoading gives boolean value
                  $("#calendar").LoadingOverlay("show", {
                      background: "rgba(165, 190, 100, 0.5)"
                  });
                  $("#calendar").LoadingOverlay("show");
              } else {
                  $("#calendar").LoadingOverlay("hide", true);
              }
          },

          events: {
              headers: {
                  'X-CSRF-TOKEN': $('#tooken').val()
              },
              url: window.location.href,
              type: 'POST',
              data: {
                  tId: menuId,
              },
              error: function () {
                  alert('there was an error while fetching events!');
              },
              failure: function () {
                  alert('there was an error while fetching events!');
              },
          },

          // put your options and callbacks here
          eventClick: function (calEvent, jsEvent, view) {
              // alert('Event: ' + calEvent.title);
              // alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
              // alert('View: ' + view.name);

              // change the border color just for fun
              $(this).css('border-color', 'red');

          },

          dayClick: function (date, jsEvent, view) {
              if (isDayClickable) {
                  isDayClickable = !isDayClickable;
              } else
                  return false;

              // alert('Clicked on: ' + date.format());
              console.log("clicked on: " + date.format());
              // alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
              // alert('Current view: ' + view.name);
              // change the day's background color just for fun
              // $(this).css('background-color', 'red');
          },



      }); //calender ending
  });