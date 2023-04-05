<div>
  <nav class="navbar">
    <a href="#" class="sidebar-toggler">
      <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
      <form class="search-form">
        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text">
              <i data-feather="search"></i>
            </div>
          </div>
          <input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
        </div>
      </form>
      <ul class="navbar-nav">
        <li class="nav-item dropdown nav-profile">
          <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="{{asset('storage/'.Auth::user()->avatar)}}" alt="profile">
          </a>
          <div class="dropdown-menu" aria-labelledby="profileDropdown">
            <div class="dropdown-header d-flex flex-column align-items-center">
              <div class="figure mb-3">
                <img src="{{asset('storage/'.Auth::user()->avatar)}}" alt="">
              </div>
              <div class="info text-center">
                <p class="name font-weight-bold mb-0">{{Auth::user()->name}}</p>
                <p class="email text-muted mb-3">{{Auth::user()->email}}</p>
              </div>
            </div>
            <div class="dropdown-body">
              <ul class="profile-nav p-0 pt-3">
                <li class="nav-item">
                  <a href="{{ route('voyager.profile') }}" class="nav-link">
                    <i data-feather="user"></i>
                    <span>Profile</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a wire:click.prevent="logout" href="#" class="nav-link">
                    <i data-feather="log-out"></i>
                    <span>Log Out</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </nav>
</div> 