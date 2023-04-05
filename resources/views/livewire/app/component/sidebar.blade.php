<div>
  <nav class="sidebar">
    <div class="sidebar-header">
      <a href="#" class="sidebar-brand"> P2P <span> Lending </span> </a>
      <div class="sidebar-toggler active">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <div class="sidebar-body">
      {{-- {{menu('dashboard_user','_json')}} --}}
      <ul class="nav">
        @if(Auth::user()->role_id==1)
          <li class="nav-item nav-category">Admin</li>
          <li class="nav-item">
            <a href="{{route('voyager.dashboard')}}"  class="nav-link">
              <i class="link-icon" data-feather="anchor"></i>
              <span class="link-title">Admin menu</span>
            </a>
          </li>
        @endif
        <li class="nav-item nav-category">Main</li>
        @forelse(menu('dashboard_user','_json') as $menu)
        <li class="nav-item">
          @if($menu->children->isEmpty())
          <a href="{{$menu->url}}" class="nav-link">
            <i class="link-icon" data-feather="{{$menu->icon_class}}"></i>
            <span class="link-title">{{$menu->title}}</span>     
          </a>
          @else
          {{-- {{dd(json_decode($menu->children,true)[0])}} --}}

          <a href="#{{str_replace(' ','',$menu->title)}}" class="nav-link" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="{{str_replace(' ','',$menu->title)}}">
            <i class="link-icon" data-feather="{{$menu->icon_class}}"></i>
            <span class="link-title">{{$menu->title}}</span>
            <i class="link-arrow" data-feather="chevron-down"></i>         
          </a>
          <div class="collapse" id="{{str_replace(' ','',$menu->title)}}">
            <ul class="nav sub-menu">
              @foreach(json_decode($menu->children,true) as $menuItem)
              <li class="nav-item">
                <a href="{{$menuItem['url']}}" class="nav-link">{{$menuItem['title']}}</a>
              </li>    
              @endforeach           
            </ul>
          </div>
          @endif
        </li>
        @empty
          <li>
            <a href="#">Tidak ada menu!</a>
          </li>
        @endforelse
      </ul>
    </div>
  </nav>
</div>