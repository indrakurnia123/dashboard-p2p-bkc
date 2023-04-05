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
              <form class="pt-3" wire:submit.prevent="login">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input wire:model="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Email">
                  @error('email')
                      <div class="invalid-feedback">
                          {{$message}}
                      </div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input wire:model="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Password">
                  @error('password')
                      <div class="invalid-feedback">
                          {{$message}}
                      </div>
                  @enderror
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-primary btn-block auth-form-btn">SIGN IN</button>
                </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>