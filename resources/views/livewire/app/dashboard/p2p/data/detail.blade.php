<div>
  <div>

    {{-- <style>
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
    </style> --}}
    
    <div class="profile-page tx-13">
      <div class="row">
        <div class="col-12 grid-margin">
          <div class="card card-body">
            <div class="cover">
              <div class="cover-body d-flex justify-content-between align-items-center">
                <div>
                  {{-- <img class="profile-pic" style="border-radius:0;" src="{{asset('storage/'.$data->logo)}}" alt="profile"> --}}
                  <span class="profile-name"><b>{{$lending->borrowerData->nama}}</b></span>
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
        <div class="d-none d-md-block col-sm-12 col-md-5 col-xl-5 left-wrapper">
          <div class="card rounded">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-between mb-2">
                  <h6 class="card-title mb-0">Detail Pembiayaan</h6>
              </div>
              <div class="row">
                <div class="col-12">
                  <table class="">
                    <tr class="row">
                      <td class="col-3">
                        <tr>
                          <td>Nomor Factsheet</td><td>:</td><td>{{$lending->no_factsheet}}</td>
                        </tr>
                        <tr>
                          <td>Nama Fintech</td><td>:</td><td>{{$lending->fintech->name}}</td>
                        </tr>
                        <tr>
                          <td>Nama Borrower</td><td></td><td>{{$lending->borrowerData->nama}}</td>
                        </tr>
                        <tr>
                          <td>Bentuk Badan Hukum</td><td>:</td><td>{{$lending->bentukBadanHukum->nama}}</td>
                        </tr>
                        <tr>
                          <td>Lokasi Perusahaan</td><td>:</td><td>{{$lending->lokasiPerusahaan->nama}}</td>
                        </tr>
                        <tr>
                          <td>Sektor Usaha</td><td>:</td><td>{{$lending->sektorUsaha->nama}}</td>
                        </tr>
                        <tr>
                          <td>Lokasi Proyek</td><td>:</td><td>{{$lending->lokasiProject->nama}}</td>
                        </tr>
                      </td>
                      <td class="col-3">
                        <tr>
                          <td>Jenis Pembiayaan</td><td>:</td><td>{{$lending->jenisPembiayaan->nama}}</td>
                        </tr>
                        <tr>
                          <td>Kriteria Borrower</td><td>:</td><td>{{$lending->bentukBadanHukum->nama}}</td>
                        </tr>
                        <tr>
                          <td>Jenis Penggunaan</td><td>:</td><td>{{$lending->jenisPembiayaan->nama}}</td>
                        </tr>
                        <tr>
                          <td>Tanggal Penawaran</td><td>:</td><td>{{$lending->tanggal_penawaran}}</td>
                        </tr>
                        <tr>
                          <td>Plafon Penawaran</td><td>:</td><td>{{$lending->plafon_penawaran}}</td>
                        </tr>
                        <tr>
                          <td>Jangka Waktu</td><td>:</td><td>{{$lending->jangkaWaktu." ".$lending->typeJangkaWaktu}}</td>
                        </tr>
                      </td>
                      <td class="col-3">
                        <tr>
                          <td>Suku Bunga</td><td>:</td><td>{{$lending->suku_bunga}}</td>
                        </tr>
                        <tr>
                          <td>Tujuan Pinjaman</td><td>:</td><td>{{$lending->suku_bunga}}</td>
                        </tr>
                        <tr>
                          <td>Sifat Pembiayaan</td><td>:</td><td>{{$lending->sifatPembiayaanData->nama}}</td>
                        </tr>
                        <tr>
                          <td>Agunan Utama</td><td>:</td><td>{{$lending->agunanUtama->nama}}</td>
                        </tr>
                        <tr>
                          <td>Nama Payor</td><td>:</td><td>
                            <ul>
                              @foreach($lending->payor as $payor)
                              <li>{{$payor->nama}}</li>
                              @endforeach
                            </ul>
                          </td>
                        </tr>
                      </td>
                      <td class="col-3">
                        <tr>
                          <td>Rating Fintech</td><td>:</td><td>{{$lending->ratingFintech->nama}}</td>
                        </tr>
                        <tr>
                          <td>Rating Pefindo</td><td>:</td><td>{{$lending->ratingPefindo->nama}}</td>
                        </tr>
                        <tr>
                          <td>Baki Debet Kredit</td><td>:</td><td>{{number_format($lending->baki_debet,2,',','.')}}</td>
                        </tr>
                        <tr>
                          <td>No. Rek. MBS</td><td>:</td><td>{{$lending->no_rekening}}</td>
                        </tr>
                        <tr>
                          <td>Link Dokumen</td><td>:</td><td>{{$lending->link_dokumen}}</td>
                        </tr>
                        <tr>
                          <td>Status Pembiayaan</td><td>:</td><td>{{$lending->statusPembiayaanData->nama}}</td>
                        </tr>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-7">
          <!-- middle wrapper start -->
          @livewire('app.dashboard.p2p.component.jadwal-angsuran', ['jadwalAngsuran' => $jadwalAngsuran])
          <!-- middle wrapper end -->
        </div>
        <!-- left wrapper end -->
        
        
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
  
</div>
