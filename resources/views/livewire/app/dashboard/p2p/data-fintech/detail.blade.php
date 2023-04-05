<div>

  <style>
    :root {
      --primary-color: #555;
      --secondary-color: #999;
      --tertiary-color: #dedede;
      --bg-primary-color: #6c7ae0;
      --bg-secondary-color: #d2d7ff;
      --bg-tertiary-color: #ecefff;
    }
    tr:nth-child(even) {
      background-color: var(--bg-tertiary-color);
    }
  </style>
  
  <div class="profile-page tx-13">
    <div class="row">
      <div class="col-12 grid-margin">
        <div class="card card-body">
          <div class="cover">
            <div class="cover-body d-flex justify-content-between align-items-center">
              <div>
                <img class="profile-pic" style="border-radius:0;" src="{{asset('storage/'.$data->logo)}}" alt="profile">
                <span class="profile-name">{{ $data->name }}</span>
              </div>
              <div class="d-none d-md-block">
                <button class="btn btn-primary btn-icon-text btn-edit-profile">
                  <i data-feather="edit" class="btn-icon-prepend"></i> Edit profile
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row profile-body">
      <!-- left wrapper start -->
      <div class="d-none d-md-block col-md-12 col-xl-12 left-wrapper">
        <div class="card rounded">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <h6 class="card-title mb-0">PROFILE FINTECH</h6>
                <div class="dropdown">
                    <button class="btn p-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="edit-2" class="icon-sm mr-2"></i> <span class="">Edit</span></a>
                        <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="git-branch" class="icon-sm mr-2"></i> <span class="">Update</span></a>
                        <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="eye" class="icon-sm mr-2"></i> <span class="">View all</span></a>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-between">
              <div class="col-3">
                <div class="mt-3">
                  <label class="tx-11 font-weight-bold mb-0 text-uppercase">Nomor PKS :</label>
                  <p class="text-muted">
                    <ul>
                      @foreach ($data->dokumenPks as $item)
                          <li>{{$item->nomor}}</li>
                      @endforeach
                    </ul>
                  </p>
                </div>
              </div>
              <div class="col-3">
                <div class="mt-3">
                  <label class="tx-11 font-weight-bold mb-0 text-uppercase">Izin OJK :</label>
                  <ul>
                    @foreach ($data->dokumenIjinOjk as $item)
                        <li>{{$item->nomor}}</li>
                    @endforeach
                  </ul>
                </div>
              </div>
              <div class="col-3">
                <div class="mt-3">
                  <label class="tx-11 font-weight-bold mb-0 text-uppercase">Outstanding :</label>
                  <p class="text-muted text-left">{{number_format($outstanding,2,',','. ')}}</p>
                </div>
              </div>
              <div class="col-3">
                <div class="mt-3">
                  <label class="tx-11 font-weight-bold mb-0 text-uppercase">TKB Fintech :</label>
                  <p class="text-muted text-left">{{$data->tkb}} %</p>
                </div>
              </div>
              <div class="col-3">
                <div class="mt-3">
                  <label class="tx-11 font-weight-bold mb-0 text-uppercase">Cakupan Wilayah :</label>
                  <p class="text-muted text-left">{{$data->cakupan_wilayah}}</p>
                </div>
              </div>
              <div class="col-3">
                <div class="mt-3">
                  <label class="tx-11 font-weight-bold mb-0 text-uppercase">Sektor Bisnis :</label>
                  <ul>
                    @foreach ($data->sektorBisnis as $item)
                        <li>{{$item->nama}}</li>
                    @endforeach
                  </ul>
                </div>
              </div>
              <div class="col-3">
                <div class="mt-3">
                  <label class="tx-11 font-weight-bold mb-0 text-uppercase">Pemegang Saham :</label>
                  <ul>
                    @foreach ($data->pemilik as $item)
                        <li>{{$item->nama}}</li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- left wrapper end -->
      
      <!-- middle wrapper start -->
      <div class="col-md-12 col-xl-12 middle-wrapper mt-3">
        <div class="row">
          <div class="col-md-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title mb-0 mb-3">Info Pembiayaan</h6>
                <div class="row">
                  <div class="col">
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr align="center" style="background-color: var(--bg-primary-color); color: #fff;">
                            <td>Nama Fintech</td>
                            <td>Status</td>
                            <td>Noa </td>
                            <td>Nominal</td>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($infoPembiayaan as $item)                              
                          <tr>
                            <td>{{$item->nama_fintech}}</td>
                            <td>{{$item->status}}</td>
                            <td align="center">{{$item->noa}}</td>
                            <td align="right">{{number_format($item->nominal,2,',','.')}}</td>
                          </tr>
                          @endforeach
                        </tbody>
                        <tfoot>
                          <tr style="background-color: var(--bg-secondary-color);
                          color: #000;">
                            <td colspan="2" align="center">Total</td>
                            <td align="center">{{$infoPembiayaan->sum('noa')}}</td>
                            <td align="right">{{number_format($infoPembiayaan->sum('nominal'),2,',','.')}}</td>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <div id='fullcalendar'></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- middle wrapper end -->
      
      {{-- calendar modal --}}
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
              {{-- <button class="btn btn-primary">Event Page</button> --}}
            </div>
          </div>
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
      $('#external-events .fc-event').each(function() {
        // store data so the calendar knows to render an event upon drop
        $(this).data('event', {
          title: $.trim($(this).text()), // use the element's text as the event title
          stick: true // maintain when user navigates (see docs on the renderEvent method)
        });
        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex: 999,
          revert: false,      // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        });

      });


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
              revert: true, 
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
