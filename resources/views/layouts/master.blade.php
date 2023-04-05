<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>P2P Lending - bank CiJ</title>
	<!-- core:css -->
	<link rel="stylesheet" href="{{asset('vendors/core/core.css')}}">
	<!-- endinject -->

  <!-- plugin css for this page -->
  <link rel="stylesheet" href="{{asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/select2/select2.min.css')}}">
	<link rel="stylesheet" href="{{asset('vendors/jquery-tags-input/jquery.tagsinput.min.css')}}">
	<link rel="stylesheet" href="{{asset('vendors/dropzone/dropzone.min.css')}}">
	<link rel="stylesheet" href="{{asset('vendors/dropify/dist/dropify.min.css')}}">
	<link rel="stylesheet" href="{{asset('vendors/bootstrap-colorpicker/bootstrap-colorpicker.min.css')}}">
	<link rel="stylesheet" href="{{asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
	<link rel="stylesheet" href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/sweetalert2/sweetalert2.min.css')}}">
	<link rel="stylesheet" href="{{asset('vendors/fullcalendar/fullcalendar.min.css')}}">
  <!-- end plugin css for this page -->

	<!-- inject:css -->
  <link rel="stylesheet" href="{{asset('fonts/feather-font/css/iconfont.css')}}">
	<link rel="stylesheet" href="{{asset('vendors/flag-icon-css/css/flag-icon.min.css')}}">
	<!-- endinject -->

  <!-- Layout styles -->  
	<link rel="stylesheet" href="{{asset('css/demo_1/style.css')}}">
  <!-- End layout styles -->

  <link rel="shortcut icon" href="{{asset('images/favicon/favicon.ico')}}"/>
  <style>
    :root {
        --primary-color: #555;
        --secondary-color: #999;
        --tertiary-color: #dedede;
        --bg-primary-color: #6c7ae0;
        --bg-secondary-color: #d2d7ff;
        --bg-tertiary-color: #ecefff;
        --primary-text: 14pt;
        --secondary-text: 16pt;
    }
    p {
        text-align: center;
    }
    .name p {
        color: #555;
        font-size: 12pt;
    }
    .role p {
        color: #999;
        font-size: 11pt;
    }
    @media screen {
        .page {
        width: 210mm;
        min-height: 330mm;
        background-color: #fff;
        box-shadow: #dedede;
        padding: 15mm;
        margin: 10mm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        position: relative;
        }
    }
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }
    table{
        border-collapse: collapse;
    }
    table th {
        text-align: left;
    }
    tr, td, th {
        padding: 3px;
    }
    h4 {
        text-align: center;
        padding: 6px;
    }
    .nominal {
        text-align: right;
    }
    @font-face {
        font-family: 'Overpass';
        url: {{URL::asset('fonts/overpass/overpassblack.woff');}};
    }
    ul li {
      list-style-position: inside;
    }
  </style>

  @stack('page_specified_css')
  <script defer src="https://unpkg.com/alpinejs@3.10.5/dist/cdn.min.js"></script>
</head>
@livewireStyles
@livewireScripts

<body>
  <div class="main-wrapper">
    <!-- partial:partials/_navbar.html -->
    @livewire('app.component.sidebar')
    <!-- partial -->
    <div class="page-wrapper">
      <!-- partial:partials/_sidebar.html -->
      @livewire('app.component.navbar')
      <!-- partial -->
        <div class="page-content">
          @yield('content')
        </div>
        <!-- content-wrapper ends -->

        <!-- partial:partials/_footer.html -->
        @livewire('app.component.footer')
        <!-- partial -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- core:js -->
	<script src="{{asset('vendors/core/core.js')}}"></script>
	<!-- endinject -->
  <!-- plugin js for this page -->
  <script src="{{asset('vendors/chartjs/Chart.min.js')}}"></script>
  <script src="{{asset('vendors/jquery.flot/jquery.flot.js')}}"></script>
  <script src="{{asset('vendors/jquery.flot/jquery.flot.resize.js')}}"></script>
  <script src="{{asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
  <script src="{{asset('vendors/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{asset('vendors/progressbar.js/progressbar.min.js')}}"></script>

  <script src="{{asset('vendors/jquery-validation/jquery.validate.min.js')}}"></script>
	<script src="{{asset('vendors/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
	<script src="{{asset('vendors/inputmask/jquery.inputmask.min.js')}}"></script>
	<script src="{{asset('vendors/select2/select2.min.js')}}"></script>
	<script src="{{asset('vendors/typeahead.js/typeahead.bundle.min.js')}}"></script>
	<script src="{{asset('vendors/jquery-tags-input/jquery.tagsinput.min.js')}}"></script>
	<script src="{{asset('vendors/dropzone/dropzone.min.js')}}"></script>
	<script src="{{asset('vendors/dropify/dist/dropify.min.js')}}"></script>
	<script src="{{asset('vendors/bootstrap-colorpicker/bootstrap-colorpicker.min.js')}}"></script>
	<script src="{{asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
	<script src="{{asset('vendors/moment/moment.min.js')}}"></script>
	<script src="{{asset('vendors/fullcalendar/fullcalendar.min.js')}}"></script>
	<script src="{{asset('vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js')}}"></script>
  
  <!-- end plugin js for this page -->
	<!-- inject:js -->
  <script src="{{asset('vendors/feather-icons/feather.min.js')}}"></script>
	<script src="{{asset('js/template.js')}}"></script>
	<!-- endinject -->
  <!-- custom js for this page -->
  <script src="{{asset('js/datepicker.js')}}"></script>

  <script src="{{asset('js/form-validation.js')}}"></script>
	<script src="{{asset('js/bootstrap-maxlength.js')}}"></script>
	<script src="{{asset('js/inputmask.js')}}"></script>
	<script src="{{asset('js/select2.js')}}"></script>
	<script src="{{asset('js/typeahead.js')}}"></script>
	<script src="{{asset('js/tags-input.js')}}"></script>
	<script src="{{asset('js/dropzone.js')}}"></script>
	<script src="{{asset('js/dropify.js')}}"></script>
	<script src="{{asset('js/bootstrap-colorpicker.js')}}"></script>
	<script src="{{asset('js/datepicker.js')}}"></script>
	<script src="{{asset('js/timepicker.js')}}"></script>

  {{-- <script src="{{asset('/js/data-table.js')}}"></script> --}}

   {{-- <script src="{{asset('js/apexcharts.js')}}"></script> --}}
  {{-- <script src="{{asset('js/chartjs.js')}}"></script>  --}}

	<!-- end custom js for this page -->
  @stack('page_specified_js')

  <script src="{{asset('vendors/sweetalert2/sweetalert2.min.js')}}"></script>
  <script>
    window.addEventListener('swal:mixin',event=>{
      const Toast = Swal.mixin({
        toast: true,
        position: event.detail.position,
        showConfirmButton: false,
        timer: 1113000
      });
      
      Toast.fire({
        icon: event.detail.icon,
        title: event.detail.title
      })
    });
    
  window.addEventListener('swal:confirmAnalisa',event=>{
      const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger mr-2'
      },
      buttonsStyling: true,
    })
      swalWithBootstrapButtons.fire({
      title: event.detail.title,
      text: event.detail.text,
      icon: event.detail.icon,
      showCancelButton: true,
      confirmButtonClass: 'mr-2',
      confirmButtonText: event.detail.confirmButtonText,
      cancelButtonText: event.detail.cancelButtonText,
      reverseButtons: true
    }).then((result) => {
      if (result.value) {

        window.livewire.emit('analisa',event.detail.noFactsheet);
      }
    })
  });
    window.addEventListener('swal:confirm',event=>{
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger mr-2'
        },
        buttonsStyling: false,
      })
        swalWithBootstrapButtons.fire({
        title: event.detail.title,
        text: event.detail.text,
        icon: event.detail.icon,
        showCancelButton: true,
        confirmButtonClass: 'mr-2',
        confirmButtonText: event.detail.confirmButtonText,
        cancelButtonText: event.detail.cancelButtonText,
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
          swalWithBootstrapButtons.fire(
            event.detail.confirmedTitle,
            event.detail.confirmedText,
            event.detail.confirmedIcon
          )
        } else if (
          // Read more about handling dismissals
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            event.detail.canceledTitle,
            event.detail.canceledText,
            event.detail.canceledIcon
          )
        }
      })
    });

    window.addEventListener('swal:fire',event=>{
      Swal.fire({
        position: event.detail.position,
        icon: event.detail.icon,
        title: event.detail.title,
        text: event.detail.text,
        showConfirmButton: false,
        timer: 1500
      });
    });
  </script>

</body>

</html>

