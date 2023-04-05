<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>P2P bank cij</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('vendors/feather/feather.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/typicons/typicons.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/simple-line-icons/css/simple-line-icons.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/css/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('css/vertical-layout-light/style.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/sweetalert2/sweetalert2.min.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('images/p2p.png')}}" />
  <style>
    :root {
        --primary-color: #555;
        --secondary-color: #999;
        --tertiary-color: #dedede;
        --bg-primary-color: #6c7ae0;
        --bg-secondary-color: #d2d7ff;
        --bg-tertiary-color: #ecefff;
    }
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    @media screen {
      .page {
        width: 210mm;
        margin-top: 50px;
        box-shadow: inset; 
        padding: 3mm;
        margin: 0 auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        position: relative;
      }
      img.logo-p2p {
        height: 6vw;
      }
      img.logo-bank {
        height: 4vw;
      }
      tr:nth-child(even) {
        background-color: var(--bg-tertiary-color);
      }
      tr, th, td {
        /* border: 1px solid black; */
        padding: 2px;
      }
      th.nominal {
        text-align: right;
      }
      p.title {
        text-align: center;
        /* font-size: 1rem; */
        line-height: 25px;
      }
      table .title {
        background-color: #fff;
      }
      table {
        /* background-color: var(--bg-secondary-color); */
        width: 100%;
        margin: 8px 0;
        /* border: 1px solid black; */
      }
      .name p {
        text-align: center;
        font-weight: 600;
        margin: 2px;
      }
      .role p {
        font-weight: 400;
        text-align: center;
        margin: 2px;
      }
      button {
        width: 120px;
        position: fixed;
        right: 10px;
        bottom: 10px;
      }
      .wealth-row {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
      }
      .wealth-row table {
        width: 49%;
      }
      .liquidity-ratio-row {
        display: flex;
        flex-direction: row;
        justify-content: space-between
      }
      .liquidity-ratio-row table {
        width: 33%;
      }
      .rows-report {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        flex-wrap: wrap;
      }
      .rows-report table {
        width: 49%;
      }
    }

    @media screen and (max-width: 800px) {
      .liquidity-ratio-row {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        flex-wrap: no-wrap;
        page-break-after: always;
      }
      .liquidity-ratio-row table {
        width: 100%;
      }
      .wealth-row {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        flex-wrap: no-wrap;
        width: 100%;!important
      }
      .page {
        width: 90vw;
        padding: 3mm;
        font-size: 1.5vw;
      }
      h4 {
        font-size: 1.7vw;
      }
      p.title {
      text-align: center;
      /* font-size: 1rem; */
      }
      .name p {
        /* font-size: 1rem; */
        text-align: center;
        font-weight: 600;
      }
      .role p {
        /* font-size: 1rem; */
        font-weight: 400;
        text-align: center;
      }
    }

    @media print {
      @page {
        margin: 3mm;
      }
      .wealth-row {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        flex-wrap: wrap;
      }
      .wealth-row table {
        width: 49%;
      }
      .liquidity-ratio-row table {
        width: 33%;
      }
      .liquidity-ratio-row {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        flex-wrap: no-wrap;
        page-break-after: always;
      }
      .rows-report {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        flex-wrap: wrap;
      }
      .rows-report table {
        width: 49%;
      }
      /* .wealth-row table {
        width: 49%;
      } */
      button.btn {
        display: none;
      }
      img.logo-p2p {
        height: 70px;
      }
      img.logo-bank {
        height: 50px;
      }
      .pages {
        width: 210mm;
        min-height: 297mm;
        margin-top: 50px;
        box-shadow: inset; 
        padding: 3mm;
        margin: 0 auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        position: relative;
      }
      tr:nth-child(even) {
        background-color: var(--bg-tertiary-color);
      }
      tr, th, td {
        /* border: 1px solid black; */
        padding: 2px;
      }
      th.nominal {
        text-align: right;
      }
      p.title {
        text-align: center;
        /* font-size: 12pt; */
        line-height: 25px;
      }
      table .title {
        background-color: #fff;
      }
      table {
        /* background-color: var(--bg-secondary-color); */
        width: 100%;
        margin: 8px 0;
        /* border: 1px solid black; */
      }
      .name p {
        text-align: center;
        font-weight: 600;
      }
      .role p {
        font-weight: 400;
        text-align: center;
      }
    }

    @media screen and (max-width: 800px) {
      .liquidity-ratio-row {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        flex-wrap: no-wrap;
        page-break-after: always;
      }
      .liquidity-ratio-row table {
        width: 100%;
      }
      .wealth-row {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        flex-wrap: no-wrap;
        width: 100%;!important
      }
      .page {
        width: 90vw;
        padding: 3mm;
        font-size: 1.5vw;
      }
      h4 {
        font-size: 1.7vw;
      }
      p.title {
      text-align: center;
      /* font-size: 1rem; */
      }
      .name p {
        /* font-size: 1rem; */
        text-align: center;
        font-weight: 600;
      }
      .role p {
        /* font-size: 1rem; */
        font-weight: 400;
        text-align: center;
      }
    }
  </style>
</head>
@livewireStyles
<body>

    <div class="my-4">
      @yield('content')
    </div>

  @livewireScripts
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{('vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{('vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{('js/off-canvas.js')}}"></script>
  <script src="{{('js/hoverable-collapse.js')}}"></script>
  <script src="{{('js/template.js')}}"></script>
  <script src="{{('js/settings.js')}}"></script>
  <script src="{{('js/todolist.js')}}"></script>
  <!-- endinject -->
</body>

<script src="{{asset('vendors/sweetalert2/sweetalert2.min.js')}}"></script>
<script>
  window.addEventListener('swal:mixin',event=>{
    console.log(event);
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
    console.log('asjdlkajsldkj');
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

        window.livewire.emit('analisa',event.detail.noFactsheet);
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
</html>
