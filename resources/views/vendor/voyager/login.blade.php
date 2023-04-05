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
      font-size: 12pt;
    }
    @media screen {
      .page {
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
        font-size: 14pt;
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


    @media print {
      img.logo-p2p {
        height: 6vw;
      }
      img.logo-bank {
        height: 4vw;
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
        font-size: 14pt;
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
    @media screen and (max-width: 840px) {
      .page {
        width: 90vw;
        padding: 3mm;
        font-size: 1vw;
      }
      p.title {
      text-align: center;
      font-size: 1rem;
      }
      .name p {
        font-size: 12pt;
        text-align: center;
        font-weight: 600;
      }
      .role p {
        font-size: 12pt;
        font-weight: 400;
        text-align: center;
      }
    }
  </style>
</head>
@livewireStyles
<body>


  
  <div class="container">
    <div class="row my-5">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-12 order-lg-1 order-2 mx-auto">
                  <img src="{{ asset('images/banner.jpg') }}" alt="logo" class="mt-5 img-fluid">
                </div>
                <div class="col-lg-4 col-md-6 col-12 order-lg-1 order-2 mx-auto">
                  <div class="p-4 m-3">
                    <img src="{{asset('images/p2p.png')}}" alt="logo" width="120" class="my-auto">
                    <form  action="{{ route('voyager.login') }}" method="POST" class="pt-3">
                        {{ csrf_field() }}
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"  class="form-control form-control-lg " placeholder="Email" required>
                      </div>
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" value="{{ old('password') }}" class="form-control form-control-lg " placeholder="Password" required>
                      </div>
                      <div class="mt-3">
                        <button type="submit" class="btn btn-primary btn-block auth-form-btn">                            
                            {{-- <span class="signingin hidden"><span class="voyager-refresh"></span> {{ __('voyager::login.loggingin') }}...</span> --}}
                            <span class="signin">{{ __('voyager::generic.login') }}</span>
                        </button>
                      </div>
                  </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
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
