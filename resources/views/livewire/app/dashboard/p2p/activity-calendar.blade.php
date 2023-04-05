<div>
    
  <div class="row">
    <div class="col-12 col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col">
              <div id='fullcalendar'></div>
            </div>
          </div>
          <div class="row mt-4">
            <div class="col-12">
              <div id='external-events' class='external-events'>
                <div id='external-events-listing'>
                  <h6 class="mb-2 text-muted">Keterangan</h6>
                  <div class="row">
                    <div class="col-6">
                      <div class='fc-event text-dark' style="border-color: #FF3366; background-color: #fff0f4;">Jatuh Tempo</div>
                    </div>
                    <div class="col-6">
                      <div class='fc-event text-dark' style="border-color: #FBBC06; background-color: #fffbf2;">Lewat Jatuh Tempo</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="fullCalModal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 id="modalTitle1" class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
        </div>
        <div id="modalBody1" class="modal-body"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button wire.click="" class="btn btn-primary">Detail Pinjaman</button>
        </div>
      </div>
    </div>
  </div>

  <div id="createEventModal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 id="modalTitle2" class="modal-title">Add event</h4>
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
        </div>
        <div id="modalBody2" class="modal-body">
          <form>
            <div class="form-group">
              <label for="formGroupExampleInput">Example label</label>
              <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Example input">
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput2">Another label</label>
              <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button class="btn btn-primary">Add</button>
        </div>
      </div>
    </div>
  </div>

  @push('page_specified_js')
    <script>
    window.addEventListener('livewire:load',function(){
    // sample calendar events data

    var curYear = moment().format('YYYY');
      var curMonth = moment().format('MM');


      var otherEvents = {
        id: 6,
        backgroundColor: 'rgba(253,126,20,.25)',
        borderColor: '#fd7e14',
        events: [
          {
            id: '16',
            start: curYear+'-'+curMonth+'-06',
            end: curYear+'-'+curMonth+'-08',
            title: 'My Rest Day'
          },
          {
            id: '17',
            start: curYear+'-'+curMonth+'-29',
            end: curYear+'-'+curMonth+'-31',
            title: 'My Rest Day'
          }
        ]
      };

      var jatuhTempoPinjaman =@this.jatuhTempoPinjamanEvents;
      var lewatJatuhTempoPinjaman =@this.lewatJatuhTempoPinjamanEvents;
      // console.log(jatuhTempoPinjaman);

      // initialize the external events
      // $('#external-events .fc-event').each(function() {
      //   // store data so the calendar knows to render an event upon drop
      //   $(this).data('event', {
      //     title: $.trim($(this).text()), // use the element's text as the event title
      //     stick: true // maintain when user navigates (see docs on the renderEvent method)
      //   });
      //   // make the event draggable using jQuery UI
      //   $(this).draggable({
      //     zIndex: 999,
      //     revert: false,      // will cause the event to go back to its
      //     revertDuration: 0  //  original position after the drag
      //   });

      // });


      // initialize the calendar
      $('#fullcalendar').fullCalendar({
        header: {
          left: 'prev,today,next',
          center: 'title',
          right: 'month,agendaWeek,agendaDay,listMonth'
        },
        editable: false,
        droppable: false, // this allows things to be dropped onto the calendar
        dragRevertDuration: 0,
        defaultView: 'month',
        eventLimit: true, // allow "more" link when too many events
        // eventSources: [calendarEvents, birthdayEvents, holidayEvents, discoveredEvents, meetupEvents, otherEvents],
        eventSources: [jatuhTempoPinjaman,lewatJatuhTempoPinjaman],
        eventClick:  function(event, jsEvent, view) {
          $('#modalTitle1').html(event.title);
          $('#modalBody1').html(
          '<table class="tbl tbl-stripped">'+
            '<tr>'+
            '<td> Nama Borrower</td>'+
            '<td> : </td>'+
            '<td>'+event.description_borrower+'</td>'+
            '</tr>'+
            '<tr>'+
            '<td> Nomor Factsheet</td>'+
            '<td> : </td>'+
            '<td>'+event.description_no_factsheet+'</td>'+
            '</tr>'+
            '<tr>'+
            '<td> Nominal Pembiayaan</td>'+
            '<td> : </td>'+
            '<td>'+event.description_nominal+'</td>'+
            '</tr>'+
            '<tr>'+
            '<td> Tanggal Pembiayaan</td>'+
            '<td> : </td>'+
            '<td>'+event.description_tanggal_pembiayaan+'</td>'+
            '</tr>'+
            '<tr>'+
            '<td> Sifat Pembiayaan</td>'+
            '<td> : </td>'+
            '<td>'+event.description_sifat_pembiayaan+'</td>'+
            '</tr>'+
            '<tr>'+
            '<td> Jangka Waktu</td>'+
            '<td> : </td>'+
            '<td>'+event.description_jangka_waktu+'</td>'+
            '</tr>'+
            '<tr>'+
            '<td> Jatuh Tempo</td>'+
            '<td> : </td>'+
            '<td>'+event.description_jatuh_tempo+'</td>'+
            '</tr>'+
            '<tr>'+
            '<td> Tunggakan Hari</td>'+
            '<td> : </td>'+
            '<td>'+event.description_tunggakan_hari+'</td>'+
            '</tr>'+
            '</table>');
          $('#eventUrl').attr('href',event.url);
          $('#fullCalModal').modal();
        },
        dayClick: function(date, jsEvent, view) {
          $("#createEventModal").modal("show");
        },
        // defaultDate: '2019-07-12',
        // events: [{
        //     title: 'All Day Event',
        //     start: '2019-07-08'
        //   },
        //   {
        //     title: 'Long Event',
        //     start: '2019-07-01',
        //     end: '2019-07-07',
        //     description: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus adipisci explicabo magnam molestiae libero.'
        //   },
        //   {
        //     id: 999,
        //     title: 'Repeating Event',
        //     start: '2019-07-09T16:00:00',
        //     description: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus adipisci explicabo magnam molestiae libero.'

        //   },
        //   {
        //     id: 999,
        //     title: 'Repeating Event',
        //     start: '2019-07-16T16:00:00',
        //     description: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus adipisci explicabo magnam molestiae libero.'
        //   },
        //   {
        //     title: 'Conference',
        //     start: '2019-07-11',
        //     end: '2019-07-13',
        //     description: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus adipisci explicabo magnam molestiae libero.'        
        //   },
        //   {
        //     title: 'Meeting',
        //     start: '2019-07-12T10:30:00',
        //     end: '2019-07-12T12:30:00',
        //     description: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus adipisci explicabo magnam molestiae libero.'
        //   },
        //   {
        //     title: 'Lunch',
        //     start: '2019-07-12T12:00:00',
        //     description: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus adipisci explicabo magnam molestiae libero.'
        //   },
        //   {
        //     title: 'Meeting',
        //     start: '2019-07-12T14:30:00',
        //     description: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus adipisci explicabo magnam molestiae libero.'
        //   },
        //   {
        //     title: 'Happy Hour',
        //     start: '2019-07-12T17:30:00',
        //     description: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus adipisci explicabo magnam molestiae libero.'
        //   },
        //   {
        //     title: 'Dinner',
        //     start: '2019-07-12T20:00:00',
        //     description: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus adipisci explicabo magnam molestiae libero.'
        //   },
        //   {
        //     title: 'Birthday Party',
        //     start: '2019-07-13T07:00:00',
        //     description: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus adipisci explicabo magnam molestiae libero.'
        //   },
        //   {
        //     title: 'Team Lunch',
        //     start: '2019-07-28',
        //     description: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus adipisci explicabo magnam molestiae libero.'
        //   }
        // ],

        // drop: function() {
        //   // is the "remove after drop" checkbox checked?
        //   if ($('#drop-remove').is(':checked')) {
        //     // if so, remove the element from the "Draggable Events" list
        //     $(this).remove();
        //   }
        // },
        eventDragStop: function( event, jsEvent, ui, view ) {
          if(isEventOverDiv(jsEvent.clientX, jsEvent.clientY)) {
            // $('#calendar').fullCalendar('removeEvents', event._id);
            var el = $( "<div class='fc-event'>" ).appendTo( '#external-events-listing' ).text( event.title );
            el.draggable({
              zIndex: 999,
              revert: false, 
              revertDuration: 0 
            });
            el.data('event', { title: event.title, id :event.id, stick: true });
          }
        }
      });


      var isEventOverDiv = function(x, y) {
        var external_events = $( '#external-events' );
        var offset = external_events.offset();
        offset.right = external_events.width() + offset.left;
        offset.bottom = external_events.height() + offset.top;

        // Compare
        if (x >= offset.left
          && y >= offset.top
          && x <= offset.right
          && y <= offset .bottom) { return true; }
        return false;
      }
    });
    </script>
  @endpush

</div>
